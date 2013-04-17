<?php 
/**
 * Theme Init
 *
 * Initialise theme core functionalities
 *
 */

/** Add RSS to the <head> section */
add_theme_support( 'automatic-feed-links' );

/** Localization */
load_theme_textdomain('a10e', get_template_directory(). '/lang');

/** Register CSS & JS and load where necessary */
add_action('init', 'aq_register_cssjs');

if(!function_exists('aq_register_cssjs')) {
	function aq_register_cssjs() {
	    if( !is_admin()){

			// stylesheets
			wp_register_style('style', get_stylesheet_directory_uri() . '/style.css');
			wp_register_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.css');
			wp_register_style('googlefonts-opensans', esc_url('fonts.googleapis.com/css') . '?family=Open+Sans:400italic,700italic,400,700,800');
			
			// wp_register_script('superfish', get_template_directory_uri() . '/js/jquery.superfish.js', 'jquery', '', true);
	        wp_register_script('tweet', get_template_directory_uri() . '/js/jquery.tweet.js', 'jquery', '', true);
			wp_register_script('fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', 'jquery', '', true);
			wp_register_script('flexslider', get_template_directory_uri() . '/js/jquery.flexslider.js', 'jquery', '', true);
			wp_register_script('respond', get_template_directory_uri() . '/js/respond.min.js', 'jquery', '', true);
	        wp_register_script('global', get_template_directory_uri() . '/js/jquery.global.js', array('jquery'), '', true);

	    }
	}
}

// global scripts
add_action('wp_enqueue_scripts', 'aq_init_scripts');

function aq_init_scripts() {
	
	//styles
	wp_enqueue_style('style');
	wp_enqueue_style('font-awesome');
	wp_enqueue_style('googlefonts-opensans');
	
	//scripts
	wp_enqueue_script('jquery');
	wp_enqueue_script('tweet');
	wp_enqueue_script('fitvids');
	wp_enqueue_script('respond');
	wp_enqueue_script('global');
	
	// setup vars for use in scripts
	$params = array(
		'templateurl' => trailingslashit(get_bloginfo('template_url')),
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'swfPath' => get_template_directory_uri() . '/js',
	);	
	wp_localize_script( 'global', 'aqvars', $params );
		
}

// dynamic scripts
add_action('template_redirect', 'aq_print_scripts');

function aq_print_scripts() {
	if ( is_singular() ) wp_enqueue_script('comment-reply');
}

/** Activate post-image functionality (WP 2.9+) */
if ( function_exists( 'add_theme_support' ) ) { // Added in 2.9
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 50, 50, true ); // Normal post thumbnails
	add_image_size( 'single-post-thumbnail', 400, 9999 ); // Permalink thumbnail size
}

/** Register Navigation Menus */
register_nav_menus(
	array(
	'primary'=>__('Primary Menu'),
	)
);

/** Register sidebars */
$footer_sidebars = array(
	array (
		'name' => 'Footer Widgets Left',
		'id'   => 'footer-widgets-left',
		'description'   => 'These are widgets for the left side of the footer.',
		'before_widget' => '<div class="widget cf">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5>',
		'after_title'   => '</h5>'    
	),
	array (
		'name' => 'Footer Widgets Right',
		'id'   => 'footer-widgets-right',
		'description'   => 'These are widgets for the right side of the footer.',
		'before_widget' => '<div class="widget cf">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5>',
		'after_title'   => '</h5>'    
	)
);
foreach($footer_sidebars as $sidebar) 
	register_sidebar($sidebar);

/** Post formats */
$post_formats = array (
	'gallery',
	'link',
	'quote',
	'video',
	'audio'
);

add_theme_support( 'post-formats', $post_formats );

if ( ! isset( $content_width ) ) $content_width = 860;
