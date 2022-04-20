<?php
/**
 * Rest in peace
 *
 * @package MarTek
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Disable Gutenberg editor.
add_filter( 'use_block_editor_for_post_type', '__return_false', 10 );

// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

// This will add a filter on `excerpt_more` that returns an empty string.
add_filter( 'excerpt_more', '__return_empty_string' );

// Disables the block editor from managing widgets in the Gutenberg plugin.
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false', 100 );

// Disables the block editor from managing widgets.
add_filter( 'use_widgets_block_editor', '__return_false' );

// Remove script.
add_action( 'wp_enqueue_scripts', 'martek_remove_scripts', 20 );
function martek_remove_scripts() {
	wp_dequeue_style( 'wp-block-library' ); // WordPress core
	wp_dequeue_style( 'wp-block-library-theme' ); // WordPress core

	if ( !is_user_logged_in() ) {
		wp_deregister_style( 'dashicons' );
	}

}

// Remove jquery migrate.
add_action('wp_default_scripts', 'remove_jquery_migrate');
function remove_jquery_migrate( $scripts ) {
	if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
		$script = $scripts->registered['jquery'];

		if ( $script->deps ) {
			$script->deps = array_diff( $script->deps, array(
				'jquery-migrate'
			) );
		}
	}
}

// Remove default image sizes from WordPress.
add_filter( 'intermediate_image_sizes_advanced', 'remove_default_image_sizes' );
function remove_default_image_sizes( $sizes ) {
	/* Default WordPress */
	unset( $sizes[ 'medium' ]);          // Remove Medium resolution (300 x 300 max height 300px)
	unset( $sizes[ 'medium_large' ]);    // Remove Medium Large (added in WP 4.4) resolution (768 x 0 infinite height)
	unset( $sizes[ 'large' ]);           // Remove Large resolution (1024 x 1024 max height 1024px)

	return $sizes;
}

add_action( 'init', 'remove_large_image_sizes' );
function remove_large_image_sizes() {
	remove_image_size( '1536x1536' );
	remove_image_size( '2048x2048' );
}