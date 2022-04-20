<?php
$icon       = get_sub_field( 'icon' );
$title      = get_sub_field( 'title' );
$categories = get_sub_field( 'categories' ); ?>

<div class="category pt-2 pt-md-3 pb-4 pb-md-6">
	<div class="container">
		<hr class="mb-lg-4">
		<div class="category__header d-flex align-items-center mb-2">
			<?php if ( $icon ) : ?>
				<img class="category__icon mr-2" src="<?php echo $icon['url'] ?>"
				     alt="<?php echo ! empty( $icon['alt'] ) ? $icon['alt'] : $icon['title']; ?>"
				     width="<?php echo $icon['width'] ?>" height="<?php echo $icon['height'] ?>">
			<?php endif; ?>
			<?php if ( $title ) : ?>
				<h2 class="category__title mb-0 pt-lg-1">
					<?php echo $title; ?>
				</h2>
			<?php endif; ?>
		</div>

		<?php if ( $categories ) : ?>
			<div class="row mx-n1 mx-xl-n2">
				<?php foreach ( $categories as $category ) :
					$acf_term_id = $category->taxonomy . '_' . $category->term_id;
					$image = get_field( 'image', $acf_term_id );
					?>
					<div class="col-6 col-md-4 col-lg-2 d-flex p-1 p-xl-2">
						<div class="category__item bg-warning w-100 rounded-lg p-2">
							<a href="<?php echo get_term_link( $category ) ?>"
							   class="category__link h-100 d-flex d-flex align-items-center justify-content-between">
								<strong class="category__name"><?php echo $category->name; ?></strong>
								<?php if ( $image ) : ?>
									<img class="category__img ml-2 rounded-sm" src="<?php echo $image['url']; ?>"
									     alt="<?php echo $category->name; ?>" width="<?php echo $image['width'] ?>"
									     height="<?php echo $image['height'] ?>">
								<?php endif; ?>
							</a>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</div>