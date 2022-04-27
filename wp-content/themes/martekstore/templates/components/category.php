<?php
$icon       = get_sub_field( 'icon' );
$title      = get_sub_field( 'title' );
$categories = get_sub_field( 'categories' ); ?>

<div class="category my-4">
	<div class="container-lg">
		<div class="category__header d-flex align-items-center mb-1">
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
			<div class="category__items row mx-n1 mx-lg-n2 row-cols-md-5 flex-nowrap flex-md-wrap">
				<?php foreach ( $categories as $category ) :
					$acf_term_id = $category->taxonomy . '_' . $category->term_id;
					$image = get_field( 'image', $acf_term_id );
					?>
					<div class="category__item col-5 p-1 p-lg-2 d-flex">
						<a class="d-block bg-white rounded-lg shadow-sm p-2 w-100" href="<?php echo get_term_link( $category ) ?>">
							<div class="category_img ratio">
								<?php if ( $image ) : ?>
									<img class="d-block w-100 h-auto" src="<?php echo $image['url']; ?>"
									     alt="<?php echo $category->name; ?>" width="<?php echo $image['width'] ?>"
									     height="<?php echo $image['height'] ?>">
								<?php endif; ?>
							</div>
							<div class="category__name font-size-14 text-center"><?php echo $category->name; ?></div>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</div>