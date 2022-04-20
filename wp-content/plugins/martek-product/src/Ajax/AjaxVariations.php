<?php namespace Product\Ajax;

use Product\Helpers\TemplateFile;

class AjaxVariations {

	/**
	 * @var TemplateFile
	 */
	private $templateFile;

	/**
	 * @var string action name for ajax call
	 */
	protected $action = 'product_variations';

	public function __construct(TemplateFile $templateFile) {
		$this->templateFile = $templateFile;

		add_action( 'wp_enqueue_scripts', [ $this, 'register_script' ] );
		add_action( 'wp_ajax_' . $this->action, [ $this, 'handle' ] );
		add_action( 'wp_ajax_nopriv_' . $this->action, [ $this, 'handle' ] );
	}

	public function register_script() {
		// show on only selected post types
		if ( is_single() && is_singular( 'product' ) ) {
			wp_enqueue_script( 'mp-variations', PRODUCT_URL . 'assets/js/variations.js', array( 'jquery' ), null, true );
			wp_add_inline_script( 'mp-variations', 'var nonce_product_variations = "' . wp_create_nonce( "product_variations_nonce" ) . '";var ajaxurl = "' . admin_url( 'admin-ajax.php' ) . '";', true );
		}
	}

	public function handle() {

		// Check nonce
		if ( ! wp_verify_nonce( $_REQUEST['nonce'], "product_variations_nonce" ) ) {
			exit( "No naughty business please." );
		}

		// Get product
		$post_id = intval( $_REQUEST['id'] );
		$variation_id   = intval( $_REQUEST['variation'] );

		$product = mp_get_product($post_id);

		// Send json
		wp_send_json_success(array(
			'price' => $product->get_price_html($variation_id),
			'description' => $product->get_description_html($variation_id),
			'quantity' => $product->get_quantity_html($variation_id),
			'status' => $product->get_status_html($variation_id),
			'image_id' => $product->get_image_id($variation_id),
			'image' => $product->get_image_html($variation_id),
			'order_button' => $product->get_order_button_html($variation_id),
		), 200);

		// Die WP
		wp_die();
	}
}