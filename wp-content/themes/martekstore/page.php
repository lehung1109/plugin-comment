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
<div class="main pt-md-6" id="main">
	<div class="container">
		<div class="row bg-white shadow-sm rounded-sm">
			<main class="<?php echo is_active_sidebar( 'main-sidebar' ) ? 'content-area col-md-8 p-4' : 'content-area col-md-12 p-4'; ?>">
				<?php yoast_breadcrumb( '<nav class="yoast-breadcrumb font-size-14 mb-2" id="breadcrumbs">', '</nav>' ); ?>
				<?php
				while ( have_posts() ) {
					the_post();
					get_template_part( 'templates/content', 'page' );

                    echo do_shortcode('[martek-comment-post-type]');
				}
				?>
			</main>

			<?php if ( is_active_sidebar( 'main-sidebar' ) ) : ?>
				<aside class="widget-area col-md-4 p-4" id="widget">
					<?php dynamic_sidebar( 'main-sidebar' ); ?>
				</aside>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php
get_footer();
