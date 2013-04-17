<?php 
/** Aqua Options Framework
 * 
 *	@author Syamil MJ
 */
 
/**
 * Definitions
 *
 * @since 1.4.0
 */
if( is_child_theme() ) {
	$temp_obj = wp_get_theme();
	$theme_obj = wp_get_theme( $temp_obj->get('Template') );
} else {
	$theme_obj = wp_get_theme();    
}

$theme_version = $theme_obj->get('Version');
$theme_name = $theme_obj->get('Name');
$theme_uri = $theme_obj->get('ThemeURI');
$author_uri = $theme_obj->get('AuthorURI');


define( 'SMOF_VERSION', '1.4.0' );
define( 'SMOF_PATH', get_template_directory() . '/admin/theme-options/' );
define( 'SMOF_DIR', get_template_directory_uri() . '/admin/theme-options/' );
define( 'THEMENAME', $theme_name );
/* Theme version, uri, and the author uri are not completely necessary, but may be helpful in adding functionality */
define( 'THEMEVERSION', $theme_version );
define( 'THEMEURI', $theme_uri );
define( 'THEMEAUTHORURI', $author_uri );

define( 'AQ_OPTIONS', preg_replace("/[^A-Za-z0-9 ]/", '', $theme_name).'_options' );
define( 'AQ_BACKUPS', preg_replace("/[^A-Za-z0-9 ]/", '', $theme_name).'_backups' );

/**
 * Required Files
 *
 * @since 1.0.0
 */ 
require_once( SMOF_PATH . 'classes/class-options_machine.php' );
require_once( SMOF_PATH . 'functions/options.php' );
require_once( SMOF_PATH . 'functions/interface.php' );
require_once( SMOF_PATH . 'functions/mediauploader.php' );
require_once( SMOF_PATH . 'functions/custom.php' );

/**
 * Required action filters
 *
 * @uses add_action()
 *
 * @since 1.0.0
 */
add_action('load-themes.php','of_option_setup');
add_action('admin_head', 'optionsframework_admin_message');
add_action('admin_init','optionsframework_admin_init');
add_action('admin_menu', 'optionsframework_add_admin');
add_action( 'init', 'optionsframework_mlu_init');

/**
 * AJAX Saving Options
 *
 * @since 1.0.0
 */
add_action('wp_ajax_of_ajax_post_action', 'of_ajax_callback');