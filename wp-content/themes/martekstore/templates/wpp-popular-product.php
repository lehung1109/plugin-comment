<?php
$popular_post = $args['popular_post'] ?? null;
$product = mp_get_product( $popular_post->id );

?>
<li class="media border-bottom py-2">
	<a class="popular-product__img d-block rounded-sm ratio mr-2" href="<?php echo get_the_permalink( $popular_post->id ); ?>" style="width: 85px;">
		<?php echo get_the_post_thumbnail( $popular_post->id, 'thumbnail', [ 'alt' => $popular_post->title, 'class' => 'w-100 h-100' ] ); ?>
	</a>

	<div class="popular-product__body media-body">
		<h3 class="font-size-14">
			<a class="popular-product__title d-block" href="<?php echo get_the_permalink( $popular_post->id ); ?>" title="<?php echo $popular_post->title; ?>">
				<span><?php echo $popular_post->title; ?></span>
			</a>
		</h3>
		<?php echo kk_star_ratings( $popular_post->id ); ?>
		<div class="popular-product__price">
			<?php echo $product->get_price_html(); ?>
		</div>
	</div>
</li>
