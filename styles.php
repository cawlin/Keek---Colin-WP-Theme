<?php
/**
 * Custom dynamic theme stylings
 *
 * @package Basic
 * @author Syamil MJ
 */
 
$data = get_option(AQ_OPTIONS);
$body_typo = $data['body_typography'];
$head_typo = $data['head_typography'];
?>

<style type="text/css" media="screen">
<?php if($data['use_custom_body']) { ?>
/** Typography */
body {
	font-family: <?php echo aq_font_stack($body_typo['face']); ?>;
	color: <?php echo $body_typo['color']; ?>;
	font-size: <?php echo  $body_typo['size']; ?>;
	line-height: <?php echo  $body_typo['height']; ?>;
}
<?php } ?>

<?php if($data['use_custom_head']) { ?>
h1, h2, h3, h4, h5, h6 {
	font-family: <?php echo aq_font_stack($head_typo['face']); ?>;
	font-weight: <?php echo $head_typo['style']; ?>;
	color: <?php echo $head_typo['color']; ?>;
}
<?php } ?>

/** Colors */
header nav ul li a, header nav ul li a:visited, header nav ul li.search { 
	color: <?php echo $data['nav_color']; ?>;
}
header nav ul li a:hover, header nav ul li.search:hover {
	color: <?php echo $data['nav_color_hover']; ?>;
}
a:hover {
	color: <?php echo $data['link_color']; ?>;
}
.highlight {
	background: <?php echo $data['highlight_color']; ?>;
}
button, .btn, .form-submit input { 
	background: <?php echo $data['button_color']; ?>;
}
::selection { background: <?php echo $data['selection_color']; ?>; color: #fff; }
::-moz-selection { background: <?php echo $data['selection_color']; ?>; color: #fff; }

body {
	background: <?php echo $data['body_bg']; ?>;
}
section {
	background: <?php echo $data['content_bg']; ?>;
}

<?php echo $data['custom_css']; ?>

</style>