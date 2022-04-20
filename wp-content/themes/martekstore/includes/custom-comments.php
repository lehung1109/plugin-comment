<?php
/**
 * Comment layout
 *
 * @package MarTek
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'martek_comment' ) ) :
	/**
	 * Template for comments and pingbacks:
	 * add function to comments.php ... wp_list_comments( array( 'callback' => 'martek_comment' ) );
	 *
	 * @since v1.0
	 */
	function martek_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback':
			case 'trackback':
				?>
				<li class="post pingback">
				<p><?php esc_html_e( 'Pingback:', 'understrap' ); ?><?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'understrap' ), '<span class="edit-link">', '</span>' ); ?></p>
				<?php
				break;
			default:
				?>
				<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
				<article id="comment-<?php comment_ID(); ?>" class="comment">
					<footer class="comment-meta">
						<div class="comment-author vcard d-inline-flex align-items-center">
							<?php
							//$avatar_size = ( '0' !== $comment->comment_parent ? 40 : 40 );
							echo get_avatar( $comment, 49, '', get_the_author(), ['class' => 'rounded-circle mr-2'] );

							echo '<div class="comment-info">';
							/* translators: 1: comment author, 2: date and time */
							printf(
								__( '%1$s %2$s', 'understrap' ),
								sprintf( '<strong class="fn">%s</strong>', get_comment_author_link() ),
								sprintf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
									esc_url( get_comment_link( $comment->comment_ID ) ),
									get_comment_time( 'c' ),
									/* translators: 1: date, 2: time */
									sprintf( esc_html__( '%1$s ago', 'understrap' ), human_time_diff( (int) get_comment_time( 'U' ), current_time( 'timestamp' ) ) )
								)
							);
							echo '</div>';

							edit_comment_link( __( 'Edit', 'understrap' ), '<span class="edit-link ml-3">', '</span>' );
							?>
						</div>

						<?php if ( '0' === $comment->comment_approved ) : ?>
							<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'understrap' ); ?></em>
							<br/>
						<?php endif; ?>

						<div class="comment-content ml-md-9">
							<?php comment_text(); ?>

							<div class="reply mb-3">
								<?php
								comment_reply_link( array_merge( $args, array(
									'reply_text' => __( 'Reply', 'understrap' ) . ' <span>&darr;</span>',
									'depth'      => $depth,
									'max_depth'  => $args['max_depth']
								) ) );
								?>
							</div>
						</div>
					</footer>
				</article>
				<?php
				break;
		endswitch;
	}
endif;

// Add Bootstrap classes to comment form fields.
add_filter( 'comment_form_default_fields', 'martek_bootstrap_comment_form_fields' );

if ( ! function_exists( 'martek_bootstrap_comment_form_fields' ) ) {
	/**
	 * Add Bootstrap classes to WP's comment form default fields.
	 *
	 * @param array $fields {
	 *     Default comment fields.
	 *
	 *     @type string $author  Comment author field HTML.
	 *     @type string $email   Comment author email field HTML.
	 *     @type string $url     Comment author URL field HTML.
	 *     @type string $cookies Comment cookie opt-in field HTML.
	 * }
	 *
	 * @return array
	 */
	function martek_bootstrap_comment_form_fields( $fields ) {

		$replace = array(
			'<p class="' => '<div class="form-group ',
			'<input'     => '<input class="form-control" ',
			'</p>'       => '</div>',
		);

		if ( isset( $fields['author'] ) ) {
			$fields['author'] = strtr( $fields['author'], $replace );
		}
		if ( isset( $fields['email'] ) ) {
			$fields['email'] = strtr( $fields['email'], $replace );
		}
		if ( isset( $fields['url'] ) ) {
			$fields['url'] = strtr( $fields['url'], $replace );
		}

		$replace = array(
			'<p class="' => '<div class="form-group form-check ',
			'<input'     => '<input class="form-check-input" ',
			'<label'     => '<label class="form-check-label" ',
			'</p>'       => '</div>',
		);
		if ( isset( $fields['cookies'] ) ) {
			$fields['cookies'] = strtr( $fields['cookies'], $replace );
		}

		return $fields;
	}
} // End of if function_exists( 'martek_bootstrap_comment_form_fields' )

// Add Bootstrap classes to comment form submit button and comment field.
add_filter( 'comment_form_defaults', 'martek_bootstrap_comment_form' );

if ( ! function_exists( 'martek_bootstrap_comment_form' ) ) {
	/**
	 * Adds Bootstrap classes to comment form submit button and comment field.
	 *
	 * @param string[] $args Comment form arguments and fields.
	 *
	 * @return string[]
	 */
	function martek_bootstrap_comment_form( $args ) {
		$commenter     = wp_get_current_commenter();
		$user          = wp_get_current_user();

		$req      = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true' required" : '' );
		$fields   = array(
			'author'  => '<div class="row comment-fields"><div class="col-md-6 col-sm-12 mb-3">' .
			             '<input class="form-control" type="text" id="author" name="author" placeholder="' . ( $req ? 'Họ tên *' : 'Họ tên' ) . '" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' /></div>',
			'email'   => '<div class="col-md-6 col-sm-12 mb-3">' .
			             '<input class="form-control" type="email" id="email" name="email" placeholder="' . ( $req ? 'Email *' : 'Email' ) . '" value="' . esc_attr( $commenter['comment_author_email'] ) . '"' . $aria_req . ' /></div></div>',
		);

		return array(
			'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
			'comment_field'        => '<div class="row comment-textarea" ><div class="col-sm-12 mb-3 mb-lg-4"><textarea id="comment" name="comment" class="form-control" rows="5" aria-required="true" required placeholder="' . ( $req ? 'Nội dung bình luận *' : 'Nội dung bình luận' ) . '"></textarea></div></div>',
			/** This filter is documented in wp-includes/link-template.php */
			'must_log_in'          => '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'understrap' ), wp_login_url( apply_filters( 'the_permalink', get_the_permalink( get_the_ID() ) ) ) ) . '</p>',
			/** This filter is documented in wp-includes/link-template.php */
			'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'understrap' ), get_edit_user_link(), $user->display_name, wp_logout_url( apply_filters( 'the_permalink', get_the_permalink( get_the_ID() ) ) ) ) . '</p>',
			'comment_notes_before' => '',
			'comment_notes_after'  => '',
			'id_form'              => 'commentform',
			'id_submit'            => 'submit',
			'class_submit'         => 'btn btn-comment bg-primary text-white text-uppercase',
			'name_submit'          => 'submit',
			'title_reply'          => '',
			'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'understrap' ),
			'cancel_reply_link'    => esc_html__( 'Cancel reply', 'understrap' ),
			'label_submit'         => 'Gửi bình luận',
			'submit_button'        => '<input type="submit" id="%2$s" name="%1$s" class="%3$s" value="%4$s" />',
			'submit_field'         => '<div class="form-submit text-center">%1$s %2$s</div>',
			'format'               => 'html5',
		);
	}
} // End of if function_exists( 'martek_bootstrap_comment_form' ).


// Add note if comments are closed.
add_action( 'comment_form_comments_closed', 'martek_comment_form_comments_closed' );

if ( ! function_exists( 'martek_comment_form_comments_closed' ) ) {
	/**
	 * Displays a note that comments are closed if comments are closed and there are comments.
	 */
	function martek_comment_form_comments_closed() {
		if ( get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) {
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'martek' ); ?></p>
			<?php
		}
	}
} // End of if function_exists( 'martek_comment_form_comments_closed' ).
