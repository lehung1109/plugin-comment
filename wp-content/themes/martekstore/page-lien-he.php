<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$contact_form = get_field_object( 'contact', 'option' );
$contact_type = get_field( 'contact', 'option' );

?>

	<main class="main" id="main">

		<div class="main__content container" id="content" tabindex="-1">
			<?php yoast_breadcrumb( '<nav class="yoast-breadcrumb font-size-14 py-2" id="breadcrumbs">','</nav>' ); ?>

			<div class="row">

				<div class="col-md-8 mb-4 mb-md-0 content-area" id="primary">
					<main class="site-main" id="main" role="main">
						<h1><?php the_title() ?></h1>
						<?php the_content(); ?>
						<div class="contact-form">
							<p class="alert alert-success js-form-msg" style="display: none"><?php echo $contact_type['notice']; ?></p>
							<form class="js-google-form" id="<?php echo $contact_form['name']; ?>" action="<?php echo $contact_type['action']; ?>">
								<input type="hidden" name="<?php echo $contact_type['url']; ?>" value="<?php the_permalink(); ?>">

								<div class="form-group">
									<input class="form-control" type="text" name="<?php echo $contact_type['name']; ?>" placeholder="Họ tên">
								</div>
								<div class="form-row mb-3">
									<div class="col">
										<input class="form-control" type="text" name="<?php echo $contact_type['email']; ?>" placeholder="Email">
									</div>
									<div class="col">
										<input class="form-control js-mobile" type="text" name="<?php echo $contact_type['phone_number']; ?>" required placeholder="Số điện thoại *" pattern="(0){1}(9|8|7|5|3){1}[0-9]{8}">
									</div>
								</div>
								<div class="form-group">
									<input class="form-control" type="text" name="<?php echo $contact_type['title']; ?>" placeholder="Tiêu đề">
								</div>
								<div class="form-group">
									<textarea class="form-control" name="<?php echo $contact_type['content']; ?>" rows="7" placeholder="Nội dung"></textarea>
								</div>
								<button type="submit" class="btn btn-primary btn-lg px-5">Gửi</button>
							</form>
						</div>

					</main><!-- #main -->

				</div>

				<div class="col-md-4">
					<div class="map">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3725.1811866482267!2d105.82553391493188!3d20.98537298602197!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135acf5472bee3d%3A0x12d08ae5f02593e1!2zMzY4IFAuIFRy4bqnbiDEkGnhu4FuLCDEkOG7i25oIEPDtG5nLCBUaGFuaCBYdcOibiwgSMOgIE7hu5lp!5e0!3m2!1sen!2s!4v1639447499591!5m2!1sen!2s" width="100%" height="430" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
					</div>
				</div>
			</div><!-- .row -->

		</div><!-- #content -->

	</main><!-- #page-wrapper -->

<?php
get_footer();
