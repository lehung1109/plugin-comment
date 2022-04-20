<?php
/**
 * MarTek enqueue scripts
 *
 * @package MarTek
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'martek_scripts' ) ) {
	/**
	 * Load theme's JavaScript and CSS sources.
	 */
	function martek_scripts() {
		// Get the theme data.
		$the_theme     = wp_get_theme();
		$theme_version = $the_theme->get( 'Version' );

		$css_version = $theme_version . '.' . filemtime( get_template_directory() . '/css/theme.min.css' );
		wp_enqueue_style( 'martek-styles', get_template_directory_uri() . '/css/theme.min.css', array(), $css_version );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
} // End of if function_exists( 'martek_scripts' ).

add_action( 'wp_enqueue_scripts', 'martek_scripts' );
