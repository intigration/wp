<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 * @since newspaperss 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<div class="comment-title block-title-wrap">

		<h2 class="comments-title">
			<i class="fa fa-comments"></i>
			<?php
				$newspaperss_comments_number = get_comments_number();
				if ( 1 === $newspaperss_comments_number ) {
					/* translators: %s: post title */
					printf( _x( 'One thought on &ldquo;%s&rdquo;', 'comments title', 'newspaperss' ), get_the_title() );
				} else {
					printf(
						/* translators: 1: number of comments, 2: post title */
						_nx(
							'%1$s COMMENTS',
							'%1$s COMMENTS',
							$newspaperss_comments_number,
							'comments title',
							'newspaperss'
						),
						number_format_i18n( $newspaperss_comments_number )

					);
				}
			?>
		</h2>
	</div>


		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ul',
					'short_ping'  => true,
					'avatar_size' => 42,
				) );
			?>
		</ol><!-- .comment-list -->

		<div class="newspaperss_nav">
        <?php paginate_comments_links( array('prev_text' => '&laquo;', 'next_text' => '&raquo;')) ?>
        </div>

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'newspaperss' ); ?></p>
	<?php endif; ?>

	<?php
		comment_form( array(
			'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
			'title_reply_after'  => '</h2>',
			'title_reply' => esc_html__('LEAVE A RESPONSE','newspaperss'),
			'comment_notes_after' => '',
		) );
	?>

</div><!-- .comments-area -->
