<?php
/**
 * The default template for displaying content
 *
 */

if ( isset( $args ) ) : ?>
	<div class="related-product">
		<p class="related-title">Sản phẩm tương tự</p>
		<div class="row">
			<?php foreach ( $args['data']->posts as $post ) : setup_postdata( $post ); ?>
				<div class="col-md-3">
					<div class="inner">
						<a href="<?php the_permalink(); ?>" class="post-thumbnail">
							<?php the_post_thumbnail( 'thumbnail' ); ?>
						</a>
						<h3 class="post-title">
							<a href="<?php the_permalink(); ?>">
								<?php the_title(); ?>
							</a>
						</h3>
					</div>
				</div>
			<?php endforeach;
			wp_reset_postdata(); ?>
		</div>
	</div>
<?php endif; ?>