	<footer>
		<div class="slate">
			<div class="four columns">
				<?php if (function_exists('dynamic_sidebar') && is_active_sidebar('Footer Widgets Left'))
					dynamic_sidebar('Footer Widgets Left'); ?>
			</div>
			<div class="four columns">
				<?php if (function_exists('dynamic_sidebar') && is_active_sidebar('Footer Widgets Right'))
					dynamic_sidebar('Footer Widgets Right'); ?>
			</div>
		</div>
	</footer>

	<?php wp_footer(); ?>

<!-- End Document
================================================== -->
</body>
</html>