<div class="metadata">
	<span><i class="icon-pencil"></i><?php the_author_posts_link(); ?></span>
	<span><i class="icon-time"></i><?php the_time('F jS, Y'); ?></span>
	<span><i class="icon-list"></i><?php the_category(', '); ?></span>
	<?php if(has_tag()) { ?><span><i class="icon-tags"></i><?php the_tags('', ', ', ''); ?></span><?php } ?>
</div>