<?php if ( have_rows( 'grid' ) ):
	while ( have_rows( 'grid' ) ): the_row();
		$gallery_1 = get_sub_field( 'gallery_1' );
		$gallery_2 = get_sub_field( 'gallery_2' );
		$gallery_3 = get_sub_field( 'gallery_3' ); ?>

		<div class="col-12 col-lg-7 mb-md-4 mb-lg-0">
			<div class="banner__inner bg-light rounded-lg ratio ratio--4-3">
				<?php foreach ( $gallery_1 as $b1 ) : ?>
					<a href="<?php echo ! empty( $b1['description'] ) ? $b1['description'] : '#'; ?>"
					   class="banner__link d-none"
					   title="<?php echo ! empty( $b1['caption'] ) ? $b1['caption'] : $b1['title']; ?>">
						<img class="banner__img banner__image--large w-100 h-100" src="<?php echo $b1['url']; ?>"
						     alt="<?php echo !empty($b1['alt']) ? $b1['alt'] : $b1['title']; ?>"
						     width="<?php echo $b1['width']; ?>" height="<?php echo $b1['height']; ?>">
					</a>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="col-12 col-lg-5 d-none d-md-flex flex-lg-column justify-content-md-between">
			<div class="banner__inner bg-light rounded-lg ratio ratio--2-1 mr-md-3 mr-lg-0">
				<?php foreach ( $gallery_2 as $b2 ) : ?>
					<a href="<?php echo ! empty( $b2['description'] ) ? $b2['description'] : '#'; ?>"
					   class="banner__link d-none"
					   title="<?php echo ! empty( $b2['caption'] ) ? $b2['caption'] : $b2['title']; ?>">
						<img class="banner_img banner__img--medium w-100 h-100" src="<?php echo $b2['url']; ?>"
						     alt="<?php echo !empty($b2['alt']) ? $b2['alt'] : $b2['title']; ?>"
						     width="<?php echo $b2['width']; ?>" height="<?php echo $b2['height']; ?>">
					</a>
				<?php endforeach; ?>
			</div>

			<div class="banner__inner bg-light rounded-lg ratio ratio--2-1 ml-md-3 ml-lg-0">
				<?php foreach ( $gallery_3 as $b3 ) : ?>
					<a href="<?php echo ! empty( $b3['description'] ) ? $b3['description'] : '#'; ?>"
					   class="banner__link d-none"
					   title="<?php echo ! empty( $b3['caption'] ) ? $b3['caption'] : $b3['title']; ?>">
						<img class="banner_img banner__img--medium w-100 h-100" src="<?php echo $b3['url']; ?>"
						     alt="<?php echo !empty($b3['alt']) ? $b3['alt'] : $b3['title']; ?>"
						     width="<?php echo $b3['width']; ?>" height="<?php echo $b3['height']; ?>">
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	<?php endwhile; ?>
<?php endif; ?>