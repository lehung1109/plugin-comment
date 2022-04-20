<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'THEME_URI', get_stylesheet_directory_uri() );

// Array of files to include.
$martek_includes = array(
	'/custom-comments.php',
	'/widgets.php'
);

// Include files.
foreach ( $martek_includes as $file ) {
	require_once get_theme_file_path( 'includes' . $file );
}

if ( ! function_exists( 'martek_scripts' ) ) {
	/**
	 * Load theme's JavaScript and CSS sources.
	 */
	function martek_scripts() {
		// Get the theme data
		$the_theme     = wp_get_theme();
		$theme_version = $the_theme->get( 'Version' );

		if ( ! is_admin() ) {
			// Add stylesheet
			wp_enqueue_style( 'main', THEME_URI . '/assets/css/main.css', array(), $theme_version );

			// Add javascript
			wp_enqueue_script( 'main', THEME_URI . '/assets/js/main.bundle.js', array( 'jquery' ), $theme_version, true );
		}

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}

if ( ! function_exists( 'martek_change_logo_class' ) ) {
	/**
	 * Replaces logo CSS class.
	 *
	 * @param string $html Markup.
	 *
	 * @return string
	 */
	function martek_change_logo_class( $html ) {

		$html = str_replace( 'class="custom-logo"', 'class="skip-lazy"', $html );
		$html = str_replace( 'class="custom-logo-link"', 'class="logo"', $html );

		return str_replace( 'alt=""', 'title="Home" alt="logo"', $html );
	}
}

add_filter( 'af/form/ajax/response', function ($response, $form, $args) {
	$fields = AF()->submission['fields'];
	foreach ( $fields as $field ) {
		if ( !empty( $field['wrapper']['id'] ) ) {
			$key = $field['wrapper']['id'];
			$response[$key] = $field['value'];
		}
	}

	return $response;
}, 10, 3);