<?php

add_action('init','of_options');

if (!function_exists('of_options')) {
function of_options(){

/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();

// General Settings
$of_options[] = array( "name" => "General Settings",
                    "type" => "heading");
                    
$of_options[] = array( "name" => "Custom Logo",
					"desc" => __("Upload a custom logo for your site, or specify the image address of your online logo. (e.g. http://yoursite.com/logo.png)",'aq10e'),
					"id" => "logo",
					"std" => '',
					"type" => "media");
					
$of_options[] = array( "name" => "Custom Favicon",
					"desc" => "Upload a custom favicon (.ico/.png/.gif) image for your site here. Maximum size should be 32px x 32px.",
					"id" => "favicon",
					"std" => '',
					"type" => "upload");
								
// Typography
$of_options[] = array( "name" => "Typography",
					"type" => "heading");

$of_options[] = 
	array(
		'name'	=> 'Body Typography',
		'desc'	=> 'Use custom body typography?',
		'id'	=> 'use_custom_body',
		'std'	=> 1,
		'folds'	=> 1,
		'type'	=> 'checkbox'
	);
								
$of_options[] = 
	array( "name" => "",
		"desc" => "Specify the body font properties",
		"id" => "body_typography",
		"std" => array('size' => '14px','face' => 'helvetica','color' => '#838585', 'height' => '28px',),
		"type" => "typography",
		"fold" => "use_custom_body"
	);

$of_options[] = 
	array(
		'name'	=> 'Header Typography',
		'desc'	=> 'Use custom header typography?',
		'id'	=> 'use_custom_head',
		'std'	=> 1,
		'folds'	=> 1,
		'type'	=> 'checkbox'
	);
					
$of_options[] = 
array( "name" => "",
	"desc" => "Specify the heading style properties",
	"id" => "head_typography",
	"std" => array('face' => 'helvetica','style' => 'bold','color' => '#666666'),
	"type" => "typography",
	"fold" => "use_custom_head"	
);

$of_options[] = array( "name" =>  "Header Navigation Color",
					"desc" => "Pick color header navigation.",
					"id" => "nav_color",
					"std" => "#AAA28D",
					"type" => "color");

$of_options[] = array( "name" =>  "Header Navigation Color (Hover)",
					"desc" => "Pick color header navigation on hover.",
					"id" => "nav_color_hover",
					"std" => "#FFFFFF",
					"type" => "color");
					
$of_options[] = array( "name" =>  "Text Link Hover Color",
					"desc" => "Pick the default hover color for text links.",
					"id" => "link_color",
					"std" => "#FC6341",
					"type" => "color");
					
$of_options[] = array( "name" =>  "Text Highlight Color",
					"desc" => "Pick default color for highlighted texts.",
					"id" => "highlight_color",
					"std" => "#FC6341",
					"type" => "color");
					
$of_options[] = array( "name" =>  "Selection Color",
					"desc" => "Pick a selection color when user selected/highlighted texts on your site.",
					"id" => "selection_color",
					"std" => "#eb4d8c",
					"type" => "color");
					
$of_options[] = array( "name" =>  "Button Color",
					"desc" => "Pick the color for the buttons.",
					"id" => "button_color",
					"std" => "#FC6341",
					"type" => "color");                                              
    
// Styling Options
$of_options[] = array( "name" => "Styling Options",
					"type" => "heading");

$of_options[] = array( "name" =>  "Body Background Color",
					"desc" => "Pick a background color for the theme.",
					"id" => "body_bg",
					"std" => "#EFEDE9",
					"type" => "color");

$of_options[] = array( "name" =>  "Content Background Color",
					"desc" => "Pick a content background color for the theme.",
					"id" => "content_bg",
					"std" => "#FFFFFF",
					"type" => "color");
					
$of_options[] = array( "name" => "Custom CSS",
                    "desc" => "Quickly add some CSS to your theme by adding it to this block.",
                    "id" => "custom_css",
                    "std" => "",
                    "type" => "textarea");
					
// Backup Options
$of_options[] = array( "name" => "Backup Options",
					"type" => "heading");
					
$of_options[] = array( "name" => "Backup and Restore Options",
                    "id" => "aq_backup",
                    "std" => '',
                    "type" => "backup",
					"desc" => 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
					);
					
$of_options[] = array( "name" => "Transfer Theme Options Data",
                    "id" => "of_transfer",
                    "std" => "",
                    "type" => "transfer",
					"desc" => 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".
						',
					);
	// END of_options				
	}
}
?>
