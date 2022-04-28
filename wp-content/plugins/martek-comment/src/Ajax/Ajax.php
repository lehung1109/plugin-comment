<?php namespace MartekComment\Ajax;

use Premmerce\SDK\V2\FileManager\FileManager;

/**
 * Class Admin
 *
 * @package MartekComment\Admin
 */
class Ajax {

	/**
	 * @var FileManager
	 */
	private $fileManager;

	/**
	 * Admin constructor.
	 *
	 * Register menu items and handlers
	 *
	 * @param FileManager $fileManager
	 */
	public function __construct( FileManager $fileManager ) {
		$this->fileManager = $fileManager;

		// ajax function for comment form
		add_action( 'wp_ajax_handle_comment_form', [ $this, 'handle_comment_form' ] );
		add_action( 'wp_ajax_nopriv_handle_comment_form', [ $this, 'handle_comment_form' ] );
	}

    /**
     * Handle comment form
     */
    public function handle_comment_form()
    {
		$description = ! empty( $_POST['description'] ) ? sanitize_text_field( $_POST['description'] ) : '';
		$post_id = ! empty( $_POST['post_id'] ) ? sanitize_text_field( $_POST['post_id'] ) : 0;
		$user_id = ! empty( $_POST['user_id'] ) ? sanitize_text_field( $_POST['user_id'] ) : 0;
		$name = ! empty( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : 0;
		$phone = ! empty( $_POST['phone'] ) ? sanitize_text_field( $_POST['phone'] ) : 0;
		$comment_type = ! empty( $_POST['comment_type'] ) ? sanitize_text_field( $_POST['comment_type'] ) : 'question';
		$errors = [];

		if ( empty( $name ) ) {
			$errors[] = 'Tên không được bỏ trống';
		}

		if ( empty( $phone ) ) {
			$errors[] = 'Mobile không được bỏ trống';
		}

		if ( empty( $description ) ) {
			$errors[] = 'Nội dung không được bỏ trống';
		}

		if ( ! empty( $errors ) ) {
			wp_send_json_error([
				'errors' => $errors
			]);
			die;
		}

		// insert comment
		$comment_id = wp_insert_comment([
			'comment_approved' => 0,
			'comment_author' => $name,
			'comment_content' => $description,
			'comment_parent' => 0,
			'comment_post_ID' => $post_id,
			'comment_type' => $comment_type,
			'user_id' => $user_id
		]);

		if ( empty( $comment_id ) || is_wp_error( $comment_id ) ) {
			wp_send_json_error([
				'error' => 'Có lỗi xảy ra, vui lòng thử lại sau.'
			]);
			die;
		}

		update_field( 'phone', $phone, 'comment_' . $comment_id );

		wp_send_json_success([
			'error' => false
		]);
		die;
    }

}