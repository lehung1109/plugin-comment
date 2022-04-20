<?php namespace Product;

use Product\Helpers\TemplateFile;

class ProductService {

	private $product_id;

	private $templateFile;

	function __construct( $post_id ) {
		$this->product_id   = $post_id;
		$this->templateFile = new TemplateFile( __DIR__ );
	}

	public function get_product_variation( $variation_id = 0 ) {
		$product_variable = get_field( 'variable', $this->product_id );
		if ( $product_variable ) {
			return $product_variable[ $variation_id ];
		}

		return null;
	}

	public function get_variations() {
		$product_variable = get_field( 'variable', $this->product_id );
		$names            = [];

		if ( count( $product_variable ) > 1 ) {
			foreach ( $product_variable as $key => $variation ) {
				$names[ $key ] = $variation['name'];
			}
		}

		return $names ?? '';
	}

	public function get_variations_html() {
		return $this->templateFile->renderTemplate( 'single/variations.php', [
			'variations' => $this->get_variations()
		] );
	}

	public function get_name($variation_id = 0) {
		$product_data = $this->get_product_variation($variation_id);
		return $product_data['name'];
	}

	public function get_price_sale($variation_id = 0) {
		$product_data = $this->get_product_variation($variation_id);

		if ( ! $product_data ) {
			return '';
		}

		if ( $sale_price = $product_data['price']['sale_price'] ) {
			return $sale_price;
		}

		return null;
	}

	public function get_price_regular($variation_id = 0) {
		$product_data = $this->get_product_variation($variation_id);

		if ( ! $product_data ) {
			return '';
		}

		if ( $regular_price = $product_data['price']['regular_price'] ) {
			return $regular_price;
		}

		return null;
	}

	public function get_price($variation_id = 0) {
		if ( $sale_price = $this->get_price_sale($variation_id) ) {
			return $sale_price;
		} elseif ( $regular_price = $this->get_price_regular($variation_id) ) {
			return $regular_price;
		}

		return null;
	}

	public function get_price_html($variation_id = 0) {
		return $this->templateFile->renderTemplate( 'single/price.php', [
			'regular_price' => $this->get_price_regular($variation_id),
			'sale_price'    => $this->get_price_sale($variation_id)
		] );
	}

	public function get_description($variation_id = 0) {
		$product_data = $this->get_product_variation($variation_id);

		if ( ! $product_data ) {
			return '';
		}

		return $product_data['description'];
	}

	public function get_description_html($variation_id = 0) {
		return $this->templateFile->renderTemplate( 'single/description.php', [ 'description' => $this->get_description($variation_id) ] );
	}

	public function get_status($variation_id = 0) {
		$product_data = $this->get_product_variation($variation_id);

		if ( ! $product_data ) {
			return '';
		}

		if ( $product_data['quantity'] === '0' ) {
			return __( 'Out of stock', 'martek-product' );
		}

		return __( 'In stock', 'martek-product' );
	}

	public function get_status_html($variation_id = 0) {
		return $this->templateFile->renderTemplate( 'single/status.php', [ 'status' => $this->get_status($variation_id) ] );
	}

	public function get_image_id($variation_id = 0) {
		$product_data = $this->get_product_variation($variation_id);

		if ( ! $product_data['image'] ) {
			return get_post_thumbnail_id($this->product_id);
		}

		return $product_data['image']['id'];
	}

	public function get_image_html($variation_id = 0) {
		return $this->templateFile->renderTemplate( 'single/image.php', [ 'image_id' => $this->get_image_id($variation_id) ] );
	}

	public function get_gallery() {
		$gallery = get_field( 'gallery', $this->product_id );

		if ( $gallery ) {
			return $gallery;
		}

		return null;
	}

	public function get_gallery_html() {
		// Enqueue style and scripts
		wp_enqueue_style( 'mp-gallery', PRODUCT_URL . 'assets/css/gallery.css' );
		wp_enqueue_script( 'mp-gallery', PRODUCT_URL . 'assets/js/gallery.js' );

		return $this->templateFile->renderTemplate( 'single/gallery.php', [ 'gallery' => $this->get_gallery() ] );
	}

	public function get_quantity($variation_id = 0) {
		$product_data = $this->get_product_variation($variation_id);

		if ( ! $product_data ) {
			return '';
		}

		if ( $product_data['quantity'] === 0 ) {
			return '';
		} elseif ( empty( $product_data['quantity'] ) ) {
			return 10;
		}

		return $product_data['quantity'];
	}

	public function get_quantity_html($variation_id = 0) {
		return $this->templateFile->renderTemplate( 'single/quantity.php', [ 'quantity' => $this->get_quantity($variation_id) ] );
	}

	public function get_order_form() {
		echo $this->templateFile->renderTemplate( 'single/order-form.php', [
			'image_id' => $this->get_image_id(),
			'price' => $this->get_price(),
			'variation_name' => $this->get_name()
		]);
	}

	public function get_order_button_html($variation_id = 0, $class = '') {
		add_action( 'wp_footer', [ $this, 'get_order_form' ] );

		$product_data = $this->get_product_variation($variation_id);
		return $this->templateFile->renderTemplate( 'single/order-button.php', [
			'class' => $class,
			'price'     => $this->get_price($variation_id),
			'variation_id' => $variation_id,
			'variation_name'     => $product_data['name'],
		] );
	}

	public function get_requirement_form() {
		echo $this->templateFile->renderTemplate( 'single/requirement-form.php' );
	}

	public function get_requirement_button_html($class= '') {
		add_action( 'wp_footer', [ $this, 'get_requirement_form' ] );

		return $this->templateFile->renderTemplate( 'single/requirement-button.php', [
			'class' => $class,
		] );
	}
}