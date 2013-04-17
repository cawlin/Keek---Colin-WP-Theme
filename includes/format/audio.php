<div class="post_audio">
	<?php
	$audio = get_post_meta( get_the_ID(), $key = 'aq_format_audio', $single = true );
	if($audio) echo htmlspecialchars_decode($audio);
	?>
</div>
<section <?php post_class(); ?>>

	<div class="eight columns">

		<h4 class="post_title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
		
		<?php 

		get_template_part('includes/post-date');

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