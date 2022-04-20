<?php
/**
 * Theme basic setup
 *
 * @package MarTek
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_action( 'tgmpa_register', 'martek_register_required_plugins' );
add_filter( 'site_transient_update_plugins', 'martek_disable_notices_updates' );
add_action( 'after_setup_theme', 'martek_setup' );

if ( ! function_exists( 'martek_register_required_plugins' ) ) {
	/**
	 * Register the required plugins for this theme.
	 *
	 *  <snip />
	 *
	 * This function is hooked into tgmpa_init, which is fired within the
	 * TGM_Plugin_Activation class constructor.
	 */
	function martek_register_required_plugins() {

		/**
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array(

			array(
				'name'      => 'Advanced Custom Fields PRO',
				'slug'      => 'advanced-custom-fields-pro',
				'required'  => true,
				'source'    => 'https://update.d2tweb.com/wp-content/uploads/advanced-custom-fields-pro.zip',
				'version'   => '5.11.4',
				'force_activation' => true,
				'force_deactivation' => true
			),

			array(
				'name'      => 'Permalink Manager Pro',
				'slug'      => 'permalink-manager-pro',
				'required'  => false,
				'source'    => 'https://update.d2tweb.com/wp-content/uploads/permalink-manager-pro.zip',
				'version'   => '2.2.9.8',
			),

			array(
				'name'      => esc_html__( 'WP Rocket', 'martek'),
				'slug'      => 'wp-rocket',
				'required'  => false,
				'source'    => 'https://update.d2tweb.com/wp-content/uploads/wp-rocket.zip',
				'version'   => '3.10.9'
			),

			// Include plugins from the WordPress Plugin Repository.
			array(
				'name'      => 'Advanced Editor Tools (previously TinyMCE Advanced)',
				'slug'      => 'tinymce-advanced',
				'required'  => true,
			),
			array(
				'name'      => 'Insert Headers and Footers by WPBeginner',
				'slug'      => 'insert-headers-and-footers',
				'required'  => true,
			),
			array(
				'name'      => 'kk Star Ratings',
				'slug'      => 'kk-star-ratings',
				'required'  => true,
			),
			array(
				'name'      => 'Max Mega Menu',
				'slug'      => 'megamenu',
				'required'  => true,
			),
			array(
				'name'      => 'SearchWP Live Ajax Search',
				'slug'      => 'searchwp-live-ajax-search',
				'required'  => true,
			),
			array(
				'name'      => 'WordPress Popular Posts',
				'slug'      => 'wordpress-popular-posts',
				'required'  => true,
			),
			array(
				'name'      => 'Yoast SEO',
				'slug'      => 'wordpress-seo',
				'required'  => true,
			),
		);

		/**
		 * Array of configuration settings. Amend each line as needed.
		 * If you want the default strings to be available under your own theme domain,
		 * leave the strings uncommented.
		 * Some of the strings are added into a sprintf, so see the comments at the
		 * end of each line for what each argument will be.
		 */
		$config = array(
			'default_path' => '',                      // Default absolute path to pre-packaged plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => false,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
			'strings'      => array(
				'page_title'                      => __( 'Install Required Plugins', 'tgmpa' ),
				'menu_title'                      => __( 'Install Plugins', 'tgmpa' ),
				'installing'                      => __( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
				'oops'                            => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
				'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s).
				'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s).
				'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s).
				'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
				'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
				'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s).
				'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s).
				'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s).
				'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
				'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),
				'return'                          => __( 'Return to Required Plugins Installer', 'tgmpa' ),
				'plugin_activated'                => __( 'Plugin activated successfully.', 'tgmpa' ),
				'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
				'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
			)
		);
		tgmpa( $plugins, $config );
	}
}

if ( ! function_exists( 'martek_disable_notices_updates' ) ) {
	/**
	 * Disable plugin update
	 * @param $value
	 *
	 * @return mixed
	 */
	function martek_disable_notices_updates( $value ) {
		unset( $value->response['megamenu-pro/megamenu-pro.php'] );
		unset( $value->response['advanced-custom-fields-pro/acf.php'] );
		return $value;
	}
}

if ( ! function_exists( 'martek_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function martek_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on martek, use a find and replace
		 * to change 'martek' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'martek', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'martek' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
			)
		);

		/*
		 * Adding Thumbnail basic support
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Adding support for Widget edit icons in customizer
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Set up the WordPress Theme logo feature.
		add_theme_support( 'custom-logo' );

		// Set up theme option.
		if ( function_exists( 'acf_add_options_page' ) ) {
			acf_add_options_page( array(
				'page_title' => 'General Settings',
				'menu_title' => 'Theme settings',
				'menu_slug'  => 'theme-settings',
				'capability' => 'edit_posts',
				'redirect'   => false
			) );
			acf_add_options_sub_page( array(
				'page_title'  => 'Form Settings',
				'menu_title'  => 'Google form',
				'parent_slug' => 'theme-settings',
			) );
		}

	}
}

// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}