<?php $quantity = $__variables["quantity"] ?? null; ?>

<?php if ( $quantity ) : ?>
	<div class="mp-quantity form-group mb-0">
		<label class="d-inline-block font-size-14 text-uppercase font-weight-bold text-dark mb-0" for="quantity"><?php echo __('Quantity: ', 'martek-product'); ?></label>
		<select class="form-control form-control-sm d-inline-block" style="width: auto;" id="quantity">
			<?php for ( $i = 1; $i <= $quantity; $i ++ ) : ?>
				<option><?php echo $i; ?></option>
			<?php endfor; ?>
		</select>
	</div>
<?php endif; ?>