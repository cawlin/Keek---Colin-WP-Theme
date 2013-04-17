<?php

get_header();

	if (have_posts()) : while (have_posts()) : the_post(); 
	?>

	<section <?php post_class(); ?>>

		<div class="eight columns">
			<h4 class="post_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
			
			<?php

			the_content( sprintf('<button class="float_right">%s</button', 'READ MORE'), FALSE);

			wp_link_pages();

			comments_template();

			?>
		
		</div>
		<br class="clear" />

	</section>
	
	<?php
	endwhile; endif;
	
get_footer();

?>