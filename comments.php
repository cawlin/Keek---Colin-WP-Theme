<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
	if ( post_password_required() ) { ?>
		This post is password protected. Enter the password to view comments.
	<?php
		return;
	}
?>

	<?php 
	// BEGIN the upper part of the comment block
	if ( have_comments() ) : ?>
	
	<div id="comments" class="comments cf">
			
		<h5><?php comments_number('No Responses', 'One Response', '% Responses' );?></h5>
		
		<ul class="commentlist">
				<?php wp_list_comments(array(
					'type' => 'comment', // Display Comments
					'avatar_size' => '50', // Adjust Avatar Size
					'callback' => 'aq_custom_comments' // Get Custom Comments Template
				)); ?>
		</ul>
	
		<div class="navigation">
			<div class="next-posts"><?php previous_comments_link() ?></div>
			<div class="prev-posts"><?php next_comments_link() ?></div>
		</div>
			
	<?php else : // this is displayed if there are no comments so far ?>
			
		<?php if ( comments_open() ) : ?>
			
	<div id="comments" class="comments cf">

		<h5><?php comments_number('No responses yet', 'One Response', '% Responses' );?></h5>
			
		<?php else : endif; // no comments $ comments are closed - show 'em nothing. ?>
			
	<?php endif; //END the upper part of the comment block?>
			
	<?php 			
	// this is the respond form, will only show up if commenting is open
	if ( comments_open() ) :
	
		$aria_req = '';
		$fields = array(
			'author' => '<p class="comment-form-author"><label for="author">' . __( 'Name', 'aq10e' ) . ' ' . ( $req ? '<span class="required">*</span>' : '' ) .'</label><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
			'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'aq10e' ) . ' ' . ( $req ? '<span class="required">*</span>' : '' ) . '</label><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
			'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website', 'aq10e' ) . '</label><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
		);
		$comment_field = '<p class="comment-form-comment"><label for="comment">' . __( 'Your Comment', 'aq10e' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>';
		
		$args = array(
			'fields' => $fields,
			'comment_field' => $comment_field,
			'label_submit' => __('Submit', 'aq10e'),
			'comment_notes_before' => '',
			'comment_notes_after' => '',
		);
		
		comment_form( $args );
			
	endif; // END respond form 

	if ( have_comments()) :	
	
		if (comments_open()): else: ?>
	
		<span class="closed-comments cf">Sorry, but commenting has been disabled.</span>
		
	<?php endif; endif;
	
	if ( have_comments() || comments_open()) :	?>
	
	</div><!-- END #comment-->

	<?php endif; ?>