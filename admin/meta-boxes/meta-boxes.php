<?php
/**
 * Posts & Pages meta boxes
 */


/**
 * Main custom meta boxes class
 */
if(!class_exists('AQ_Meta_Boxes')) {

	class AQ_Meta_Boxes {

		protected $options = array();
		protected $post_type = 'post';
		public $post_types = array();
		protected $fields = array();

		function __construct( $options = array() ) {

			$this->options = $options;
			if(is_admin()) {
				$this->post_types = $this->get_post_types();
				add_action('admin_menu', array($this, 'add_box'));
				add_action( 'admin_enqueue_scripts', array($this, 'enqueue_cssjs') );
				add_action('save_post', array($this, 'save_box'));
			}

		}

		/**
		 * Register custom meta boxes
		 */
		function add_box() {

			foreach($this->options as $option) {

				$id = isset($option['id']) ? $option['id'] : '';
				$title = isset($option['title']) ? $option['title'] : '';
				$callback = array($this, 'show_box');
				$post_type = isset($option['post_type']) ? $option['post_type'] : '';
				$context = isset($option['context']) ? $option['context'] : '';
				$priority = isset($option['priority']) ? $option['priority'] : '';
				$fields = ( isset($option['fields']) && is_array($option['fields']) ) ? $option['fields'] : '';

				if(!empty($id) && !empty($title) && !empty($post_type) && !empty($context) && !empty($priority) ) {
						$this->fields = $fields;
						add_meta_box( $id, $title, $callback, $post_type, $context, $priority);		
				}

			}

		}

		/** 
		 * Display meta boxes 
		 */
		function show_box() {

			// Use nonce for verification
			echo '<input type="hidden" name="aq_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
		 
			echo '<table class="form-table">';

			foreach($this->fields as $field) {

				echo aq_meta_field($field);

			}

			echo '</table>';

		}

		/** 
		 * Save meta boxes fields
		 */
		function save_box( $post_id ) {

			global $post;

			if(!isset($_POST['aq_meta_box_nonce'])) $_POST['aq_meta_box_nonce'] = "undefine";
 
			// verify nonce
			if (!wp_verify_nonce($_POST['aq_meta_box_nonce'], basename(__FILE__) ))
				return $post_id;
		 
			// check autosave
			if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
				return $post_id;

			// check permissions
			if ('page' == $_POST['post_type']) {
				if (!current_user_can('edit_page', $post_id)) {
					return $post_id;
				}
			} elseif (!current_user_can('edit_post', $post_id)) {
				return $post_id;
			}

			// save meta values
			foreach($this->options as $option) {

				if($option['post_type'] == $post->post_type) {

					foreach($option['fields'] as $field) {

						$old = get_post_meta($post_id, $field['id'], true);
						$new = $_POST[$field['id']];
				 
						if ($new && $new != $old) {
							if(is_array($new)) {
							
								$_new = array();
								foreach($new as $key => $value){
									$_new[$key] = stripslashes(htmlspecialchars($value));
								}
								update_post_meta($post_id, $field['id'], $_new);
								
							} else {
								update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
							}
						} elseif ('' == $new && $old) {
							delete_post_meta($post_id, $field['id'], $old);
						}

					}

				}

			}


		}

		/**
		 * Get post types where custom meta boxes are used
		 */
		function get_post_types() {
			$post_types = array('post', 'page');
			return $post_types;
		}

		function enqueue_cssjs( $hook ) {
			
			global $post;

			if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
				foreach($this->post_types as $type) {
					
					if ( $type === $post->post_type )
						wp_enqueue_script('custom-meta-box-js', get_template_directory_uri() . '/admin/meta-boxes/js/meta-boxes.js' );

				}
			}

		}

	}

}




/**
 * Custom Meta fields
 */
function aq_meta_field($field) {

	global $post;

	if(!is_array($field)) return false;
	$meta = get_post_meta($post->ID, $field['id'], true);

	switch ($field['type']) {

		case 'input_number':

			$step = isset($field['options']['step']) ? $field['options']['step'] : 'any';

			echo '<tr id="'.$field['id'].'_container">'.
				    '<th style="width:25%">'.
				    	'<label for="', $field['id'], '">'.
				    	    '<strong>', $field['name'], '</strong>'.
				    	    '<span style=" display:block; color:#777; margin:5px 0 0 0;">'. $field['desc'].'</span>'.
				    	'</label>'.
				    '</th>'.
					'<td>';

				echo '<input type="number" step="'. $step .'" name="', $field['id'], '" id="', $field['id'], '" value="', ($meta !== false) ? $meta : $field['std'], '" size="8" style="width:70px; margin-right: 20px; float:left;" />';

			echo '</td></tr>';

		break;

		case 'text':

			echo '<tr id="'.$field['id'].'_container">'.
				    '<th style="width:25%">'.
				    	'<label for="', $field['id'], '">'.
				    	    '<strong>', $field['name'], '</strong>'.
				    	    '<span style=" display:block; color:#777; margin:5px 0 0 0;">'. $field['desc'].'</span>'.
				    	'</label>'.
				    '</th>'.
					'<td>';

				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" size="30" style="width:75%; margin-right: 20px; float:left;" />';

			echo '</td></tr>';

		break;

		case 'textarea':

			echo '<tr id="'.$field['id'].'_container">'.
				    '<th style="width:25%">'.
				    	'<label for="', $field['id'], '">'.
				    	    '<strong>', $field['name'], '</strong>'.
				    	    '<span style=" display:block; color:#777; margin:5px 0 0 0;">'. $field['desc'].'</span>'.
				    	'</label>'.
				    '</th>'.
					'<td>';

				echo '<textarea name="', $field['id'], '" id="', $field['id'], '" rows="8" cols="5" style="width:100%; margin-right: 20px; float:left;" >', $meta ? $meta : $field['std'] ,'</textarea>';

			echo '</td></tr>';

		break;

		case 'editor':
			
			echo '<tr id="'.$field['id'].'_container">'.
				    '<th style="width:25%">'.
				    	'<label for="', $field['id'], '">'.
				    	    '<strong>', $field['name'], '</strong>'.
				    	    '<span style=" display:block; color:#777; margin:5px 0 0 0;">'. $field['desc'].'</span>'.
				    	'</label>'.
				    '</th>'.
					'<td>';
				
				echo '<div style="width:520px">';
				
					$settings = array(
						'textarea_name' => $field['id'],
						'media_buttons' => false,
						'textarea_rows' => '10',
					);
					
					wp_editor( $meta ? htmlspecialchars_decode($meta) : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)) , $field['id'], $settings );
				
				echo '</div>';
			
			echo '</td></tr>';
			
		break;

		case 'select':
			
			$meta = $meta? $meta : $field['std'];

			echo '<tr id="'.$field['id'].'_container">'.
				    '<th style="width:25%">'.
				    	'<label for="', $field['id'], '">'.
				    	    '<strong>', $field['name'], '</strong>'.
				    	    '<span style=" display:block; color:#777; margin:5px 0 0 0;">'. $field['desc'].'</span>'.
				    	'</label>'.
				    '</th>'.
					'<td>';
		
				echo'<select name="'.$field['id'].'">';
			
				foreach ($field['options'] as $key => $option) {
					
					echo '<option value="' . $key .'"';
						if ($meta == $key ) { 
							echo ' selected="selected"'; 
						}
					echo'>'. $option .'</option>';
				
				} 
				
				echo'</select>';

			echo '</td></tr>';
		
		break;

	}// end switch

}

$meta_boxes_options = array();
$meta_boxes_options[] = array(
	'id' => 'aq-page-meta-box-description',
	'title' =>  __('Page Description', 'a10e'),
	'post_type' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array( 
			'name' => __('Display featured thumbnail?','a10e'),
			'desc' => __('Select yes to display featured thumbnail.','a10e'),
			'id' => 'aq_format_0',
			'type' => 'select',
			'std' => '1',
			'options' => array('1' => 'Yes', '0' => 'No')
		),
		array( 
			'name' => __('Link Settings','a10e'),
			'desc' => __('Enter the link','a10e'),
			'id' => 'aq_format_link',
			'type' => 'text',
			'std' => ''
		),
		array( 
			'name' => __('Gallery Settings','a10e'),
			'desc' => __('Enter crop height, or leave empty to not crop (default: 400)','a10e'),
			'id' => 'aq_format_gallery',
			'type' => 'input_number',
			'std' => '400',
			'options' => array('step' => 10)
		),
		array( 
			'name' => __('Quote Settings','a10e'),
			'desc' => __('Enter the quote author or reference to the quote (optional)','a10e'),
			'id' => 'aq_format_quote',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name' => 'Video Settings',
			'desc' => __('Enter the embed code from e.g. Youtube or Vimeo', 'a10e'),
			'id' => 'aq_format_video',
			'type' => 'textarea',
			'std' => '',
		),
		array(
			'name' => 'Audio Settings',
			'desc' => __('Enter the embed code from e.g. Soundcloud', 'a10e'),
			'id' => 'aq_format_audio',
			'type' => 'textarea',
			'std' => '',
		)
	),
);

$aq_meta_boxes = new AQ_Meta_Boxes($meta_boxes_options);

