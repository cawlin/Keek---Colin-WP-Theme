<?php 
/**
 * Custom Functions
 *
 * Use this file to define your own custom functions
 * Some examples have been included
 *
 * @since 1.4.1
 */

function add_theme_options_admin_bar(){
	global $wp_admin_bar;
	$wp_admin_bar->add_menu( array( 'id' => 'aq-theme-options', 'parent' => 'appearance', 'title' => 'Theme Options', 'href' => admin_url('themes.php?page=optionsframework') ) );
	
}
add_action( 'admin_bar_menu', 'add_theme_options_admin_bar', 1000 );