<?php
/**
 * Custom widgets
 *
 * @package Basic
 */

// Include widget classes
require_once('class-aq-widget-twitter.php');
require_once('class-aq-widget-social-icons.php');

// Register custom widgets
add_action( 'widgets_init', 'aq_register_custom_widgets' );

function aq_register_custom_widgets() {
	register_widget( 'aq_widget_twitter' );
	register_widget( 'aq_widget_social_icons' );
}