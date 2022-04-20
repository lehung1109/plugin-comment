<?php $image_id = $__variables["image_id"] ?? null; ?>
<div class="mp-image">
	<?php echo wp_get_attachment_image( $image_id, 'full', '', ['class' => 'rounded-lg'] ); ?>
</div>
