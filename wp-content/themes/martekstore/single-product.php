<?php
/**
 * The template for displaying all single products
 *
 * @package MarTek
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$product           = mp_get_product( get_the_ID() );
$product_cats      = wp_get_post_terms( get_the_ID(), 'product_cat' );
$product_cat_names = array();
foreach ( $product_cats as $product_cat ) {
	$product_cat_names[] = $product_cat->slug;
}

get_header();
?>

	<main class="main" id="main">
		<div class="container pt-md-6">
			<div class="row bg-white shadow-sm rounded-sm">
				<div class="col-lg-9 p-4">
					<div class="row">
						<div class="col-12 col-md-5">
							<?php echo $product->get_gallery_html(); ?>
						</div>
						<div class="col-12 col-md-7">
							<?php yoast_breadcrumb( '<nav class="yoast-breadcrumb font-size-14 mb-2 mt-2 mt-md-0" id="breadcrumbs">','</nav>' ); ?>
							<div class="single-product__info">
								<?php the_title( '<h1>', '</h1>' ); ?>
								<div
									class="d-flex flex-wrap justify-content-between align-items-center mb-md-4">
									<div class="mb-2 mb-md-0">
											<span>Đã bán: <span
													class="text-primary"><?php echo martek_get_sold_views( get_the_ID() ); ?></span></span>
									</div>
									<div class="mb-2 mb-md-0">
											<span>Chia sẻ: <span
													class="text-primary"><?php echo martek_get_share_views( get_the_ID() ); ?></span></span>
									</div>
									<div class="mb-2 mb-md-0">
										<?php echo kk_star_ratings(); ?>
									</div>
								</div>

								<?php echo $product->get_variations_html(); ?>

								<?php echo $product->get_price_html(); ?>

								<?php echo $product->get_description_html(); ?>

								<div class="d-flex flex-wrap justify-content-between align-items-center my-4">
									<?php echo $product->get_quantity_html(); ?>
									<?php echo $product->get_status_html(); ?>
								</div>
								<div
									class="d-flex flex-column flex-lg-row justify-content-between mb-4">
									<div class="flex-fill mb-2 mb-lg-0 mr-lg-2">
										<?php echo $product->get_order_button_html(); ?>
									</div>
									<div class="flex-fill ml-lg-2">
										<?php echo $product->get_requirement_button_html(); ?>
									</div>
								</div>

								<div class="bg-gradient-danger rounded-lg text-center p-3">
									<?php get_template_part( 'templates/form-call-back' ); ?>
								</div>

							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 p-4">
					<div class="entry-policies bg-light rounded-sm p-3 mb-3">
						<h3 class="text-uppercase text-center mb-3">Cam kết khách hàng</h3>
						<ul class="list-unstyled mb-0">
							<li class="media mb-2">
								<img width="20" height="20"
								     src="<?php echo get_stylesheet_directory_uri() . '/images/guarantee.svg' ?>"
								     class="mr-3" alt="Hàng chính hãng 100%">
								<div class="media-body">Hàng chính hãng 100%</div>
							</li>
							<li class="media mb-2">
								<img width="20" height="20"
								     src="<?php echo get_stylesheet_directory_uri() . '/images/quality.svg' ?>"
								     class="mr-3" alt="Uy tín chất lượng">
								<div class="media-body">Uy tín chất lượng</div>
							</li>
							<li class="media mb-2">
								<img width="20" height="20"
								     src="<?php echo get_stylesheet_directory_uri() . '/images/support.svg' ?>"
								     class="mr-3" alt="Hỗ trợ liên tục trong quá trình sử dụng sản phẩm">
								<div class="media-body">Hỗ trợ liên tục trong quá trình sử dụng sản phẩm</div>
							</li>
							<li class="media mb-2">
								<img width="20" height="20"
								     src="<?php echo get_stylesheet_directory_uri() . '/images/return.svg' ?>"
								     class="mr-3" alt="Chính sách đổi trả rõ ràng">
								<div class="media-body">Chính sách đổi trả rõ ràng</div>
							</li>
							<li class="media mb-2">
								<img width="20" height="20"
								     src="<?php echo get_stylesheet_directory_uri() . '/images/shipping.svg' ?>"
								     class="mr-3" alt="Giao hàng trên toàn quốc">
								<div class="media-body">Giao hàng trên toàn quốc</div>
							</li>
							<li class="media">
								<img width="20" height="20"
								     src="<?php echo get_stylesheet_directory_uri() . '/images/payment.svg' ?>"
								     class="mr-3" alt="Thanh toán tại nhà hoặc qua thẻ">
								<div class="media-body">Thanh toán tại nhà hoặc qua thẻ</div>
							</li>
						</ul>
					</div>
					<?php if ( get_field( 'promotion' ) ) :
						$promotion = get_field_object( 'promotion' ); ?>
						<div class="entry-promotion bg-light rounded-lg p-3">
							<h5 class="text-uppercase text-center"><?php echo $promotion['label']; ?></h5>
							<div class="entry-promotion__content"><?php echo $promotion['value']; ?></div>
						</div>
					<?php endif; ?>
				</div>
			</div>

			<div class="row bg-white shadow-sm rounded-sm mt-6">
				<div class="content-area col-md-8 p-4">
					<h3 class="font-size-20 mb-3">Thông tin sản phẩm</h3>
					<div class="entry-content text-justify">
						<?php
						the_content();
						ob_start();
						dynamic_sidebar( 'after-content' );
						echo ob_get_clean();
						?>
					</div>
					<footer class="entry-footer">
						<div class="entry-meta d-flex flex-column flex-md-row align-items-center justify-content-between mb-3">
							<div class="mb-3 mb-md-0">
								<h5>Đánh giá bài viết</h5>
								<?php echo kk_star_ratings(); ?>
								<div class="entry-time mt-1">
									<em>Thời gian cập nhật: <?php the_modified_date(); ?></em>
								</div>
							</div>
						</div>
					</footer>

					<?php
					ob_start();
					dynamic_sidebar('ads-after-content');
					$ads_after_content = ob_get_clean();
					if ( $ads_after_content ) : ?>
						<div class="mt-2 mt-lg-3 text-center">
							<?php echo $ads_after_content; ?>
						</div>
					<?php endif; ?>

					<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
					?>
				</div>

				<?php if ( is_active_sidebar( 'shop-sidebar' ) ) : ?>
					<div class="widget-area col-md-4 p-4">
						<?php dynamic_sidebar( 'shop-sidebar' ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</main>

	<?php martek_product_related( get_the_ID() ); ?>

	<?php if ( wp_is_mobile() ) :
		$phone = get_field( 'phone', 'option' ); ?>
		<div class="d-md-none d-flex align-items-stretch justify-content-between fixed-bottom bg-white font-size-12 p-2">
			<div class="item">
				<a target="_blank" class="d-flex flex-column align-items-center" href="<?php the_field( 'facebook_chat', 'option' ); ?>">
					<i class="fa fa-commenting-o fa-lg text-primary mt-1" aria-hidden="true"></i>
					<small class="mt-1">Facebook chat</small>
				</a>
			</div>
			<div class="item">
				<a class="d-flex flex-column align-items-center" href="tel:<?php echo str_replace(' ', '', $phone); ?>">
					<i class="fa fa-mobile fa-lg text-primary mt-1" aria-hidden="true"></i>
					<small class="mt-1">Gọi điện</small>
				</a>
			</div>
			<div class="item">
				<?php echo $product->get_order_button_html(0, 'btn btn-primary h-100 btn-sm btn-block'); ?>
			</div>
			<div class="item">
				<?php echo $product->get_requirement_button_html('mp-js-requirement btn btn-outline-primary h-100 btn-sm btn-block'); ?>
			</div>
		</div>
	<?php endif; ?>
<?php
get_footer();
