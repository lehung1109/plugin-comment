<?php if ( $layout = get_sub_field( 'layout' ) ) : ?>
	<div class="banner my-4">
		<div class="container-lg">
			<div class="row">
				<?php
				$layout_name = str_replace( '_', '-', $layout );
				get_template_part( 'templates/components/banner-' . $layout_name );
				?>
			</div>
		</div>
	</div>
<?php endif; ?>