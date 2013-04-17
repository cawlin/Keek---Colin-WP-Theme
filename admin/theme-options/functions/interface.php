<?php 
/**
 * SMOF Interface
 *
 * @package     WordPress
 * @subpackage  SMOF
 * @since       1.4.0
 * @author      Syamil MJ
 */
 
 
/**
 * Admin Init
 *
 * @uses wp_verify_nonce()
 * @uses header()
 * @uses update_option()
 *
 * @since 1.0.0
 */
function optionsframework_admin_init() {
	// Rev up the Options Machine
	global $of_options, $options_machine;
	$options_machine = new Options_Machine($of_options);
}

/**
 * Create Options page
 *
 * @uses add_theme_page()
 * @uses add_action()
 *
 * @since 1.0.0
 */
function optionsframework_add_admin() {
    $of_page = add_theme_page( THEMENAME, 'Theme Options', 'edit_theme_options', 'optionsframework', 'optionsframework_options_page');
	// Add framework functionality to the head individually
	add_action("admin_print_scripts-$of_page", 'of_load_only');
	add_action("admin_print_styles-$of_page",'of_style_only');
	add_action( "admin_print_styles-$of_page", 'optionsframework_mlu_css', 0 );
	add_action( "admin_print_scripts-$of_page", 'optionsframework_mlu_js', 0 );
}


/**
 * Build Options page
 *
 * @since 1.0.0
 */
function optionsframework_options_page() {
	global $options_machine;
	//calls the front-end view
	include_once( SMOF_PATH . 'front-end/options.php' );
}

/**
 * Create Options page
 *
 * @uses wp_enqueue_style()
 *
 * @since 1.0.0
 */
function of_style_only() {
	wp_enqueue_style('smof', SMOF_DIR . 'assets/css/smof.css');
	wp_enqueue_style('color-picker', SMOF_DIR . 'assets/css/colorpicker.css');
}	

/**
 * Create Options page
 *
 * @uses add_action()
 * @uses wp_enqueue_script()
 *
 * @since 1.0.0
 */
function of_load_only() {
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('jquery-input-mask', SMOF_DIR .'assets/js/jquery.maskedinput-1.2.2.js', array( 'jquery' ));
	wp_enqueue_script('tipsy', SMOF_DIR .'assets/js/jquery.tipsy.js', array( 'jquery' ));
	wp_enqueue_script('color-picker', SMOF_DIR .'assets/js/colorpicker.js', array('jquery'));
	wp_enqueue_script('ajaxupload', SMOF_DIR .'assets/js/ajaxupload.js', array('jquery'));
	wp_enqueue_script('cookie', SMOF_DIR . 'assets/js/cookie.js', 'jquery');
	wp_enqueue_script('smof', SMOF_DIR .'assets/js/smof.js', array( 'jquery' ));
}

/**
 * Head Hook
 *
 * @since 1.0.0
 */
function of_head() { do_action( 'of_head' ); }

/**
 * Add default options upon activation else DB does not exist
 *
 * @since 1.0.0
 */
function of_option_setup()
{
	global $of_options, $options_machine, $wp_rewrite;
	$options_machine = new Options_Machine($of_options);
		
	if (is_admin() && !get_option(AQ_OPTIONS) || ( isset($_GET['activated']) && $_GET['activated'] == true ))
	{
		update_option(AQ_OPTIONS,$options_machine->Defaults);
		$wp_rewrite->flush_rules();
	}
}

/**
 * Change activation message
 *
 * @since 1.0.0
 */
function optionsframework_admin_message() { 
	
	//Tweaked the message on theme activate
	?>
    <script type="text/javascript">
    jQuery(function(){
    	
        var message = '<p>This theme comes with an <a href="<?php echo admin_url('admin.php?page=optionsframework'); ?>">options panel</a> to configure settings. This theme also supports widgets, please visit the <a href="<?php echo admin_url('widgets.php'); ?>">widgets settings page</a> to configure them.</p>';
    	jQuery('.themes-php #message2').html(message);
    
    });
    </script>
    <?php
	
}

/**
 * Get header classes
 *
 * @since 1.0.0
 */
function of_get_header_classes_array() 
{
	global $of_options;
	
	foreach ($of_options as $value) 
	{
		if ($value['type'] == 'heading')
			$hooks[] = str_replace(' ','',strtolower($value['name']));	
	}
	
	return $hooks;
}

/**
 * Ajax Save Options
 *
 * @uses get_option()
 * @uses update_option()
 *
 * @since 1.0.0
 */
function of_ajax_callback() 
{
	global $options_machine, $of_options;

	$nonce=$_POST['security'];
	
	if (! wp_verify_nonce($nonce, 'of_ajax_nonce') ) die('-1'); 
			
	//get options array from db
	$all = get_option(AQ_OPTIONS);
	
	$save_type = $_POST['type'];
	
	//echo $_POST['data'];
	
	//Uploads
	if($save_type == 'upload')
	{
		
		$clickedID = $_POST['data']; // Acts as the name
		$filename = $_FILES[$clickedID];
       	$filename['name'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', $filename['name']); 
		
		$override['test_form'] = false;
		$override['action'] = 'wp_handle_upload';    
		$uploaded_file = wp_handle_upload($filename,$override);
		 
			$upload_tracking[] = $clickedID;
				
			//update $options array w/ image URL			  
			$upload_image = $all; //preserve current data
			
			$upload_image[$clickedID] = $uploaded_file['url'];
			
			update_option(AQ_OPTIONS, $upload_image ) ;
		
				
		 if(!empty($uploaded_file['error'])) {echo 'Upload Error: ' . $uploaded_file['error']; }	
		 else { echo $uploaded_file['url']; } // Is the Response
		 
	}
	elseif($save_type == 'image_reset')
	{
		$id = $_POST['data']; // Acts as the name
		
		$delete_image = $all; //preserve rest of data
		$delete_image[$id] = ''; //update array key with empty value	 
		update_option(AQ_OPTIONS, $delete_image ) ;
	}
	elseif($save_type == 'backup_options')
	{
		$backup = $all;
		$backup['backup_log'] = date('r');
		
		update_option(AQ_BACKUPS, $backup ) ;
			
		die('1'); 
	}
	elseif($save_type == 'restore_options')
	{
		$data = get_option(AQ_BACKUPS);
		update_option(AQ_OPTIONS, $data);
		
		die('1'); 
	}
	elseif($save_type == 'import_options'){
			
		$data = $_POST['data'];
		$data = unserialize(base64_decode($data)); //100% safe - ignore theme check nag
		update_option(AQ_OPTIONS, $data);
		
		die('1'); 
	}
	elseif ($save_type == 'save')
	{
		$data = array();
		$data = wp_parse_args(stripslashes($_POST['data']), $data);
		unset($data['security']);
		unset($data['of_save']);
		update_option(AQ_OPTIONS, $data);
		
		die('1');
	}
	elseif ($save_type == 'reset')
	{
		update_option(AQ_OPTIONS,$options_machine->Defaults);
		
        die('1'); //options reset
	}

  	die();
}