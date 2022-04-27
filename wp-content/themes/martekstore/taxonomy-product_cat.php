<?php
/**
 * The template for displaying archive pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package MarTek
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

global $wp_embed;
$term          = get_queried_object();
$description   = $wp_embed->run_shortcode( $term->description );
$content_parts = get_extended( wpautop( $description ) );

$meta   = get_option( 'wpseo_taxonomy_meta' );
$title  = $meta[$term->taxonomy][$term->term_id]['wpseo_title'] ?? '';

get_header(); ?>

	<main class="main" id="main">
		<div class="container-lg">
			<?php yoast_breadcrumb( '<nav class="yoast-breadcrumb font-size-14 mt-2" id="breadcrumbs">','</nav>' ); ?>
			<hr class="mt-1 mb-2">
			<div class="page__header">
				<h1>
					<?php
					if ( isset( $meta ) && ! empty( $title ) ) :
						echo apply_filters( 'the_title', $title );
					else :
						single_term_title();
					endif;
					?>
				</h1>

				<?php if ( ! empty( $content_parts['extended'] ) ) : ?>
					<div class="taxonomy-description entry-content read-more">
						<input type="checkbox" id="read-more" role="button">
						<label for="read-more" onclick="">
									<span class="font-weight-bold">
										Đọc thêm
										<i class="fa fa-long-arrow-right ml-1" aria-hidden="true"></i>
									</span>
							<span class="font-weight-bold">
										Rút gọn
									</span>
						</label>
						<div class="read-more__excerpt">
							<?php echo do_shortcode( martek_content($content_parts['main']) ); ?>
						</div>
						<div class="read-more__extended">
							<?php echo do_shortcode( martek_content( $content_parts['extended'] ) ); ?>
						</div>
					</div>
				<?php else: ?>
					<div class="taxonomy-description entry-content">
						<?php echo do_shortcode( martek_content(wpautop($description)) ); ?>
					</div>
				<?php endif; ?>
			</div>

			<div class="row mx-n1 mx-lg-n2">
				<?php
				if ( have_posts() ) {
					// Start the loop.
					while ( have_posts() ) {
						the_post();
						echo '<div class="col-6 col-md-4 col-lg-3 p-1 p-lg-2 d-flex">';
						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'templates/product', 'card' );
						echo '</div>';
					}
				} else {
					get_template_part( 'templates/content', 'none' );
				}
				?>
			</div>
			<?php
			// Display the pagination component.
			martek_pagination();
			?>
		</div>
	</main>
<?php
get_footer();
