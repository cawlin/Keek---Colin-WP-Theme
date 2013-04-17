<!DOCTYPE html>
<html class="no-js" xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><html <?php language_attributes(); ?>><![endif]-->

<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php wp_title(' | ', true, 'right'); ?><?php bloginfo( 'name' ); ?></title>

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Favicons
	================================================== -->
	<?php
	$options = get_option(AQ_OPTIONS);
	$favicon = isset($options['favicon']) && !empty($options['favicon']) ? $options['favicon'] : ''; 
	if($favicon) echo '<link rel="shortcut icon" href="'.$favicon.'">';
	?>

	<?php 
	wp_head();
	?>

</head>

<body <?php body_class(); ?>>

	<!-- Primary Page Layout
	================================================== -->
	<header>
		
		<div id="logo">
			
			<?php
			$logo = $options['logo'];
			if ($logo != '') { ?>
			<a href="<?php echo home_url(); ?>"><img src="<?php echo $logo; ?>" alt="logo"/></a>
			<?php } else { ?>
			<h4 class="logo"><a href="<?php echo home_url(); ?>"><?php bloginfo('name');?></a></h4>
			<?php } ?>
			
		</div>
		
		<div class="menubutton"><i class="icon-reorder"></i></div>

		<?php
		wp_nav_menu( array(
			'theme_location' => 'primary',
			'container' => 'nav',
			'container_id' => 'primary-nav',
			'fallback_cb' => 'aq_default_menu',
			'items_wrap'  => '<ul id="%1$s" class="%2$s">%3$s</ul><div class="search_popup">
			<form action="'. site_url() .'" id="searchform" method="get">
				<input name="s" type="text" value="Search..." onfocus="if (this.value == \'Search...\') {this.value = \'\';}" onblur="if (this.value == \'\') {this.value = \'Search...\';}"></input>
				<button type="submit">Search</button>
			</form>
		</div>'
			)
		);
		?>

		<br class="clear" />
	</header>