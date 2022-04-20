<?php
/**
 * The default template for displaying content
 *
 */

if ( isset( $args ) ) : ?>
	<div class="related-post mt-lg-6">
		<div class="container bg-white shadow-sm rounded-sm p-4">
			<h3 class="related-title font-size-20">Tin liên quan</h3>
			<div class="row">
				<?php foreach ( $args['data']->posts as $post ) : setup_postdata( $post ); ?>
					<div class="col-lg-3 col-sm-6 d-flex">
						<div class="card col border-0 p-0 shadow-sm rounded-lg p-2 mb-3">
							<a href="<?php the_permalink(); ?>" class="d-block bg-light ratio ratio--16-9 rounded-lg mb-2">
								<?php the_post_thumbnail('full', ['class' => 'w-100 h-100']); ?>
							</a>
							<div class="card-body d-flex flex-column p-0">
								<div class="card-categories font-size-12 mb-1">
									<?php the_category(', '); ?>
								</div>
								<h3 class="card-title flex-grow-1">
									<a href="<?php the_permalink(); ?>"
									   title="<?php printf( esc_attr__( '%s', 'matekstore' ), the_title_attribute( 'echo=0' ) ); ?>"
									   rel="bookmark"><?php the_title(); ?></a>
								</h3>
							</div>
						</div>
					</div>
				<?php endforeach;
				wp_reset_postdata(); ?>
			</div>
		</div>
	</div>
<?php endif; ?>