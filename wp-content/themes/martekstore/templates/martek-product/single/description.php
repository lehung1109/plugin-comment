<?php $description = $__variables["description"] ?? get_the_excerpt(); ?>

<?php if ( $description ) : ?>
	<div class="mp-description mt-4">
		<?php echo $description; ?>
	</div>
<?php endif; ?>