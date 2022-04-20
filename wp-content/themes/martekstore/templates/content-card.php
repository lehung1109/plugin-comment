<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package MarTek
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class( 'post-card d-flex flex-column w-100 shadow-sm rounded-lg p-3 mb-3' ); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<a href="<?php the_permalink(); ?>" class="post-card__img d-block bg-light ratio ratio--16-9 rounded-lg mb-3">
			<?php the_post_thumbnail( 'full', [ 'alt' =>  get_the_title(), 'class' => 'w-100 h-100' ] ); ?>
		</a>

		<div class="post-card__categories font-size-14 mb-1">
			<?php the_category( ', ' ); ?>
		</div>

		<?php
		the_title(
			sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
			'</a></h2>'
		);
		?>

	</header>

	<div class="entry-content mb-3 flex-grow-1">

		<?php echo get_the_excerpt(); ?>

	</div>

	<footer class="entry-footer">

		<a class="d-inline-block" href="<?php the_permalink(); ?>">
			<span class="text-primary h3 m-0 pr-1">Xem thêm</span>
			<i class="fa fa-play text-primary" aria-hidden="true"></i>
		</a>

	</footer>

</article>

