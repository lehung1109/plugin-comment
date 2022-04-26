<?php if ( function_exists( 'wpp_get_mostpopular' ) ) :
	$icon  = get_sub_field( 'icon' );
	$title = get_sub_field( 'title' ); ?>

	<div class="best-selling bg-primary py-4 py-md-6">
		<div class="container">
			<div class="best-selling__header d-flex align-items-center mb-2">
				<?php if ( $icon ) : ?>
					<img class="category__icon mr-2" src="<?php echo $icon['url'] ?>"
					     alt="<?php echo ! empty( $icon['alt'] ) ? $icon['alt'] : $icon['title']; ?>"
					     width="<?php echo $icon['width'] ?>" height="<?php echo $icon['height'] ?>">
				<?php endif; ?>
				<?php if ( $title ) : ?>
					<h2 class="category__title text-white mb-0 mt-2">
						<?php echo $title; ?>
					</h2>
				<?php endif; ?>
			</div>

			<div class="best-selling__items row mx-n1 mx-xl-n2">
				<?php
				wpp_get_mostpopular( [
					'post_type' => 'product',
					'taxonomy'  => 'product_cat',
					'range'     => 'all',
					'post_html' => 'wpp-best-selling',
					'wpp_start' => '',
					'wpp_end'   => ''
				] );
				?>
			</div>
		</div>
	</div>
<?php endif; ?>