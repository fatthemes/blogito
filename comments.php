<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package blogito
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

<div id="comments" class="comments-area col-md-12">


	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title"><span>
		<?php
		printf(// WPCS: XSS OK.
			// translators: number of comments.
			esc_html( _nx( '%1$s Comment', '%1$s Comments', get_comments_number(), 'comments title', 'blogito' ) ), number_format_i18n( get_comments_number() )
		);
		?>
		</span></h2>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'blogito' ); ?></h2>
		<div class="nav-links">

			<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'blogito' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'blogito' ) ); ?></div>

		</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
	<?php endif; // Check for comment navigation. ?>

		<ul class="comment-list">
		<?php
		wp_list_comments(
			array(
				'style' => 'ul',
				'short_ping' => true,
				'avatar_size' => '50',
				'callback' => 'blogito_comment',
			)
		);
		?>
		</ul><!-- .comment-list -->

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'blogito' ); ?></h2>
		<div class="nav-links">

			<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'blogito' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'blogito' ) ); ?></div>

		</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
	<?php endif; // Check for comment navigation. ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && '0' !== get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'blogito' ); ?></p>
	<?php endif; ?>

	<?php
	comment_form(
		array(
			'comment_field' => '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Comment', 'blogito' ) . '</label> <textarea id="comment" name="comment" rows="1" aria-required="true" required="required" placeholder="' . esc_html__( 'Comment', 'blogito' ) . '" ></textarea></p>',
			'comment_notes_before' => '',
			'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title"><span>',
			'title_reply_after' => '</span></h3>',
		)
	)
	?>

</div><!-- #comments -->
