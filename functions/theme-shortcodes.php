<?php
/**
 * Theme Shortcodes
 * =========================== */


/** Highlights text */
function aq_shortcode_highlight($atts, $content = null) {

	$defaults = array();

	extract( shortcode_atts( $defaults, $atts ) );
	
	return '<span class="highlight">' . $content . '</span>';

}
add_shortcode( 'hl', 'aq_shortcode_highlight' );

/** Horizontal rule */
function aq_shortcode_hr($atts, $content = null) {

	$defaults = array();

	extract( shortcode_atts( $defaults, $atts ) );
	
	return '<hr/>';

}
add_shortcode( 'hr', 'aq_shortcode_hr' );

/** Post Intro */
function aq_shortcode_post_intro($atts, $content = null) {

	$defaults = array();

	extract( shortcode_atts( $defaults, $atts ) );
	
	return '<p class="post_intro">' . $content . '</p>';

}
add_shortcode( 'post_intro', 'aq_shortcode_post_intro' );
