<?php

$unique   = uniqid();
$attachments = $args['attachments'] ?? ''; ?>

<div class="martek-carousel col-md-6 offset-md-3 my-3">
	<div class="carousel slide" id="<?php echo 'carousel-' . $unique; ?>" data-ride="carousel">
		<div class="carousel-inner">
			<?php foreach ( $attachments as $key => $attachment ) : ?>
				<div class="<?php echo ( $key == 0 ) ? 'carousel-item active' : 'carousel-item' ?>">
					<?php echo wp_get_attachment_image( $attachment, 'full', '', ['class' => 'w-100'] ); ?>
				</div>
			<?php endforeach; ?>
		</div>
		<button class="carousel-control-prev bg-transparent border-0" type="button"
		        data-target="<?php echo '#carousel-' . $unique; ?>" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</button>
		<button class="carousel-control-next bg-transparent border-0" type="button"
		        data-target="<?php echo '#carousel-' . $unique; ?>" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</button>
	</div>
</div>