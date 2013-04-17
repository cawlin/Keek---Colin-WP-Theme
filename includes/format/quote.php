<?php
	$quote_author = get_post_meta( $post->ID, $key = 'aq_format_quote', $single = true );
?>
<section <?php post_class(); ?>>
	
	<p>
		<?php 
		the_content(); 

		if($quote_author)
			echo '<span class="author">'. $quote_author .'</span>';
		?>
	</p>

</section>