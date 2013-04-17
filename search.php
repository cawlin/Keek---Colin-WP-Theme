<?php  get_header(); ?>

<section class="archive-title">
	<div class="eight columns">
		
		<?php if (have_posts()) : ?>
		<h3><?php printf(__('Search results for "%s"', 'aq10e'), get_search_query() ); ?></h3>
		<?php else : ?>
		<h3><?php printf(__('Sorry, nothing found for "%s"', 'aq10e'), get_search_query() ); ?></h3>
		<?php endif; ?>
		
	</div>
	<br class="clear" />
</section>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
	<?php
	
	if(get_post_format()) {
		get_template_part( 'includes/format/' . get_post_format() );
	} else {
		get_template_part( 'includes/format/standard' );
	}
	
	?>

<?php endwhile; endif; ?>

<div class="pagination">
	<?php if (function_exists("aq_pagination")) { aq_pagination(); } ?>
</div>

<?php get_footer() ?>