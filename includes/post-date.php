<div class="post_date">
	<?php 
	$year = get_the_time('Y');
	$month = get_the_time('m');
	$archive = get_month_link( $year, $month );
	?>
	<a href="<?php echo $archive; ?>"><?php the_time('M j'); ?></a>
</div>