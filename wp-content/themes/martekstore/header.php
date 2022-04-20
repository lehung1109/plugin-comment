<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package MarTek
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php martek_body_attributes(); ?>>
<?php do_action( 'wp_body_open' ); ?>
<a href="#main" class="sr-only sr-only-focusable"><?php esc_html_e( 'Skip to main content', 'martekstore' ); ?></a>

<div class="page" id="page">
	<header class="header shadow-sm">
		<div class="header__main navbar navbar-expand-md bg-white py-0 px-md-0">
			<div class="container">
				<?php if ( ! has_custom_logo() ) { ?>
					<?php if ( is_front_page() && is_home() ) : ?>
						<h1 class="navbar-brand mb-0"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a>
					<?php endif; ?>
					<?php
				} else {
					if ( is_front_page() ) {
						echo '<h1 class="m-0">';
						the_custom_logo();
						echo '</h1>';
					}
					else {
						the_custom_logo();
					}
				}
				?>

				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'primary',
						'container_class' => 'collapse navbar-collapse',
						'container_id'    => 'navbarNavDropdown',
						'menu_class'      => 'navbar-nav ml-auto',
						'fallback_cb'     => '',
						'menu_id'         => 'main-menu',
						'depth'           => 2,
						'walker'          => new Martek_WP_Bootstrap_Navwalker(),
					)
				);
				?>

				<?php if ( $phone = get_field( 'phone', 'option' ) ) : ?>
					<a class="phone--in-header btn btn-primary d-none d-lg-block" href="tel:<?php echo str_replace( ' ', '', $phone ); ?>">
						<i class="fa fa-phone fa-lg mr-1" aria-hidden="true"></i>
						<span><?php echo $phone ?></span>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</header>

	<?php
	ob_start();
	dynamic_sidebar('ads-top');
	$ads_top = ob_get_clean();
	if ( $ads_top ) : ?>
		<div class="py-2 pb-md-0 pt-md-4 text-center">
			<div class="container">
				<?php echo $ads_top; ?>
			</div>
		</div>
	<?php endif; ?>
