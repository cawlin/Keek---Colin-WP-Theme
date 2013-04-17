<?php 
get_header();

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