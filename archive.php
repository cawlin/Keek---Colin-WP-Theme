<?php get_header(); ?>

<section class="archive-title">
	<div class="eight columns">

		<?php /* If this is a category archive */ if (is_category()) { ?>
			<h3>Archive for the &#8216;<?php single_cat_title(); ?>&#8217; category</h3>
			<div class="page-description"></div>
		<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
			<h3><?php _e('Posts Tagged With &#8216', 'aq10e') . single_tag_title(); ?>&#8217;</h3>
		<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
			<h3><?php _e('Archive for ', 'aq10e') . the_time('F jS, Y'); ?></h3>
		<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
			<h3><?php _e('Archive for ', 'aq10e') . the_time('F, Y'); ?></h3>
		<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
			<h3><?php _e('Archive for ','aq10e') .  the_time('Y'); ?></h3>
		<?php /* If this is an author archive */ } elseif (is_author()) { ?>
			<h3><?php _e('Author Archive', 'aq10e') ?></h3>
		<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
			<h3><?php _e('Blog Archive', 'aq10e') ?></h3>
		<?php } ?>
		
	</div>
	<br class="clear" />
</section>

<?php 

if (have_posts()) :

	while (have_posts()) : the_post();
	
		if(get_post_format()) {
			get_template_part( 'includes/format/' . get_post_format() );
		} else {
			get_template_part( 'includes/format/standard' );
		}
		
	endwhile;
	
	?><div class="pagination"><?php
	
	if (function_exists("aq_pagination")) { 
		aq_pagination(); 
	} else {
		posts_nav_link();
	} 
	
	?></div><?php
	
else :
	
	get_template_part( 'includes/format/no-post');
	
endif;

get_footer(); 

?>
