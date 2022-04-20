<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package MarTek
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_action( 'edit_category', 'martek_category_transient_flusher' );
add_action( 'save_post', 'martek_category_transient_flusher' );
add_filter( 'wpp_post', 'martek_wpp_post_template', 10, 3 );

if ( ! function_exists( 'martek_posted_on' ) ) {
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function martek_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s"> (%4$s) </time>';
		}
		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);
		$posted_on   = apply_filters(
			'martek_posted_on',
			sprintf(
				'<span class="posted-on">%1$s <a href="%2$s" rel="bookmark">%3$s</a></span>',
				esc_html_x( 'Posted on', 'post date', 'martek' ),
				esc_url( get_permalink() ),
				apply_filters( 'martek_posted_on_time', $time_string )
			)
		);
		$byline      = apply_filters(
			'martek_posted_by',
			sprintf(
				'<span class="byline"> %1$s<span class="author vcard"> <a class="url fn n" href="%2$s">%3$s</a></span></span>',
				$posted_on ? esc_html_x( 'by', 'post author', 'martek' ) : esc_html_x( 'Posted by', 'post author', 'martek' ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_html( get_the_author() )
			)
		);
		echo $posted_on . $byline; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'martek_entry_footer' ) ) {
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function martek_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'martek' ) );
			if ( $categories_list && martek_categorized_blog() ) {
				/* translators: %s: Categories of current post */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %s', 'martek' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'martek' ) );
			if ( $tags_list ) {
				/* translators: %s: Tags of current post */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %s', 'martek' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( esc_html__( 'Leave a comment', 'martek' ), esc_html__( '1 Comment', 'martek' ), esc_html__( '% Comments', 'martek' ) );
			echo '</span>';
		}
		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'martek' ),
				the_title( '<span class="sr-only">"', '"</span>', false )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
}

if ( ! function_exists( 'martek_categorized_blog' ) ) {
	/**
	 * Returns true if a blog has more than 1 category.
	 *
	 * @return bool
	 */
	function martek_categorized_blog() {
		$all_the_cool_cats = get_transient( 'martek_categories' );
		if ( false === $all_the_cool_cats ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories(
				array(
					'fields'     => 'ids',
					'hide_empty' => 1,
					// We only need to know if there is more than one category.
					'number'     => 2,
				)
			);
			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );
			set_transient( 'martek_categories', $all_the_cool_cats );
		}
		if ( $all_the_cool_cats > 1 ) {
			// This blog has more than 1 category so martek_categorized_blog should return true.
			return true;
		}
		// This blog has only 1 category so martek_categorized_blog should return false.
		return false;
	}
}

if ( ! function_exists( 'martek_category_transient_flusher' ) ) {
	/**
	 * Flush out the transients used in martek_categorized_blog.
	 */
	function martek_category_transient_flusher() {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		// Like, beat it. Dig?
		delete_transient( 'martek_categories' );
	}
}

if ( ! function_exists( 'martek_body_attributes' ) ) {
	/**
	 * Displays the attributes for the body element.
	 */
	function martek_body_attributes() {
		/**
		 * Filters the body attributes.
		 *
		 * @param array $atts An associative array of attributes.
		 */
		$atts = array_unique( apply_filters( 'martek_body_attributes', $atts = array() ) );
		if ( ! is_array( $atts ) || empty( $atts ) ) {
			return;
		}
		$attributes = '';
		foreach ( $atts as $name => $value ) {
			if ( $value ) {
				$attributes .= sanitize_key( $name ) . '="' . esc_attr( $value ) . '" ';
			} else {
				$attributes .= sanitize_key( $name ) . ' ';
			}
		}
		echo trim( $attributes ); // phpcs:ignore WordPress.Security.EscapeOutput
	}
}

if ( ! function_exists( 'martek_get_excerpt' ) ) {
	/**
	 * Display post excerpt.
	 */
	function martek_get_excerpt( $content ) {
		preg_match( '/^([^.!?\s]*[\.!?\s]+){0,25}/', strip_tags( $content ), $abstract );
		return $abstract[0] . '...';
	}
}

if ( ! function_exists( 'martek_post_related' ) ) {
	/**
	 * Display post related.
	 */
	function martek_post_related( $post_id, $per_page = 4 ) {
		$args = array(
			'posts_per_page' => $per_page,
			'post__not_in'   => array( $post_id ),
			'no_found_rows'  => true,
		);

		$cats = wp_get_post_terms( $post_id, 'category' );

		$cats_ids = array();
		foreach ( $cats as $related_cat ) {
			$cats_ids[] = $related_cat->term_id;
		}

		if ( ! empty( $cats_ids ) ) {
			$args['category__in'] = $cats_ids;
		}

		$query = new wp_query( $args );

		get_template_part( 'templates/content', 'related', array( 'data' => $query ) );
	}
}

if ( ! function_exists( 'martek_product_related' ) ) {
	/**
	 * Display post related.
	 */
	function martek_product_related( $product_id, $per_page = 4 ) {
		$args = array(
			'posts_per_page' => $per_page,
			'post__not_in'   => array( $product_id ),
			'no_found_rows'  => true,
		);

		$cats = wp_get_post_terms( $product_id, 'product_cat' );
		$product_cat = reset($cats);
		$read_more = get_term_link($product_cat);

		if ( ! empty( $product_cat ) ) {
			$args['tax_query'][] = [
				'taxonomy' => 'product_cat',
				'field' => 'slug',
				'terms' => $product_cat->slug,
			];
		}

		$query = new wp_query( $args );

		get_template_part( 'templates/product', 'related', array( 'data' => $query, 'read_more' => $read_more ) );
	}
}

if ( ! function_exists( 'martek_get_sold_views' ) ) {
	/**
	 * Count sold views
	 */
	function martek_get_sold_views( $post_id  ) {
		$views = wpp_get_views($post_id);
		$views = str_replace('.', '', $views);
		if (intval($views) > 20) {
			return round(intval($views)/20);
		}
		return 0;
	}
}

if ( ! function_exists( 'martek_get_share_views' ) ) {
	/**
	 * Count sold views
	 */
	function martek_get_share_views( $post_id  ) {
		$views = wpp_get_views($post_id);
		$views = str_replace('.', '', $views);
		if (intval($views) > 45) {
			return round(intval($views)/45);
		}
		return 0;
	}
}

if ( ! function_exists( 'martek_wpp_post_template' ) ) {
	/**
	 * Display the title and the publishing date
	 *
	 * @param string $post_html
	 * @param object $popular_post
	 * @param array $instance
	 *
	 * @return string
	 */
	function martek_wpp_post_template( $post_html, $popular_post, $instance ) {

		if ( ! isset( $instance['widget_id'] ) && strpos( $instance['markup']['post-html'], 'wpp-' ) !== false ) {
			$file_name = str_replace( '\n', '', $instance['markup']['post-html'] );

			return get_template_part( 'templates/' . $file_name, '', [ 'popular_post' => $popular_post ] );
		} elseif ( isset( $instance["widget_id"] ) && $instance["post_type"] === 'product' && empty( $instance["theme"]["name"] ) ) {
			ob_start();
			get_template_part( 'templates/wpp-popular-product', '', [ 'popular_post' => $popular_post ] );
			$output = ob_get_contents();
			ob_end_clean();

			return $output;
		} elseif ( isset( $instance["widget_id"] ) && $instance["post_type"] === 'post' && empty( $instance["theme"]["name"] ) ) {
			ob_start();
			get_template_part( 'templates/wpp-popular-post', '', [ 'popular_post' => $popular_post ] );
			$output = ob_get_contents();
			ob_end_clean();

			return $output;
		}

		return $post_html;
	}
}