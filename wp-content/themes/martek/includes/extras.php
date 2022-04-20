<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package MarTek
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_filter( 'body_class', 'martek_body_classes' );
add_filter( 'get_custom_logo', 'martek_change_logo_class' );
add_action( 'wp_head', 'martek_pingback' );
add_action( 'wp_head', 'martek_mobile_web_app_meta' );
add_filter( 'martek_body_attributes', 'martek_default_body_attributes' );
add_filter( 'get_the_archive_description', 'martek_escape_the_archive_description' );
add_filter( 'the_title', 'martek_kses_title' );
add_filter( 'get_the_archive_title', 'martek_kses_title' );
add_filter( 'the_content', 'martek_content', 100 );
add_filter( 'term_description', 'martek_content', 10, 1 );
add_filter( 'excerpt_more', 'martek_custom_excerpt_more' );
add_filter( 'wp_terms_checklist_args', 'martek_checked_ontop', 10, 1 );
add_filter( 'img_caption_shortcode', 'martek_caption', 10, 3 );

/**
 * Show acf menu only webdev
 */
add_filter('acf/settings/show_admin', function( $show ) {
	$current_user = wp_get_current_user();
	if ( $current_user->user_login == 'webdev' ) {
		return true;
	}

	return false;
});

/**
 * Load acj json
 */
add_filter( 'acf/settings/load_json', function ( $paths ) {
	$paths[] = WP_CONTENT_DIR . '/acf-json';
	return $paths;
} );

/**
 * Save acf json
 */
add_filter('acf/settings/save_json', function() {
	return  WP_CONTENT_DIR . '/acf-json';
} );

/**
 * Remove the last breadcrumb, the post title, from the Yoast SEO breadcrumbs
 */
add_filter('wpseo_breadcrumb_single_link', function( $link_output ) {
	if(strpos( $link_output, 'breadcrumb_last' ) !== false ) {
		$link_output = '';
	}
	return $link_output;
} );

if ( ! function_exists( 'martek_body_classes' ) ) {
	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 *
	 * @return array
	 */
	function martek_body_classes( $classes ) {
		// Setup body classes.
		foreach ( $classes as $key => $value ) {
			if ( 'tag' == $value ) {
				unset( $classes[ $key ] );
			}
		}
		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}
		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		return $classes;
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

		$html = str_replace( 'class="custom-logo"', 'class="img-fluid"', $html );
		$html = str_replace( 'class="custom-logo-link"', 'class="navbar-brand custom-logo-link"', $html );

		return str_replace( 'alt=""', 'title="Home" alt="logo"', $html );
	}
}

if ( ! function_exists( 'martek_post_nav' ) ) {
	/**
	 * Display navigation to next/previous post when applicable.
	 */
	function martek_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}
		?>
		<nav class="container navigation post-navigation">
			<h2 class="sr-only"><?php esc_html_e( 'Post navigation', 'martek' ); ?></h2>
			<div class="row nav-links justify-content-between">
				<?php
				if ( get_previous_post_link() ) {
					previous_post_link( '<span class="nav-previous">%link</span>', _x( '<i class="fa fa-angle-left"></i>&nbsp;%title', 'Previous post link', 'martek' ) );
				}
				if ( get_next_post_link() ) {
					next_post_link( '<span class="nav-next">%link</span>', _x( '%title&nbsp;<i class="fa fa-angle-right"></i>', 'Next post link', 'martek' ) );
				}
				?>
			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}
}

if ( ! function_exists( 'martek_pingback' ) ) {
	/**
	 * Add a pingback url auto-discovery header for single posts of any post type.
	 */
	function martek_pingback() {
		if ( is_singular() && pings_open() ) {
			echo '<link rel="pingback" href="' . esc_url( get_bloginfo( 'pingback_url' ) ) . '">' . "\n";
		}
	}
}

if ( ! function_exists( 'martek_mobile_web_app_meta' ) ) {
	/**
	 * Add mobile-web-app meta.
	 */
	function martek_mobile_web_app_meta() {
		echo '<meta name="mobile-web-app-capable" content="yes">' . "\n";
		echo '<meta name="apple-mobile-web-app-capable" content="yes">' . "\n";
		echo '<meta name="apple-mobile-web-app-title" content="' . esc_attr( get_bloginfo( 'name' ) ) . ' - ' . esc_attr( get_bloginfo( 'description' ) ) . '">' . "\n";
	}
}

if ( ! function_exists( 'martek_default_body_attributes' ) ) {
	/**
	 * Adds schema markup to the body element.
	 *
	 * @param array $atts An associative array of attributes.
	 * @return array
	 */
	function martek_default_body_attributes( $atts ) {
		$atts['itemscope'] = '';
		$atts['itemtype']  = 'http://schema.org/WebSite';
		return $atts;
	}
}

if ( ! function_exists( 'martek_escape_the_archive_description' ) ) {
	/**
	 * Escapes the description for an author or post type archive.
	 *
	 * @param string $description Archive description.
	 * @return string Maybe escaped $description.
	 */
	function martek_escape_the_archive_description( $description ) {
		if ( is_author() || is_post_type_archive() ) {
			return wp_kses_post( $description );
		}

		/*
		 * All other descriptions are retrieved via term_description() which returns
		 * a sanitized description.
		 */
		return $description;
	}
}

if ( ! function_exists( 'martek_kses_title' ) ) {
	/**
	 * Sanitizes data for allowed HTML tags for post title.
	 *
	 * @param string $data Post title to filter.
	 * @return string Filtered post title with allowed HTML tags and attributes intact.
	 */
	function martek_kses_title( $data ) {
		// Tags not supported in HTML5 are not allowed.
		$allowed_tags = array(
			'abbr'             => array(),
			'aria-describedby' => true,
			'aria-details'     => true,
			'aria-label'       => true,
			'aria-labelledby'  => true,
			'aria-hidden'      => true,
			'b'                => array(),
			'bdo'              => array(
				'dir' => true,
			),
			'blockquote'       => array(
				'cite'     => true,
				'lang'     => true,
				'xml:lang' => true,
			),
			'cite'             => array(
				'dir'  => true,
				'lang' => true,
			),
			'dfn'              => array(),
			'em'               => array(),
			'i'                => array(
				'aria-describedby' => true,
				'aria-details'     => true,
				'aria-label'       => true,
				'aria-labelledby'  => true,
				'aria-hidden'      => true,
				'class'            => true,
			),
			'code'             => array(),
			'del'              => array(
				'datetime' => true,
			),
			'ins'              => array(
				'datetime' => true,
				'cite'     => true,
			),
			'kbd'              => array(),
			'mark'             => array(),
			'pre'              => array(
				'width' => true,
			),
			'q'                => array(
				'cite' => true,
			),
			's'                => array(),
			'samp'             => array(),
			'span'             => array(
				'dir'      => true,
				'align'    => true,
				'lang'     => true,
				'xml:lang' => true,
			),
			'small'            => array(),
			'strong'           => array(),
			'sub'              => array(),
			'sup'              => array(),
			'u'                => array(),
			'var'              => array(),
		);
		$allowed_tags = apply_filters( 'martek_kses_title', $allowed_tags );

		return wp_kses( $data, $allowed_tags );
	}
}

if ( ! function_exists( 'martek_content' ) ) {
	/**
	 * Custom content
	 */
	function martek_content( $content ) {
		if ( empty( $content ) ) {
			return $content;
		}

		// Add reponsive for iframe
		$pattern = '~<iframe.*</iframe>|<embed.*</embed>~';
		preg_match_all( $pattern, $content, $matches );

		foreach ( $matches[0] as $match ) {
			// wrap matched iframe with div
			$wrappedframe = '<div class="embed-responsive embed-responsive-16by9 mb-2">' . $match . '</div>';

			//replace original iframe with new in content
			$content = str_replace( $match, $wrappedframe, $content );
		}

		// Add class to table
		$content  = mb_convert_encoding( $content, 'HTML-ENTITIES', "UTF-8" );
		$document = new DOMDocument();
		libxml_use_internal_errors( true );
		$document->loadHTML( utf8_decode( $content ) );

		$tables = $document->getElementsByTagName( 'table' );
		foreach ( $tables as $table ) {
			$table->setAttribute( 'class', 'table table-bordered' );
		}

		return $document->saveHTML();
	}
}

if ( ! function_exists( 'martek_caption' ) ) {
	/**
	 * Custom caption
	 *
	 * @param $value
	 * @param $attr
	 * @param $content
	 *
	 * @return mixed|string
	 */
	function martek_caption( $value, $attr, $content = null ) {
		extract(
			shortcode_atts( array(
				'id'      => '',
				'align'   => '',
				'width'   => '',
				'caption' => ''
			), $attr )
		);

		// If the caption is empty.
		if ( 1 > (int) $width || empty( $caption ) ) {
			return $value;
		}

		// Get the image id and add it to the caption for specification
		$capid = '';
		if ( $id ) {
			$id    = esc_attr( $id );
			$capid = 'id="figure_caption_' . $id . '" ';
			$id    = 'id="' . $id . '" aria-labelledby="figure_caption_' . $id . '" ';
		}

		// Return the figure element with the proper width, the image and the figure caption
		return '<figure ' . $id . 'class="wp-caption ' . esc_attr( $align ) . '" style="width: '
		       . ( (int) $width ) . 'px">' . do_shortcode( $content ) . '<figcaption ' . $capid
		       . 'class="wp-caption-text figure-caption mt-1">' . $caption . '</figcaption></figure>';

	}
}

if ( ! function_exists( 'martek_custom_excerpt_more' ) ) {
	/**
	 * Removes the ... from the excerpt read more link
	 *
	 * @param string $more The excerpt.
	 *
	 * @return string
	 */
	function martek_custom_excerpt_more( $more ) {
		if ( ! is_admin() ) {
			$more = '';
		}

		return $more;
	}
}

if ( ! function_exists( 'martek_checked_ontop' ) ) {
	/**
	 * Categories in Hierarchical Order
	 */
	function martek_checked_ontop( $args ) {
		$args['checked_ontop'] = false;

		return $args;
	}
}
