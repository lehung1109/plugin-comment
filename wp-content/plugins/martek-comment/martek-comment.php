<?php

use MartekComment\MartekCommentPlugin;

/**
 *
 * Plugin Name:       Martek Comment
 * Plugin URI:        https://premmerce.com
 * Description:       A plugin for custom comment
 * Version:           1.0
 * Author:            webdev
 * Author URI:        https://premmerce.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       martek-comment
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

call_user_func( function () {

	require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

	$main = new MartekCommentPlugin( __FILE__ );

	register_activation_hook( __FILE__, [ $main, 'activate' ] );

	register_deactivation_hook( __FILE__, [ $main, 'deactivate' ] );

	register_uninstall_hook( __FILE__, [ MartekCommentPlugin::class, 'uninstall' ] );

	$main->run();
} );