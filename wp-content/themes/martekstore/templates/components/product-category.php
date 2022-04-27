<?php
$icon       = get_sub_field( 'icon' );
$title      = get_sub_field( 'title' );
$categories = get_sub_field( 'categories' );
$show_more  = get_sub_field( 'show_more' );

$tax_term = [];
foreach ($categories as $category) {
	$tax_term[] = $category->slug;
}

$args = array(
	'post_type' => 'product',
	'post_status' => 'publish',
	'posts_per_page' => 4,
	'tax_query' => [
		[
			'taxonomy' => 'product_cat',
			'field' => 'slug',
			'terms' => $tax_term,
		]
	]
);

$query = new wp_query( $args );

?>

<div class="product-category my-4">
	<div class="container-lg">
		<div class="product-category__header d-flex justify-content-between align-items-center mb-1">
			<div class="product-category__heading d-flex align-items-center">
				<?php if ( $icon ) : ?>
					<img class="product-category__icon mr-2" src="<?php echo $icon['url'] ?>"
					     alt="<?php echo ! empty( $icon['alt'] ) ? $icon['alt'] : $icon['title']; ?>"
					     width="<?php echo $icon['width'] ?>" height="<?php echo $icon['height'] ?>">
				<?php endif; ?>
				<?php if ( $title ) : ?>
					<h2 class="product-category__title mb-0 pt-1">
						<?php echo $title; ?>
					</h2>
				<?php endif; ?>
			</div>
			<div class="product-category__explain d-none d-md-block">
				<a class="d-inline-block mt-1" href="<?php echo $show_more['url']; ?>" target="<?php echo $show_more['target']; ?>" >
					<span class="text-primary font-weight-bold m-0 pr-1"><?php echo $show_more['title']; ?></span>
					<i class="fa fa-play text-primary" aria-hidden="true"></i>
				</a>
			</div>
		</div>

		<div class="product-category__items row mx-n1 mx-lg-n2">
			<?php foreach ( $query->posts as $post ) : setup_postdata( $post ); ?>
				<div class="col-6 col-lg-3 p-1 p-lg-2 d-flex">
					<?php get_template_part( 'templates/product', 'card' ); ?>
				</div>
			<?php endforeach;
			wp_reset_postdata(); ?>
		</div>

		<div class="product-category__show-more text-center d-md-none mt-2">
			<a class="d-inline-block" href="<?php echo $show_more['url']; ?>" target="<?php echo $show_more['target']; ?>" >
				<span class="text-primary font-weight-bold m-0 pr-1"><?php echo $show_more['title']; ?></span>
				<i class="fa fa-play text-primary" aria-hidden="true"></i>
			</a>
		</div>
	</div>
</div>