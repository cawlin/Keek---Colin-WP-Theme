<?php 
$show_thumb = get_post_meta(get_the_ID(), 'aq_post_thumbnail', TRUE);
$thumb = wp_get_attachment_url( get_post_thumbnail_id(),'full');
$image = aq_resize( $thumb, 1000, 400, true );
$show_thumb = 'yes';
?>

<?php if ($show_thumb == 'yes' && has_post_thumbnail() ) : ?>

<div class="post_image">
	<img src="<?php echo $image; ?>" alt="">
</div>

<?php endif; ?>

<section <?php post_class(); ?>>

	<div class="eight columns">
		<h4 class="post_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		
		<?php

		if( get_post_type() != 'page' ) get_template_part('includes/post-date');
		
		the_content( sprintf('<button class="float_right">%s</button', 'READ MORE'), FALSE);
		
		if(is_single()) {

			get_template_part('includes/post-meta');

			wp_link_pages();

			comments_template();

		}

		?>
		
	</div>
	<br class="clear" />

</section>