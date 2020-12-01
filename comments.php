<?php

function format_comment($comment, $args, $depth) {

$GLOBALS['comment'] = $comment; ?>

<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	<b><?php echo get_comment_author(); ?></b>
	<span class="comment-date"><?php printf(__('%1$s'), get_comment_date(), get_comment_time()) ?></span>
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
		<h3 id="comments">
			<?php

			printf(
				_n('%1$s comment.', '%1$s comments.', get_comments_number()),
				number_format_i18n(get_comments_number()),
				'&#8220;' . get_the_title() . '&#8221;'
			);

			?>
		</h3>

		<!--	<div class="navigation">-->
		<!--		<div class="alignleft">--><?php //previous_comments_link(); ?><!--</div>-->
		<!--		<div class="alignright">--><?php //next_comments_link(); ?><!--</div>-->
		<!--	</div>-->

		<ul class="commentlist">
			<?php wp_list_comments("callback=format_comment"); ?>
		</ul>

		<!--	<div class="navigation">-->
		<!--		<div class="alignleft">--><?php //previous_comments_link(); ?><!--</div>-->
		<!--		<div class="alignright">--><?php //next_comments_link(); ?><!--</div>-->
		<!--	</div>-->
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
		'fields' => apply_filters(
			'comment_form_default_fields', array(
				'author' => '<p class="comment-form-author">' . '<input id="author" placeholder="Your Name (No Keywords)" name="author" type="text" value="' .
					esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' />' .
					'<label for="author">' . __('Your Name') . '</label> ' .
					($req ? '<span class="required">*</span>' : '') .
					'</p>'
			,
				'email' => '<p class="comment-form-email">' . '<input id="email" placeholder="your-real-email@example.com" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) .
					'" size="30"' . $aria_req . ' />' .
					'<label for="email">' . __('Your Email') . '</label> ' .
					($req ? '<span class="required">*</span>' : '')
					.
					'</p>',
				'url' => '<p class="comment-form-url">' .
					'<input id="url" name="url" placeholder="http://your-site-name.com" type="text" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" /> ' .
					'<label for="url">' . __('Website', 'domainreference') . '</label>' .
					'</p>'
			)
		),
		'comment_field' => '<p class="comment-form-comment">' .
			'<label for="comment">' . __('Your comment') . '</label>' .
			'<textarea id="comment" name="comment" placeholder="" cols="45" rows="8" aria-required="true"></textarea>' .
			'</p>',
		'comment_notes_after' => '',
		'title_reply' => '<h5>Post a comment</h5>'
	); ?>

	<?php comment_form($args); ?>

