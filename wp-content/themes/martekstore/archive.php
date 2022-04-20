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

get_header();
?>

	<div class="main" id="content" tabindex="-1">
		<div class="container">
			<?php yoast_breadcrumb( '<nav class="yoast-breadcrumb font-size-12 py-2" id="breadcrumbs">', '</nav>' ); ?>

			<div class="row">
				<main
					class="<?php echo is_active_sidebar( 'main-sidebar' ) ? 'content-area col-md-9' : 'content-area col-md-12'; ?>"
					id="main">

					<?php if ( have_posts() ) { ?>
						<header class="page-header">
							<?php if ( get_query_var( 'author_name' ) ) :
								$curauth = get_user_by( 'slug', get_query_var( 'author_name' ) ); ?>
								<h1><?php echo esc_html__( 'Người viết:', 'martekstore' ) . ' ' . esc_html( $curauth->nickname ); ?></h1>
							<?php else: ?>
								<h1><?php echo single_term_title(); ?></h1>
							<?php endif; ?>

							<?php the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>
						</header>

						<div class="row">
							<?php
							// Start the loop.
							while ( have_posts() ) {
								the_post();
								echo '<div class="col-lg-6 col-12 d-flex mb-4">';
								/*
								 * Include the Post-Format-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								get_template_part( 'templates/content', 'card' );
								echo '</div>';
							}
							?>
						</div>
						<?php
					} else {
						get_template_part( 'templates/content', 'none' );
					}
					?>

					<?php
					// Display the pagination component.
					martek_pagination();
					?>
				</main>

				<?php if ( is_active_sidebar( 'main-sidebar' ) ) : ?>
					<aside class="widget-area col-md-3" id="widget">
						<?php dynamic_sidebar( 'main-sidebar' ); ?>
					</aside>
				<?php endif; ?>

			</div><!-- .row -->
		</div>
	</div>

<?php
get_footer();
