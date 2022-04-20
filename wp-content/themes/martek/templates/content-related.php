<?php
/**
 * The default template for displaying content
 *
 */

if ( isset( $args ) ) : ?>
	<div class="related-post">
		<p class="related-title">Tin liên quan</p>
		<div class="row">
			<?php foreach ( $args['data']->posts as $post ) : setup_postdata( $post ); ?>
				<div class="col-md-12 post">
					<div class="inner">
						<a href="<?php the_permalink(); ?>" class="post-thumbnail">
							<?php the_post_thumbnail( 'thumbnail' ); ?>
						</a>
						<h3 class="post-title">
							<a href="<?php the_permalink(); ?>">
								<?php the_title(); ?>
							</a>
						</h3>
						<p class="post-excerpt">
							<?php echo martek_get_excerpt( get_the_excerpt() ); ?>
						</p>
					</div>
				</div>
			<?php endforeach;
			wp_reset_postdata(); ?>
		</div>
	</div>
<?php endif; ?>