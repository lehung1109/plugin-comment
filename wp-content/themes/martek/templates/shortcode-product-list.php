<?php
$products = $args['products'] ?? '';
if ( $products[0] == null ) {
	return;
} ?>

<div class="martek-product-list">
	<?php foreach ($products as $product) :
		$obj = mp_get_product( $product->ID );?>
		<div class="martek-product-list__item d-flex flex-column flex-md-row align-items-center border shadow-sm rounded-lg p-3 mb-3">
			<?php echo get_the_post_thumbnail( $product->ID, 'thumbnail', [ 'class' => 'martek-product-list__img mb-2 mb-md-0 mr-md-3' ] ); ?>
			<div class="martek-product-list__info d-flex flex-column align-items-center align-items-md-start mb-1 mb-md-0">
				<h5><a href="<?php echo get_the_permalink( $product->ID ); ?>"><?php echo $product->post_title; ?></a></h5>
				<?php echo kk_star_ratings( $product->ID ); ?>
				<div class="martek-product-list__sold-views mt-1">
					<i class="fa fa-check-circle-o text-primary mr-1" aria-hidden="true"></i>
					<span>Đã bán: <?php echo martek_get_sold_views( $product->ID ); ?></span>
				</div>
			</div>
			<div class="martek-product-list__action ml-md-auto text-center">
				<div class="martek-product-list__price mb-1"><?php echo $obj->get_price_html(); ?></div>
				<a class="btn btn-lg btn-primary" href="<?php echo get_the_permalink( $product->ID ); ?>">Xem khuyến mãi</a>
			</div>
		</div>
	<?php endforeach; ?>
</div>
