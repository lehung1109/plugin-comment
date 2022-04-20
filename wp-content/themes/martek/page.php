<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Martek
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

?>

	<div class="main container" id="content" tabindex="-1">

		<div class="row">

			<main class="<?php echo is_active_sidebar( 'main-sidebar' ) ? 'content-area col-md-8' : 'content-area col-md-12'; ?>" id="main">

				<?php
				while ( have_posts() ) {
					the_post();
					get_template_part( 'templates/content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				}
				?>

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
