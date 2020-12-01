<?php

function format_comment($comment, $args, $depth) {

$GLOBALS['comment'] = $comment; ?>

<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
	<b><?php echo get_comment_author(); ?></b>
	<span class="comment-date"><?php printf(__('%1$s'), get_comment_date("j/m/y, g:ia")) ?></span>
	<div class="comment-text">
		<?php comment_text(); ?>
		<?php if ($comment->comment_approved == '0') : ?>
			<em>
				<php _e(
				'Your comment is awaiting moderation.') ?></em><br/>
		<?php endif; ?>
	</div>
	<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	<?php } ?>

	<?php if (have_comments()) : ?>
		<h3 class="visually-hidden">Comments</h3>
		<ul class="commentlist">
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

	<?php
	$args = array(
		'comment_field' => '<p class="comment-form-comment">' .
			'<label for="comment">' . __('Your comment') . '</label>' .
			'<textarea id="comment" name="comment" placeholder="" cols="45" rows="8" aria-required="true"></textarea>' .
			'</p>',
		'comment_notes_after' => '',
		'title_reply' => 'Post a comment'
	); ?>

	<?php comment_form($args); ?>

