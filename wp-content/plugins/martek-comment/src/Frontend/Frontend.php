<?php namespace MartekComment\Frontend;

use Premmerce\SDK\V2\FileManager\FileManager;

/**
 * Class Frontend
 *
 * @package MartekComment\Frontend
 */
class Frontend {


	/**
	 * @var FileManager
	 */
	private $fileManager;

	public function __construct( FileManager $fileManager ) {
		$this->fileManager = $fileManager;

		add_shortcode( 'martek-comment-post-type', [ $this, 'do_pr_post_type' ] );

		// override template comment default
		add_filter( 'comments_template', [ $this, 'template_comment_uri' ] );

        // include comment template
		add_action( 'martek_comment_post_type_comments', [ $this, 'render_template_comments' ] );

		// include popup comment form template
		add_action( 'martek_comment_post_type_comments', [ $this, 'render_template_comment_popup' ], 100 );

		// add style and js
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_script' ] );
	}

	/**
	 * build comment args
	 */
	public static function build_comment_args( $args ) {
		global $post;

		$comment_args = array(
			'orderby'                   => 'comment_date_gmt',
			'order'                     => get_option( 'comment_order' ) ?: 'ASC',
			'status'                    => 'approve',
			'post_id'                   => $post->ID,
			'no_found_rows'             => false,
			'update_comment_meta_cache' => false,
		);

		if ( get_option( 'thread_comments' ) ) {
			$comment_args['hierarchical'] = 'threaded';
		} else {
			$comment_args['hierarchical'] = false;
		}

		if ( is_user_logged_in() ) {
			$comment_args['include_unapproved'] = array( get_current_user_id() );
		} else {
			$unapproved_email = wp_get_unapproved_comment_author_email();

			if ( $unapproved_email ) {
				$comment_args['include_unapproved'] = array( $unapproved_email );
			}
		}

		if ( get_option( 'page_comments' ) ) {
			$per_page = (int) get_option( 'comments_per_page' );

			$comment_args['number'] = $per_page;
			$page                   = get_query_var('review-page') ? get_query_var('review-page') : 1;

			if ( $page ) {
				$comment_args['offset'] = ( $page - 1 ) * $per_page;
			} elseif ( 'oldest' === get_option( 'default_comments_page' ) ) {
				$comment_args['offset'] = 0;
			} else {
				$top_level_query = new \WP_Comment_Query();
				$top_level_args  = array(
					'count'   => true,
					'orderby' => false,
					'post_id' => $post->ID,
					'status'  => 'approve',
				);

				if ( $comment_args['hierarchical'] ) {
					$top_level_args['parent'] = 0;
				}

				if ( isset( $comment_args['include_unapproved'] ) ) {
					$top_level_args['include_unapproved'] = $comment_args['include_unapproved'];
				}

				$top_level_count = $top_level_query->query( $top_level_args );

				$comment_args['offset'] = ( ceil( $top_level_count / $per_page ) - 1 ) * $per_page;
			}
		}

        $comment_args = wp_parse_args( $args, $comment_args );

		return $comment_args;

	}

	/**
	 * Enqueue script for review
	 *
	 * @return void
	 */
	public function enqueue_script() {
		wp_enqueue_script(
			'jquery-blockui',
			$this->fileManager->getPluginUrl() . '/assets/frontend/jquery.blockUI.min.js',
			array( 'jquery' ),
			'2.70',
			true
		);

		wp_enqueue_script(
	        'martek-comment-script',
	        $this->fileManager->getPluginUrl() . '/assets/frontend/martek-comment.js',
	        array('jquery-blockui', 'jquery'),
			'1.0.0',
			true
        );

		wp_localize_script(
			'martek-comment-script',
			'comment_ajax_object',
			array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
		);


		wp_enqueue_style(
	        'martek-comment-style',
	        $this->fileManager->getPluginUrl() . '/assets/frontend/martek-comment.css'
        );
	}

	/**
	 * Render template shortcode
	 */
	public function do_pr_post_type() {
		global $withcomments, $post;

		if ( ! ( is_single() || is_page() || $withcomments ) || empty( $post ) ) {
			return '';
		}


		return $this->fileManager->renderTemplate( 'frontend/martek-comment-post-type.php' );
	}

	/**
	 * Include template comment
	 */
	public function template_comment_uri( $template_uri ) {
		return $this->fileManager->locateTemplate( 'frontend/default.php' );
	}

	/**
	 * @return void
	 */
	public function render_template_comments() {
		$comment_args = Frontend::build_comment_args( [ 'type' => 'comment' ] );

		$comment_query = new \WP_Comment_Query( $comment_args );
		$comments = $comment_query->comments;

        // include template
		$this->fileManager->includeTemplate(
			'frontend/comments.php',
			[
				'fileManager' => $this->fileManager,
				'comments' => $comments,
				'total_number_page' => $comment_query->max_num_pages,
				'total_comments' => $comment_query->found_comments,
			]
		);
	}

	/**
	 * render template image popup
	 */
	public function render_template_comment_popup() {

		$this->fileManager->includeTemplate(
			'frontend/comment-popup.php',
			[
				'fileManager' => $this->fileManager
			]
		);
	}

}