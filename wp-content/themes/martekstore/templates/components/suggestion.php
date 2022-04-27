<?php
$icon  = get_sub_field( 'icon' );
$title = get_sub_field( 'title' );
?>

<?php if ( have_rows( 'images' ) ): ?>
	<div class="suggestion my-4">
		<div class="container-lg">
			<?php if ( $icon || $title ) : ?>
				<div class="suggestion__header d-flex align-items-center mb-1">
					<?php if ( $icon ) : ?>
						<img class="suggestion__icon mr-2" src="<?php echo $icon['url'] ?>"
						     alt="<?php echo ! empty( $icon['alt'] ) ? $icon['alt'] : $icon['title']; ?>"
						     width="<?php echo $icon['width'] ?>" height="<?php echo $icon['height'] ?>">
					<?php endif; ?>
					<?php if ( $title ) : ?>
						<h2 class="suggestion__title mb-0 pt-1">
							<?php echo $title; ?>
						</h2>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<div class="suggestion__content row">
				<?php while ( have_rows( 'images' ) ): the_row();
					$gallery = get_sub_field( 'gallery' ); ?>
					<?php if ( get_row_index() == 1 ) : ?>
						<div class="col-12 col-md-6 mb-2 mb-md-3">
							<div class="suggestion__inner bg-light rounded-lg ratio ratio--2-1">
								<?php foreach ( $gallery as $gallery_random ) : ?>
									<a href="<?php echo ! empty( $gallery_random['description'] ) ? $gallery_random['description'] : '#'; ?>"
									   class="suggestion__link d-none"
									   title="<?php echo ! empty( $gallery_random['caption'] ) ? $gallery_random['caption'] : $gallery_random['title']; ?>">
										<img class="suggestion__img w-100 h-100"
										     src="<?php echo $gallery_random['url']; ?>"
										     alt="<?php echo ! empty( $gallery_random['alt'] ) ? $gallery_random['alt'] : $gallery_random['title']; ?>"
										     width="<?php echo $gallery_random['width']; ?>"
										     height="<?php echo $gallery_random['height']; ?>">
									</a>
								<?php endforeach; ?>
							</div>
						</div>
					<?php elseif ( get_row_index() == 2 ) : ?>
						<div class="col-12 col-md-6 mb-2 mb-md-3">
							<div class="suggestion__inner bg-light rounded-lg ratio ratio--2-1">
								<?php foreach ( $gallery as $gallery_random ) : ?>
									<a href="<?php echo ! empty( $gallery_random['description'] ) ? $gallery_random['description'] : '#'; ?>"
									   class="suggestion__link d-none"
									   title="<?php echo ! empty( $gallery_random['caption'] ) ? $gallery_random['caption'] : $gallery_random['title']; ?>">
										<img class="suggestion__img w-100 h-100"
										     src="<?php echo $gallery_random['url']; ?>"
										     alt="<?php echo ! empty( $gallery_random['alt'] ) ? $gallery_random['alt'] : $gallery_random['title']; ?>"
										     width="<?php echo $gallery_random['width']; ?>"
										     height="<?php echo $gallery_random['height']; ?>">
									</a>
								<?php endforeach; ?>
							</div>
						</div>
					<?php else : ?>
						<div class="col-12 col-md-4 mb-2 d-none d-md-block">
							<div class="suggestion__inner bg-light rounded-lg ratio ratio--2-1">
								<?php foreach ( $gallery as $gallery_random ) : ?>
									<a href="<?php echo ! empty( $gallery_random['description'] ) ? $gallery_random['description'] : '#'; ?>"
									   class="suggestion__link d-none"
									   title="<?php echo ! empty( $gallery_random['caption'] ) ? $gallery_random['caption'] : $gallery_random['title']; ?>">
										<img class="suggestion__img w-100 h-100"
										     src="<?php echo $gallery_random['url']; ?>"
										     alt="<?php echo ! empty( $gallery_random['alt'] ) ? $gallery_random['alt'] : $gallery_random['title']; ?>"
										     width="<?php echo $gallery_random['width']; ?>"
										     height="<?php echo $gallery_random['height']; ?>">
									</a>
								<?php endforeach; ?>
							</div>
						</div>
					<?php endif; ?>
				<?php endwhile; ?>
			</div>
		</div>
	</div>
<?php endif; ?>