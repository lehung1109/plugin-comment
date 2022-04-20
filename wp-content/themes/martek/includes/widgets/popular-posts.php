<?php

class Popular_Posts extends \WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'popular-posts',
			'Martek Popular Posts', // Name
			array( 'description' => __( 'The most popular posts by categories.', 'martek' ) )
		);

		add_action( 'widgets_init', function() {
			register_widget( 'Popular_Posts' );
		});
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

		$post_id = get_queried_object_id();
		$term_list = wp_get_post_terms($post_id, 'category', array( 'fields' => 'ids' ) );

		if (empty($term_list) && isset(get_queried_object()->term_id) ) {
			$term_id = get_queried_object()->term_id;
			$term_list = get_term_children($term_id, 'category');
		}

		$title = apply_filters( 'widget_title', $instance['title'] );

		echo str_replace('widget_popular-posts', 'widget_popular-posts popular-posts sticky-top', $before_widget);
		if ( ! empty( $title ) ) {
			echo $before_title . $title . $after_title;
		}

		echo '<ul class="list-unstyled">';
		wpp_get_mostpopular( [
			'post_type' => 'post',
			'taxonomy'  => 'category',
			'term_id'   => implode(',', $term_list),
			'range'     => 'all',
			'post_html' => 'wpp-popular-post',
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

new Popular_Posts();