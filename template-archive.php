<?php
/**
 * Template Name: Archive
 *
 * All posts and pages archive page template
 *
 * @package Basic
 */

get_header(); ?>
	
	<section <?php post_class(); ?>>
	
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
		<div class="eight columns">
		
			<?php the_content(); ?>
			<hr/>
			
		</div>
		
		<?php endwhile; endif; ?>
		
		<div class="archives">
		
			<div class="two-thirds column">
			
				<h5 class="styled"><?php _e('Latest posts', 'a10e'); ?></h5>
				
				<ul class="styled_ul">
					<?php
					// Get latest posts
					$recent_posts = wp_get_recent_posts();
					foreach( $recent_posts as $recent ){
						echo '<li><a href="' . get_permalink($recent["ID"]) . '" title="Look '.esc_attr($recent["post_title"]).'" >' .   $recent["post_title"].'</a> </li> ';
					}
					?>
				</ul>
			
				<h5 class="styled"><?php _e('Posts by month', 'a10e'); ?></h5>
			
				<ul class="styled_ul">
					<?php
					// Get monthly archives
					echo wp_get_archives('type=monthly');
					?>
				</ul>
				
				<h5 class="styled"><?php _e('Posts by year', 'a10e'); ?></h5>
				
				<ul class="styled_ul_last">
					<?php
					// Get monthly archives
					echo wp_get_archives('type=yearly');
					?>
				</ul>
					
			</div>
			
			<div class="one-third column">
			
				<h5><?php _e('Categories', 'a10e'); ?></h5>
				
					<ul>
					<?php wp_list_categories('orderby=name&title_li='); ?> 
					</ul>
					
				<h5><?php _e('Writers', 'a10e'); ?></h5>
				
					<ul>
						<?php 
						$args = array(
						    'orderby'       => 'name', 
						    'order'         => 'ASC', 
						    'number'        => null,
						    'optioncount'   => false, 
						    'exclude_admin' => false, 
						    'show_fullname' => false,
						    'hide_empty'    => false,
						    'echo'          => true,
						    'style'         => 'list',
						    'html'          => true );
						 
						 wp_list_authors($args); ?>
						    
					</ul>
			</div>
			
		</div>
		
		<br class="clear">
		
	</section>
	
<?php
get_footer();