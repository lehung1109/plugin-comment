<?php if ( $layout = get_sub_field( 'layout' ) ) : ?>
	<div class="banner py-4 py-md-6">
		<div class="container">
			<div class="row">
				<?php
				$layout_name = str_replace( '_', '-', $layout );
				get_template_part( 'templates/components/banner-' . $layout_name );
				?>
			</div>
		</div>
	</div>
<?php endif; ?>