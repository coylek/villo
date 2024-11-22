<?php

/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package villoz
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
	return;
}
?>

<div id="comments" class="comments-area comments-form">

	<?php
	// You can start editing here -- including this comment!
	if (have_comments()) :
	?>
		<h3 class="comment-one__title">
			<?php
			$villoz_comment_count = get_comments_number();
			if ('1' === $villoz_comment_count) {
				printf(
					/* translators: 1: title. */
					esc_html__('One thought on &ldquo;%1$s&rdquo;', 'villoz'),
					'<span>' . wp_kses_post(get_the_title()) . '</span>'
				);
			} else {
				printf(
					/* translators: 1: comment count number, 2: title. */
					esc_html(_nx('%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $villoz_comment_count, 'comments title', 'villoz')),
					number_format_i18n($villoz_comment_count), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					'<span>' . wp_kses_post(get_the_title()) . '</span>'
				);
			}
			?>
		</h3><!-- .comments-title -->



		<ul class="comment-list">
			<?php
			wp_list_comments(array(
				'style'      => 'ul',
				'avatar_size' => 90,
				'short_ping' => true,
			));
			?>
		</ul><!-- .comment-list -->
		<?php

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if (!comments_open()) :
		?>
			<p class="no-comments"><?php esc_html_e('Comments are closed.', 'villoz'); ?></p>
	<?php
		endif;

	endif; // Check for have_comments().

	$villoz_commenter = wp_get_current_commenter();
	$villoz_comment_fields =  array(
		'author' => '<div class="form-one__control"><input type="text" name="author" placeholder="' . esc_attr__('Your name *', 'villoz') . '" value="' . esc_attr($villoz_commenter['comment_author']) . '"></div>',
		'email'	=> '<div class="form-one__control"><input type="email" name="email" placeholder="' . esc_attr__('Email address *', 'villoz') . '" value="' . esc_attr($villoz_commenter['comment_author_email']) . '"></div>',
	);
	$villoz_comments_args = array(
		'fields'                => apply_filters('comment_form_default_fields', $villoz_comment_fields),
		'class_form'            => 'comments-form__form form-one form-one__group reply-form',
		'class_submit'          => 'villoz comment-form__btn',
		'title_reply_before'    => '<h3 class="comments-form__title">',
		'title_reply'           => esc_html__('Leave a Comment', 'villoz'),
		'title_reply_after'     => '</h3>',
		'comment_notes_before'  => '',
		'comment_field'         => ' <div class="form-one__control form-one__control--full"><textarea name="comment" placeholder="' . esc_attr__('Write comment', 'villoz') . '" ></textarea></div>',
		'comment_notes_after'   => '',
		'submit_button'   => '<button type="submit" class="villoz-btn villoz-btn--base"><i>' . esc_html__(' Submit Comment', 'villoz') . '</i><span>' . esc_html__(' Submit Comment', 'villoz') . '</span></button>',
	);
	comment_form($villoz_comments_args);
	?>

</div><!-- #comments -->