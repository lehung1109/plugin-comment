<?php
/**
 * Partial template for content in page.php
 *
 * @package MarTek
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class( 'entry' ); ?> id="post-<?php the_ID(); ?>">
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title font-size-20 font-size-lg-32">', '</h1>' ); ?>
	</header>
	<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'martek' ),
				'after'  => '</div>',
			)
		);
		?>
	</div>
</article>
