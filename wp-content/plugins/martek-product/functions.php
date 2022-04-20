<?php use Product\ProductService;

/**
 * Product functions
 */

if ( ! function_exists( 'mp_get_product' ) ) {
	/**
	 * Get product service
	 *
	 * @param $post_id
	 *
	 * @return ProductService
	 */
	function mp_get_product( $post_id ) {
		return new ProductService( $post_id );
	}
}

if ( ! function_exists( 'mp_get_price_html' ) ) {
	/**
	 * Get product price
	 *
	 * @param $post_id
	 *
	 * @return string
	 */
	function mp_get_price_html( $post_id ) {
		$product = mp_get_product( $post_id );
		return $product->get_price_html();
	}
}