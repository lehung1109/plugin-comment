<?php
/**
 * The template for displaying search results pages
 *
 * @package MarTek
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

	<div class="main container" id="content" tabindex="-1">

		<div class="row">

			<main class="<?php echo is_active_sidebar( 'main-sidebar' ) ? 'content-area col-md-8' : 'content-area col-md-12'; ?>" id="main">

				<?php if ( have_posts() ) : ?>

					<header class="page-header">

						<h1 class="page-title">
							<?php
							printf(
							/* translators: %s: query term */
								esc_html__( 'Search Results for: %s', 'martek' ),
								'<span>' . get_search_query() . '</span>'
							);
							?>
						</h1>

					</header><!-- .page-header -->

					<?php /* Start the Loop */ ?>
					<?php
					while ( have_posts() ) :
						the_post();

						/*
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
						 */
						get_template_part( 'templates/content', 'search' );
					endwhile;
					?>

				<?php else : ?>

					<?php get_template_part( 'templates/content', 'none' ); ?>

				<?php endif; ?>

				<!-- The pagination component -->
				<?php martek_pagination(); ?>

			</main>

			<?php if ( is_active_sidebar( 'main-sidebar' ) ) : ?>
				<aside class="widget-area col-md-4" id="widget">
					<?php dynamic_sidebar( 'main-sidebar' ); ?>
				</aside>
			<?php endif; ?>

		</div><!-- .row -->

	</div><!-- #content -->

<?php
get_footer();
