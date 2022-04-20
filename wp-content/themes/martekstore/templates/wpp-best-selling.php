<?php $popular_post = $args['popular_post'] ?? null; ?>

<div class="col-12 col-md-6 d-flex p-1 p-xl-2">
	<div class="best-selling__item w-100 d-flex align-items-center p-2 p-lg-3 bg-white rounded-lg shadow-sm">
		<div class="best-selling__position mr-2 mr-md-3">
			<span class="best-selling__number d-flex align-items-center justify-content-center text-warning font-weight-bold mb-0 mt-2"></span>
		</div>
		<?php echo get_the_post_thumbnail( $popular_post->id, 'thumbnail', [ 'alt' =>  $popular_post->title, 'class' => 'best-selling__img rounded-sm mr-2 mr-md-3' ] ); ?>
		<div class="best-selling__inner">
			<h3 class="best-selling__title">
				<a class="best-selling__link"
				   href="<?php echo get_the_permalink( $popular_post->id ); ?>">
					<?php echo $popular_post->title; ?>
				</a>
			</h3>

			<div class="best-selling__meta d-flex flex-column flex-lg-row">
				<?php echo kk_star_ratings( $popular_post->id ); ?>
				<div class="best-selling__sold-views mt-2 mt-lg-1 ml-lg-4">
					<i class="fa fa-check-circle-o text-primary mr-1" aria-hidden="true"></i>
					<span>Đã bán: <?php echo martek_get_sold_views( $popular_post->id ); ?></span>
				</div>
			</div>
		</div>
	</div>
</div>