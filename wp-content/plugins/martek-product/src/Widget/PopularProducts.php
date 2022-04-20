<?php namespace Product\Widget;

use WordPressPopularPosts\Output;
use WordPressPopularPosts\Query;

class PopularProducts extends \WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'popular-products',
			'MP Popular Products', // Name
			array( 'description' => __( 'The most popular products by categories.', 'martek-product' ) )
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		/**
		 * @var string $name
		 * @var string $id
		 * @var string $description
		 * @var string $class
		 * @var string $before_widget
		 * @var string $after_widget
		 * @var string $before_title
		 * @var string $after_title
		 * @var string $widget_id
		 * @var string $widget_name
		 */
		extract($args, EXTR_SKIP);

		if (!is_singular('product')) {
			return;
		}

		$post_id = get_queried_object_id();
		$term_list = wp_get_post_terms($post_id, 'product_cat', array( 'fields' => 'ids' ) );

		$title = apply_filters( 'widget_title', $instance['title'] );

		echo str_replace('widget_popular-products', 'widget_popular-products popular-posts sticky-top', $before_widget);
		if ( ! empty( $title ) ) {
			echo $before_title . $title . $after_title;
		}

		echo '<ul class="wpp-list">';
		wpp_get_mostpopular( [
			'post_type' => 'product',
			'taxonomy'  => 'product_cat',
			'term_id'   => $term_list[0],
			'range'     => 'last30days',
			'post_html' => 'wpp-popular-product',
			'limit'     => 6
		] );
		echo '</ul>';

		echo $after_widget;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = $instance['title'] ?? ''; ?>
		<p>
			<label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}
}