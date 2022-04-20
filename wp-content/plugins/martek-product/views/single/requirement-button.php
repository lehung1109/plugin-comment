<?php $class = !empty($__variables["class"]) ? 'mp-order-button ' . $__variables["class"] : 'mp-requirement btn btn-outline-primary btn-lg btn-block'; ?>

<button type="button" class="<?php echo $class; ?>" data-toggle="modal"
        data-target="#requirementButton">
	<?php echo __( 'Order requirement', 'martek-product' ); ?>
</button>