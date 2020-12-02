<?php

$args = array(
	'comment_field' => '<p class="comment-form-comment">' .
		'<label for="comment">' . __('Your comment') . '</label>' .
		'<textarea id="comment" name="comment" placeholder="" cols="45" rows="8" aria-required="true"></textarea>' .
		'</p>',
	'comment_notes_after' => '',
	'title_reply' => 'Post a new comment',
	'title_reply_before' => '<p id="reply-title" class="comment-reply-title">',
	'title_reply_after' => '</p>',
	'logged_in_as' => '',
	'title_reply_to' => 'Reply to %s?'
);

comment_form($args);

function format_comment($comment, $args, $depth) {

$GLOBALS['comment'] = $comment; ?>

<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">

	<p class="comment__author">
		<?php echo get_comment_author(); ?>
		<span class="comment__reply-link">
			<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</span>
	</p>

	<div class="comment__text">
		<?php comment_text(); ?>
	</div>

	<p class="comment__date">
		<?php echo get_comment_date("j/m/y, G:i");?>
	</p>

	<?php } ?>

	<?php if (have_comments()) : ?>
		<h3 class="visually-hidden">Comments</h3>
		<ul class="comment-list">
			<?php wp_list_comments("callback=format_comment"); ?>
		</ul>
	<?php else : // This is displayed if there are no comments so far. ?>

		<?php if (comments_open()) : ?>
			<!-- If comments are open, but there are no comments. -->

		<?php else : // Comments are closed. ?>
			<!-- If comments are closed. -->
			<p class="nocomments"><?php _e('Comments are closed.'); ?></p>

		<?php endif; ?>
	<?php endif; ?>


