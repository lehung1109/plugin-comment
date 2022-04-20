<?php
/**
 * This config file is yours to hack on. It will work out of the box on Pantheon
 * but you may find there are a lot of neat tricks to be used here.
 *
 * See our documentation for more details:
 *
 * https://pantheon.io/docs
 */

/**
 * Pantheon platform settings. Everything you need should already be set.
 */
if (file_exists(dirname(__FILE__) . '/wp-config-pantheon.php') && isset($_ENV['PANTHEON_ENVIRONMENT'])) {
	require_once(dirname(__FILE__) . '/wp-config-pantheon.php');

/**
 * Local configuration information.
 *
 * If you are working in a local/desktop development environment and want to
 * keep your config separate, we recommend using a 'wp-config-local.php' file,
 * which you should also make sure you .gitignore.
 */
} elseif (file_exists(dirname(__FILE__) . '/wp-config-local.php') && !isset($_ENV['PANTHEON_ENVIRONMENT'])){
	# IMPORTANT: ensure your local config does not include wp-settings.php
	require_once(dirname(__FILE__) . '/wp-config-local.php');

/**
 * This block will be executed if you are NOT running on Pantheon and have NO
 * wp-config-local.php. Insert alternate config here if necessary.
 *
 * If you are only running on Pantheon, you can ignore this block.
 */
} else {
	define('DB_NAME',          'noiphoquanghuy');
	define('DB_USER',          'admin');
	define('DB_PASSWORD',      '403cfa64409615b2d');
	define('DB_HOST',          'localhost');
	define('DB_CHARSET',       'utf8');
	define('DB_COLLATE',       'utf8_general_ci');
	define('AUTH_KEY',         '=[Q1Sy4C:?r^#GS@l-3MK2ahDijq~2[Ic%y 3%aFHH|5>-5k+jn;o<<vuZy+M*5$');
	define('SECURE_AUTH_KEY',  '!%SISD$BVhB2n|Xl5m5EI}}|KTP5]O^P,KI<VypVC6uh!5;qw,[/5+}zpu ?$`Rm');
	define('LOGGED_IN_KEY',    'rtO1AII-+{|~SVtNKn?:R@iiQi#hwCLJ^l5{`r otlk9uoDH;QkSlH^iX@3dUA(*');
	define('NONCE_KEY',        '=`G#I`gJ7|+bdQCI(p5jSL%.~U4XFz9Y$^| ;6fM#IL<24Da(]uQ@N/fZ)CLNg3$');
	define('AUTH_SALT',        'cfdXJWR<BM|8%M(d>ug=OPtL#X<NmWe,xN77*f,yW5,cS,7MgoHSw/VG=cZv}pDz');
	define('SECURE_AUTH_SALT', '^o87XJ w62&?D.QNqknd}uz^S!p$J1]T^2Y?wauT/<W>)i3fov0}_s|8^-U]p);^');
	define('LOGGED_IN_SALT',   's}mw1IFevO[/vnv~WD! TkS|2#8xT8b-We<RP#mL7&icw0G}pS_H;2 TU|qaLL=~');
	define('NONCE_SALT',       'Urz&3e(~#C7Hc=b?K>U;S|}JDek-/3Fw}D<zrk;9Vp&Z|U,YFg;Ni@`U)AR2SaLp');
}


/** Standard wp-config.php stuff from here on down. **/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * You may want to examine $_ENV['PANTHEON_ENVIRONMENT'] to set this to be
 * "true" in dev, but false in test and live.
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define('WP_DEBUG', false);
}
define( 'WP_CACHE', true ); // Added by WP Rocket

/* That's all, stop editing! Happy Pressing. */




/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
