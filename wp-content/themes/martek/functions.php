<?php
/**
 * MarTek functions and definitions
 *
 * @package MarTek
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Update theme
require_once get_theme_file_path('lib/wp-package-updater/class-wp-package-updater.php');
$prefix_updater = new WP_Package_Updater(
	'https://update.d2tweb.com',
	wp_normalize_path( __FILE__ ),
	get_template_directory()
);

// Array of files to include.
$martek_includes = array(
	'/classes/class-tgm-plugin-activation.php',
	'/classes/class-wp-bootstrap-navwalker.php',
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/custom-comments.php',                 // Custom Comments file.
	'/editor.php',                          // Load Editor functions.
	'/deprecated.php',                      // Load deprecated functions.
	'/shortcodes.php',                      // Load shortcodes functions.
	'/widgets/popular-posts.php',           // Load poplar post widget.
);

// Include files.
foreach ( $martek_includes as $file ) {
	require_once get_theme_file_path( 'includes' . $file );
}
