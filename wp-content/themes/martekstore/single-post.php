<?php
/**
 * The template for displaying all single posts
 *
 * @package MarTek
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

	<div class="main container pt-md-6" id="content" tabindex="-1">

		<div class="row bg-white shadow-sm rounded-sm">

			<main class="<?php echo is_active_sidebar( 'main-sidebar' ) ? 'content-area col-md-8 p-4' : 'content-area col-md-12 p-4'; ?>" id="main">
				<?php yoast_breadcrumb( '<nav class="yoast-breadcrumb font-size-14 mb-2" id="breadcrumbs">', '</nav>' ); ?>

				<?php while ( have_posts() ) : the_post(); ?>
					<article <?php post_class( 'entry' ); ?> id="post-<?php the_ID(); ?>">
						<header class="entry-header">
							<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
							<div class="entry-meta d-flex flex-column flex-md-row align-items-md-center justify-content-md-between mb-3">
								<a class="post-author b-block d-md-inline-flex align-items-md-center" href="<?php echo esc_url( get_author_posts_url( (int) get_the_author_meta( 'ID' ) ) ); ?>">
									<?php echo get_avatar( (int) get_the_author_meta( 'ID' ), 52, '', get_the_author(), [ 'class' => 'rounded-circle mr-2' ] ); ?>
									<span class="post-author__info font-weight-bold"><?php echo get_the_author(); ?></span>
								</a>
							</div>
						</header>

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
									<div class="font-size-14 font-weight-bold">Đánh giá bài viết</div>
									<?php echo kk_star_ratings(); ?>
									<div class="entry-time mt-1">
										<em>Thời gian cập nhật: <?php the_modified_date(); ?></em>
									</div>
								</div>
							</div>
						</footer>
					</article>

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
						echo do_shortcode('[martek-comment-post-type]');
				endwhile;
				?>

			</main>

			<?php if ( is_active_sidebar( 'main-sidebar' ) ) : ?>
				<aside class="widget-area col-md-4 p-4" id="widget">
					<?php dynamic_sidebar( 'main-sidebar' ); ?>
				</aside>
			<?php endif; ?>

		</div>

	</div>

	<?php martek_post_related( get_the_ID() ); ?>

	<?php if ( wp_is_mobile() ) :
		$phone = get_field( 'phone', 'option' ); ?>
		<div class="d-md-none d-flex align-items-stretch justify-content-between fixed-bottom bg-white p-2">
			<a class="d-flex flex-column align-items-center" href="<?php echo home_url(); ?>">
				<i class="fa fa-home fa-lg text-primary mt-1" aria-hidden="true"></i>
				<small class="mt-1">Trang chủ</small>
			</a>
			<a class="d-flex flex-column align-items-center" href="#content">
				<i class="fa fa-share-alt fa-lg text-primary mt-1" aria-hidden="true"></i>
				<small class="mt-1">Chia sẻ</small>
			</a>
			<a class="d-flex flex-column align-items-center" href="#comments">
				<i class="fa fa-comment-o fa-lg text-primary mt-1" aria-hidden="true"></i>
				<small class="mt-1">Bình luận</small>
			</a>
		</div>
	<?php endif; ?>
<?php
get_footer();
