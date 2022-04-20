<?php
/**
 * Template Name: Component Page
 * Description: The template for component page.
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
echo '<main class="main" id="main">';

if ( !is_front_page() && function_exists('yoast_breadcrumb') ) : ?>
	<div class="breadcrumbs py-2">
		<div class="container">
			<?php yoast_breadcrumb( '<nav class="yoast-breadcrumb" id="breadcrumbs">','</nav>' ); ?>
		</div>
	</div>
<?php endif;

while ( have_posts() ) :
	the_post();

	if ( have_rows( 'flexible_content' ) ):
		while ( have_rows( 'flexible_content' ) ) : the_row();
			$component_name = str_replace( '_', '-', get_row_layout() );
			get_template_part( 'templates/components/' . $component_name );
		endwhile;
	else :
		get_template_part( 'templates/content', 'none' );
	endif;
endwhile;

echo '</main>';
get_footer();
