<?php 

$args = array(
	'order'          => 'ASC',
	'post_type'      => 'attachment',
	'post_parent'    => $post->ID,
	'post_mime_type' => 'image',
	'post_status'    => null,
	'orderby'		 => 'menu_order',
	'numberposts'    => -1,
);
$attachments = get_posts($args);

$height = (int) get_post_meta( get_the_ID(), 'aq_format_gallery', true);
$crop = !empty($height) ? true : false;
	
wp_enqueue_script('flexslider');
	
?>
<div class="post_gallery">
	<div class="flexslider">
		<ul class="slides">
			<?php
			if ($attachments) {
				foreach ($attachments as $attachment) {
					$attachment_url = wp_get_attachment_url($attachment->ID , 'full');
					$image = aq_resize($attachment_url, 860, $height, $crop);
					echo '<li class="slide">';
						echo '<img src="'.$image.'"/>';
						
						if(!empty($attachment->post_excerpt)) {
							echo '<div class="caption">'.$attachment->post_excerpt.'</div>';
						}
						
					echo '</li>';
				}	
			}
			?>
		</ul>
	</div>
</div>

<section <?php post_class(); ?>>

	<div class="eight columns">
		<h4 class="post_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		
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