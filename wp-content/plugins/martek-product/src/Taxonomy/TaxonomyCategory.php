<?php namespace Product\Taxonomy;

class TaxonomyCategory {
	function __construct() {
		add_action( 'init', [ $this, 'register' ] );
		add_action( 'init', [ $this, 'acf_fields' ], 200 );
	}

	public function register() {
		register_taxonomy(
			'product_cat', 'product', array(
				'labels'            => array(
					'name'          => __( 'Categories', 'martek-product' ),
					'add_new_item'  => __( 'Add category', 'martek-product' ),
					'new_item_name' => __( 'New category', 'martek-product' )
				),
				'show_ui'           => true,
				'show_admin_column' => true,
				'show_tagcloud'     => false,
				'hierarchical'      => true,
				'public'            => true,
				'query_var'         => 'product_cat',
				'rewrite'           => array( 'slug' => 'product-category' )
			)
		);
	}

	public function acf_fields() {
		if( function_exists('acf_add_local_field_group') ):

			acf_add_local_field_group(array(
				'key' => 'group_611274ff903a9',
				'title' => 'Category extra',
				'fields' => array(
					array(
						'key' => 'field_61127520fd4f0',
						'label' => 'Image',
						'name' => 'image',
						'type' => 'image',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'return_format' => 'array',
						'preview_size' => 'thumbnail',
						'library' => 'all',
						'min_width' => '',
						'min_height' => '',
						'min_size' => '',
						'max_width' => '',
						'max_height' => '',
						'max_size' => '',
						'mime_types' => '',
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'taxonomy',
							'operator' => '==',
							'value' => 'product_cat',
						),
					),
				),
				'menu_order' => 0,
				'position' => 'normal',
				'style' => 'default',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => '',
				'active' => true,
				'description' => '',
			));

		endif;
	}
}