<section <?php post_class(); ?>>

	<div class="eight columns">
		<?php

		$link = get_post_meta( get_the_ID(), $key = 'aq_format_link', $single = true );
		
		if($link)
			echo '<h4 class="post_title"><a href="'.$link.'">'. get_the_title() .'</a> <i class="icon-link"></i></h4>';

		get_template_part('includes/post-date');

		the_content();
		
		if(is_single()) {
		
			get_template_part('includes/post-meta');
			
			comments_template();
			
		}
		
		?>
	</div>
	<br class="clear" />

</section>