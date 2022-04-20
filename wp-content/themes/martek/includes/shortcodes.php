<?php

add_shortcode( 'alert', 'martek_alert_shortcode' );
add_shortcode( 'product', 'martek_product_shortcode' );
add_shortcode( 'carousel', 'martek_carousel_shortcode' );
add_shortcode( 'fieldset', 'martek_fieldset_shortcode' );
add_shortcode( 'accordion', 'martek_accordion_shortcode' );

if ( ! function_exists( 'martek_alert_shortcode' ) ) {
	/**
	 * @param $atts
	 * @param $content
	 *
	 * @return string
	 */
	function martek_alert_shortcode( $atts, $content = null ) {

		// Attributes
		$atts = shortcode_atts(
			array(
				'icon' => 'true',
			),
			$atts
		);

		if ( empty( $content ) ) {
			return '';
		}

		// Remove all instances of "<p>&nbsp;</p><br>" to avoid extra lines.
		$content = do_shortcode( $content );
		$content = preg_replace( '%<p>&nbsp;\s*</p>%', '', $content );
		$content = preg_replace( '/^(?:<br\s*\/?>\s*)+/', '', $content );

		ob_start();
		get_template_part( 'templates/shortcode', 'alert', [ 'icon' => $atts['icon'], 'content' => $content ] );

		return ob_get_clean();
	}
}

if ( ! function_exists( 'martek_product_shortcode' ) ) {
	/**
	 * @param $atts
	 * @param $content
	 *
	 * @return false|string
	 */
	function martek_product_shortcode( $atts, $content = null ) {

		// Attributes
		$atts = shortcode_atts(
			array(
				'ids' => '',
			),
			$atts
		);

		if ( empty( $atts['ids'] ) ) {
			return '';
		}

		$product_ids = array_map( 'trim', explode( ",", $atts['ids'] ) );
		$products    = array_map( 'get_post', $product_ids );

		ob_start();
		get_template_part( 'templates/shortcode', 'product-list', [ 'products' => $products ] );

		return ob_get_clean();
	}
}

if ( ! function_exists( 'martek_carousel_shortcode' ) ) {
	/**
	 * @param $atts
	 * @param $content
	 *
	 * @return string
	 */
	function martek_carousel_shortcode( $atts, $content = null ) {

		// Attributes
		$atts = shortcode_atts(
			array(
				'ids' => '',
			),
			$atts
		);

		if ( empty( $atts['ids'] ) ) {
			return '';
		}

		$attachments = array_map( 'trim', explode( ",", $atts['ids'] ) );

		ob_start();
		get_template_part( 'templates/shortcode', 'carousel', [ 'attachments' => $attachments ] );

		return ob_get_clean();
	}
}

if ( ! function_exists( 'martek_fieldset_shortcode' ) ) {
	/**
	 * @param $atts
	 * @param $content
	 *
	 * @return false|string
	 */
	function martek_fieldset_shortcode( $atts, $content = null ) {

		// Attributes
		$atts = shortcode_atts(
			array(
				'title' => 'Fieldset',
			),
			$atts
		);

		if ( empty( $content ) ) {
			return '';
		}

		// Remove all instances of "<p>&nbsp;</p><br>" to avoid extra lines.
		$content = do_shortcode( $content );
		$content = preg_replace( '%<p>&nbsp;\s*</p>%', '', $content );
		$content = preg_replace( '/^(?:<br\s*\/?>\s*)+/', '', $content );

		ob_start();
		get_template_part( 'templates/shortcode', 'fieldset', [ 'title' => $atts['title'], 'content' => $content ] );

		return ob_get_clean();
	}
}

if ( ! function_exists( 'martek_accordion_shortcode' ) ) {
	/**
	 * @param $atts
	 * @param $content
	 *
	 * @return string
	 */
	function martek_accordion_shortcode( $atts, $content = null ) {

		// Attributes
		$atts = shortcode_atts(
			array(
				'title'    => 'Accordion',
				'expanded' => 'false',
			),
			$atts
		);

		if ( empty( $content ) ) {
			return '';
		}

		// Remove all instances of "<p>&nbsp;</p><br>" to avoid extra lines.
		$content = do_shortcode( $content );
		$content = preg_replace( '%<p>&nbsp;\s*</p>%', '', $content );
		$content = preg_replace( '/^(?:<br\s*\/?>\s*)+/', '', $content );

		ob_start();
		get_template_part( 'templates/shortcode', 'accordion', [
			'title'    => $atts['title'],
			'content'  => $content,
			'expanded' => $atts['expanded']
		] );

		return ob_get_clean();
	}
}