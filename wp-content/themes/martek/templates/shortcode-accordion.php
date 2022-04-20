<?php
// generate unique code
$unique   = uniqid();
$expanded = $args['expanded'] ?? '';
$title    = $args['title'] ?? '';
$content  = $args['content'] ?? ''; ?>

<div class="martek-accordion card mb-3" id="accordion">
	<div class="card-header" id="<?php echo 'heading-' . $unique; ?>">
		<button class="martek-accordion-trigger border-0 bg-transparent" data-toggle="collapse" data-target="<?php echo '#collapse-' . $unique; ?>"
		        aria-expanded="<?php echo $expanded; ?>" aria-controls="<?php echo 'collapse-' . $unique; ?>">
			<?php echo $title; ?>
		</button>
	</div>
	<div id="<?php echo 'collapse-' . $unique; ?>" class="collapse p-3" aria-labelledby="<?php echo 'heading-' . $unique; ?>" data-parent="#accordion">
		<?php echo $content; ?>
	</div>
</div>