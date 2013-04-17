<?php

get_header();

	if (have_posts()) : while (have_posts()) : the_post();
		
		if(get_post_format()) {
			get_template_part( 'includes/format/' . get_post_format() );
		} else {
			get_template_part( 'includes/format/standard' );
		}
	
	endwhile; endif;
	
get_footer();