<?php

use Product\ProductPlugin;

/**
 *
 * Plugin Name:       Martek Product
 * Plugin URI:        https://martek.vn
 * Description:       Product type.
 * Version:           1.0
 * Author:            Anthony
 * Author URI:        https://martek.vn
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       martek-product
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PRODUCT_PATH', plugin_dir_path( __FILE__ ) );
define( 'PRODUCT_URL', plugin_dir_url( __FILE__ ) );

call_user_func( function () {

	require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

	$main = new ProductPlugin( __FILE__ );

	register_activation_hook( __FILE__, [ $main, 'activate' ] );

	register_deactivation_hook( __FILE__, [ $main, 'deactivate' ] );

	register_uninstall_hook( __FILE__, [ ProductPlugin::class, 'uninstall' ] );

	$main->run();
} );

require_once PRODUCT_PATH . 'functions.php';