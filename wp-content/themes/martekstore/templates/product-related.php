<?php
/**
 * The default template for displaying content
 *
 */

if ( isset( $args ) ) : ?>
	<div class="related-product mt-4">
		<div class="bg-white shadow-sm rounded p-2">
			<div class="related-product__title font-size-20 font-weight-bold">Sản phẩm tương tự</div>
			<div class="row mx-n1 mx-lg-2">
				<?php foreach ( $args['data']->posts as $post ) : setup_postdata( $post ); ?>
					<div class="col-6 col-md-3 px-1 px-lg-2 d-flex">
						<?php get_template_part( 'templates/product', 'card' ); ?>
					</div>
				<?php endforeach;
				wp_reset_postdata(); ?>
			</div>
		</div>
	</div>
<?php endif; ?>