<?php $status = $__variables["status"] ?? null; ?>

<?php if ( $status ) : ?>
	<div class="mp-status">
		<span class="text-dark text-uppercase font-weight-bold"><?php echo __('Status: ', 'martek-product'); ?></span>
		<strong class="text-success"><?php echo $status; ?></strong>
	</div>
<?php endif; ?>