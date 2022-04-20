<?php $icon = $args['icon'] ?? false; ?>
<?php $content = $args['content'] ?? ''; ?>


<div class="martek-alert alert alert-success" role="alert">
	<?php if ( $icon ) : ?>
		<i class="martek-alert__icon fa fa-paperclip fa-2x float-left mt-2 mr-2" aria-hidden="true"></i>
	<?php endif; ?>
	<div class="martek-alert__content">
		<?php echo $content ?>
	</div>
</div>