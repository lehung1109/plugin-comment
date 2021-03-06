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
	<header class="header bg-white shadow-sm">
		<?php if ( get_field( 'top_info', 'option' ) || have_rows( 'socials', 'option' ) ) : ?>
			<div class="header__top" style="background-color: #f4f5f7;">
				<div class="container-lg">
					<div class="d-flex justify-content-center justify-content-md-between">
						<?php if ( $top_info = get_field( 'top_info', 'option' ) ) : ?>
							<div class="top__info d-flex align-items-center font-size-14 my-1"><?php echo $top_info; ?></div>
						<?php endif; ?>

						<?php if ( have_rows( 'socials', 'option' ) ): ?>
							<div class="top__social-links d-none d-md-flex align-items-center">
								<?php while ( have_rows( 'socials', 'option' ) ): the_row(); ?>
									<?php if ( $facebook = get_sub_field( 'facebook' ) ) : ?>
										<a href="<?php echo $facebook; ?>" class="facebook" target="_blank" rel="nofollow">
											<svg width="25" height="25" viewBox="0 0 25 25" fill="none"
											     xmlns="http://www.w3.org/2000/svg">
												<path
													d="M13.5678 9.54375H14.5288V7.86985C14.363 7.84704 13.7928 7.79572 13.1288 7.79572C11.7432 7.79572 10.794 8.66732 10.794 10.2693V11.7436H9.26501V13.6149H10.794V18.3234H12.6687V13.6153H14.1358L14.3688 11.744H12.6682V10.4548C12.6687 9.91397 12.8143 9.54375 13.5678 9.54375Z"
													fill="#3c589a"/>
											</svg>
										</a>
									<?php endif; ?>

									<?php if ( $zalo = get_sub_field( 'zalo' ) ) : ?>
										<a href="<?php echo $zalo; ?>" class="zalo ml-3" target="_blank" rel="nofollow">
											<svg width="25" height="25" viewBox="0 0 25 25" fill="none"
											     xmlns="http://www.w3.org/2000/svg">
												<path
													d="M7.75965 19.1939H6.77161L7.47028 18.4953C7.84699 18.1185 8.08223 17.6286 8.14548 17.0971C7.16246 16.452 6.44363 15.6032 6.05884 14.6299C5.67433 13.6573 5.62601 12.5866 5.91912 11.5336C6.27081 10.2701 7.09569 9.1185 8.24176 8.29084C9.48717 7.39147 11.0376 6.91608 12.7254 6.91608C14.8515 6.91608 16.6437 7.52694 17.9079 8.68259C19.0469 9.72372 19.6741 11.1281 19.6741 12.637C19.6741 13.37 19.5249 14.0833 19.2305 14.757C18.9259 15.4541 18.4798 16.0749 17.9047 16.6019C16.6387 17.7621 14.8477 18.3754 12.7253 18.3754C11.9374 18.3754 11.1153 18.2702 10.3813 18.0772C9.68648 18.79 8.74499 19.1939 7.75965 19.1939Z"
													fill="#098ffa"/>
												<path
													d="M9.34878 13.5727C9.81405 13.5727 10.2516 13.5696 10.686 13.5727C10.9295 13.5758 11.062 13.6771 11.0866 13.8706C11.1143 14.1132 10.9726 14.276 10.7076 14.279C10.2085 14.2852 9.71237 14.2821 9.2132 14.2821C9.06838 14.2821 8.92665 14.2883 8.78183 14.279C8.60311 14.2698 8.42748 14.233 8.34121 14.0487C8.25493 13.8645 8.31656 13.6986 8.43364 13.5481C8.90816 12.9462 9.38575 12.3413 9.86335 11.7393C9.89108 11.7025 9.91881 11.6656 9.94654 11.6319C9.91573 11.5796 9.87259 11.6042 9.83562 11.6011C9.50284 11.5981 9.16698 11.6011 8.83421 11.5981C8.75718 11.5981 8.68015 11.5889 8.6062 11.5735C8.43056 11.5336 8.32272 11.3585 8.36278 11.1866C8.39051 11.0699 8.48294 10.9747 8.60003 10.947C8.67398 10.9286 8.75101 10.9194 8.82805 10.9194C9.37651 10.9163 9.92806 10.9163 10.4765 10.9194C10.5751 10.9163 10.6706 10.9286 10.7662 10.9532C10.9757 11.0238 11.065 11.2173 10.9818 11.42C10.9079 11.595 10.7908 11.7455 10.6737 11.896C10.2701 12.4088 9.86643 12.9186 9.46279 13.4253C9.42889 13.4652 9.39808 13.5052 9.34878 13.5727Z"
													fill="#ECF1F4"/>
												<path
													d="M12.9175 11.9531C12.9913 11.8574 13.0682 11.7678 13.1943 11.7431C13.4373 11.6936 13.665 11.8512 13.668 12.0983C13.6773 12.7162 13.6742 13.3341 13.668 13.952C13.668 14.1126 13.5634 14.2547 13.4127 14.3011C13.2589 14.3598 13.0836 14.3134 12.9821 14.1806C12.9298 14.1157 12.9082 14.1033 12.8344 14.162C12.5545 14.3907 12.2376 14.4308 11.8962 14.3196C11.3486 14.1404 11.1241 13.711 11.0626 13.1889C10.998 12.6235 11.1856 12.1416 11.6901 11.845C12.1084 11.5948 12.533 11.6164 12.9175 11.9531ZM11.8285 13.0808C11.8347 13.2167 11.8777 13.3464 11.9577 13.4546C12.1238 13.677 12.4407 13.7233 12.6652 13.5565C12.7021 13.5287 12.736 13.4947 12.7667 13.4546C12.939 13.2198 12.939 12.8336 12.7667 12.5988C12.6806 12.4783 12.5453 12.4073 12.4007 12.4042C12.0623 12.3826 11.8254 12.6452 11.8285 13.0808ZM15.0492 13.0993C15.0246 12.3053 15.5445 11.7122 16.2827 11.6905C17.0671 11.6658 17.6393 12.1941 17.6639 12.9665C17.6885 13.7481 17.2117 14.3011 16.4765 14.3752C15.6737 14.4555 15.0369 13.8716 15.0492 13.0993ZM15.8213 13.0252C15.8152 13.1796 15.8613 13.331 15.9536 13.4577C16.1228 13.6801 16.4396 13.7233 16.6611 13.5503C16.6949 13.5256 16.7226 13.4947 16.7503 13.4638C16.9287 13.229 16.9287 12.8336 16.7534 12.5988C16.6672 12.4814 16.5319 12.4073 16.3873 12.4042C16.0551 12.3857 15.8213 12.639 15.8213 13.0252ZM14.7785 12.4845C14.7785 12.9634 14.7816 13.4422 14.7785 13.9211C14.7816 14.1404 14.6093 14.3227 14.3909 14.3289C14.354 14.3289 14.314 14.3258 14.2771 14.3165C14.1233 14.2763 14.0064 14.1126 14.0064 13.918V11.4619C14.0064 11.3167 14.0033 11.1746 14.0064 11.0294C14.0095 10.7915 14.1602 10.6371 14.3878 10.6371C14.6216 10.634 14.7785 10.7884 14.7785 11.0356C14.7816 11.5175 14.7785 12.0026 14.7785 12.4845Z"
													fill="#ECF1F4"/>
											</svg>
										</a>
									<?php endif; ?>

									<?php if ( $youtube = get_sub_field( 'youtube' ) ) : ?>
										<a href="<?php echo $youtube; ?>" class="youtube ml-3" target="_blank" rel="nofollow">
											<svg width="25" height="25" viewBox="0 0 25 25" fill="none"
											     xmlns="http://www.w3.org/2000/svg">
												<path
													d="M19.0694 9.58792C18.9123 8.99795 18.4519 8.53288 17.868 8.37402C16.8012 8.07916 12.5342 8.07916 12.5342 8.07916C12.5342 8.07916 8.2673 8.07916 7.20055 8.36284C6.62787 8.52153 6.1562 8.99803 5.99911 9.58792C5.71838 10.6655 5.71838 12.9002 5.71838 12.9002C5.71838 12.9002 5.71838 15.1462 5.99911 16.2125C6.15636 16.8024 6.61664 17.2674 7.20064 17.4263C8.27853 17.7212 12.5343 17.7212 12.5343 17.7212C12.5343 17.7212 16.8012 17.7212 17.868 17.4376C18.452 17.2788 18.9123 16.8137 19.0696 16.2238C19.3502 15.1462 19.3502 12.9115 19.3502 12.9115C19.3502 12.9115 19.3614 10.6655 19.0694 9.58792ZM11.1756 14.9647V10.8357L14.7239 12.9002L11.1756 14.9647Z"
													fill="#F24423"/>
											</svg>
										</a>
									<?php endif; ?>
								<?php endwhile; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<div class="header__main d-none d-lg-block py-2 pt-md-3">
			<div class="container-lg">
				<div class="d-flex align-items-center justify-content-between">
					<div class="header__logo">
						<?php if ( ! has_custom_logo() ) { ?>
							<?php if ( is_front_page() && is_home() ) : ?>
								<h1 class="logo mb-0"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>"
								                         itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>
							<?php else : ?>
								<a class="logo" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>"
								   itemprop="url"><?php bloginfo( 'name' ); ?></a>
							<?php endif; ?>
							<?php
						} else {
							echo '<h1 class="m-0">';
							the_custom_logo();
							echo '</h1>';
						} ?>
					</div>

					<div class="header__search d-none d-md-block w-50">
						<form action="<?php echo esc_url( home_url( '/' ) ); ?>">
							<div class="input-group">
								<input type="text" name="s" class="form-control" placeholder="T??m ki???m"
								       data-swplive="true"/>
								<div class="input-group-append">
									<button class="btn btn-primary text-white px-lg-4" type="submit">
										<i class="fa fa-search fa-lg" aria-hidden="true"></i>
									</button>
								</div>
							</div>
						</form>
					</div>

					<?php if ( $phone = get_field( 'phone', 'option' ) ) : ?>
						<div class="header__phone">
							<a class="phone--in-header btn btn-primary text-white float-right" href="tel:<?php echo str_replace( ' ', '', $phone ); ?>">
								<i class="fa fa-phone fa-lg mr-2" aria-hidden="true"></i>
								<span><?php echo $phone ?></span>
							</a>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="header__nav">
			<div class="container-lg">
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
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
