<?php $variations = $__variables["variations"] ?? null; ?>

<?php if ($variations) : ?>
<div class="mp-variations mb-3">
	<?php foreach ($variations as $key => $name) : ?>
		<button data-id="<?php echo get_the_ID(); ?>" data-variation="<?php echo $key; ?>" type="button" class="mp-variation <?php echo ( $key === key( $variations ) ) ? 'btn btn-outline-info active' : 'btn btn-outline-info'; ?>">
			<?php echo $name; ?>
		</button>
	<?php endforeach; ?>
</div>
<?php endif; ?>