<?php
$icon  = get_sub_field( 'icon' );
$title = get_sub_field( 'title' );

$args = array(
	'post_type'      => 'post',
	'post_status'    => 'publish',
	'posts_per_page' => 5,
);

$query = new wp_query( $args );


?>

<div class="news my-4">
	<div class="container-lg">
		<div class="bg-white rounded-lg shadow-sm p-2">
			<div class="news__header d-flex align-items-center mb-3">
				<?php if ( $icon ) : ?>
					<img class="news__icon mr-2" src="<?php echo $icon['url'] ?>"
					     alt="<?php echo ! empty( $icon['alt'] ) ? $icon['alt'] : $icon['title']; ?>"
					     width="<?php echo $icon['width'] ?>" height="<?php echo $icon['height'] ?>">
				<?php endif; ?>
				<?php if ( $title ) : ?>
					<h2 class="news__title mb-0 pt-1">
						<?php echo $title; ?>
					</h2>
				<?php endif; ?>
			</div>

			<div class="news__content row">
				<div class="col-lg-6 col-12">
					<?php foreach ( $query->posts as $key => $post ) : setup_postdata( $post ); ?>
						<div class="news__card mb-3 mb-lg-0">
							<a class="news__img d-block bg-light ratio ratio--16-9 rounded-lg mb-2 mb-lg-3"
							   href="<?php echo esc_url( get_permalink() ); ?>">
								<?php the_post_thumbnail( 'full', [ 'alt' => get_the_title(), 'class' => 'w-100 h-100' ] ); ?>
							</a>

							<div class="news__content">
								<div class="news_categories">
									<?php the_category( ', ' ); ?>
								</div>
								<h3 class="news__title font-size-20">
									<a class="news__link"
									   href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a>
								</h3>
							</div>
						</div>

						<?php break; endforeach;
					wp_reset_postdata(); ?>
				</div>

				<div class="col-lg-6 col-12">
					<?php foreach ( $query->posts as $key => $post ) : setup_postdata( $post );
						if ( $key == 0 ) {
							continue;
						} ?>
						<div class="news__item d-flex mb-4">
							<a class="news__img col-3 rounded-lg bg-light ratio ratio--16-9 p-0 d-block mr-2 mr-md-3"
							   href="<?php echo esc_url( get_permalink() ); ?>">
								<?php the_post_thumbnail( 'full', [ 'alt' => get_the_title(), 'class' => 'w-100 h-100' ] ); ?>
							</a>

							<div class="news__content">
								<div class="news_categories">
									<?php the_category( ', ' ); ?>
								</div>
								<h3 class="news__title">
									<a class="news__link"
									   href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a>
								</h3>
							</div>
						</div>
					<?php endforeach;
					wp_reset_postdata(); ?>
				</div>
			</div>
		</div>
	</div>
</div>