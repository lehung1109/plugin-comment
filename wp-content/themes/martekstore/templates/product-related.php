<?php
/**
 * The default template for displaying content
 *
 */

if ( isset( $args ) ) : ?>
	<div class="related-product mt-lg-6">
		<div class="container bg-white shadow-sm rounded-sm p-4">
			<h3 class="related-title font-size-20">Sản phẩm tương tự</h3>
			<div class="row">
				<?php foreach ( $args['data']->posts as $post ) : setup_postdata( $post ); ?>
					<div class="col-6 col-lg-3 p-1 p-xl-2 d-flex">
						<?php get_template_part( 'templates/product', 'card' ); ?>
					</div>
				<?php endforeach;
				wp_reset_postdata(); ?>
			</div>
		</div>
	</div>
<?php endif; ?>