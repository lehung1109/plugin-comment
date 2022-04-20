<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div class="comments-area mb-3" id="comments">

	<?php // You can start editing here -- including this comment! ?>

	<h4 class="comments-title mb-3">Để lại bình luận, đánh giá cho bài viết này</h4>

	<?php if ( have_comments() ) : ?>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through. ?>

			<nav class="comment-navigation" id="comment-nav-above">

				<h1 class="sr-only"><?php esc_html_e( 'Comment navigation', 'understrap' ); ?></h1>

				<?php if ( get_previous_comments_link() ) { ?>
					<div class="nav-previous">
						<?php previous_comments_link( __( '&larr; Older Comments', 'understrap' ) ); ?>
					</div>
				<?php } ?>

				<?php	if ( get_next_comments_link() ) { ?>
					<div class="nav-next">
						<?php next_comments_link( __( 'Newer Comments &rarr;', 'understrap' ) ); ?>
					</div>
				<?php } ?>

			</nav><!-- #comment-nav-above -->

		<?php endif; // Check for comment navigation. ?>

		<ul class="comment-list list-unstyled">

			<?php
			/**
			 * Loop through and list the comments. Tell wp_list_comments()
			 * to use theme_comment() to format the comments.
			 * If you want to overload this in a child theme then you can
			 * define theme_comment() and that will be used instead.
			 * See theme_comment() in my-theme/functions.php for more.
			 */
			wp_list_comments( array( 'callback' => 'understrap_comment' ) );
			?>

		</ul>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through. ?>

			<nav class="comment-navigation" id="comment-nav-below">

				<h1 class="sr-only"><?php esc_html_e( 'Comment navigation', 'understrap' ); ?></h1>

				<?php if ( get_previous_comments_link() ) { ?>
					<div class="nav-previous">
						<?php previous_comments_link( __( '&larr; Older Comments', 'understrap' ) ); ?>
					</div>
				<?php } ?>

				<?php	if ( get_next_comments_link() ) { ?>
					<div class="nav-next">
						<?php next_comments_link( __( 'Newer Comments &rarr;', 'understrap' ) ); ?>
					</div>
				<?php } ?>

			</nav><!-- #comment-nav-below -->

		<?php endif; // Check for comment navigation. ?>

	<?php endif; // End of if have_comments(). ?>

	<?php comment_form(); // Render comments form. ?>

</div><!-- #comments -->
