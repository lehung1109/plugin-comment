<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package MarTek
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<div class="product-card bg-white d-flex flex-column w-100 rounded-lg shadow-sm p-2 p-md-3 p-lg-2">
	<a class="product-card__img d-block bg-gradient-light ratio rounded-lg mb-2 mb-xl-3" href="<?php the_permalink(); ?>">
		<?php the_post_thumbnail( 'full', [ 'alt' => get_the_title(), 'class' => 'w-100 h-100'] ); ?>
	</a>
	<div class="flex-grow-1">
		<a class="product-card__link font-weight-bold" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</div>
	<?php echo kk_star_ratings( get_the_ID() ); ?>
	<div class="product-card__price my-2">
		<?php echo mp_get_price_html( get_the_ID() ); ?>
	</div>
	<div class="product-card__actions d-flex justify-content-between">
		<a href="<?php the_permalink(); ?>" class="btn btn-primary px-4">Đặt ngay</a>
		<a href="<?php the_permalink(); ?>" class="btn btn-secondary px-2 d-none d-md-block">Chi tiết</a>
	</div>
</div>

