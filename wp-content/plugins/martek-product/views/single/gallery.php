<?php $gallery = $__variables["gallery"] ?? null; ?>

<?php if ( $gallery ) : ?>
	<div id="mp-gallery-main" class="mp-gallery-main carousel slide mb-3"
	     data-ride="carousel" data-interval="false">
		<div class="mp-gallery-inner carousel-inner">
			<?php foreach ( $gallery as $key => $image ) : ?>
				<div
					class="<?php echo ( $key === key( $gallery ) ) ? 'mp-gallery-main-item carousel-item active' : 'mp-gallery-main-item carousel-item'; ?>"
					data-slide-number="<?php echo $key; ?>">
					<img src="<?php echo $image['url']; ?>"
					     alt="<?php echo get_the_title() ?>"
					     class="d-block w-100 border rounded-lg shadow-sm"
					     width="<?php echo $image['width']; ?>"
					     height="<?php echo $image['height']; ?>">
				</div>
			<?php endforeach; ?>
		</div>
	</div>

	<div id="mp-gallery-thumb" class="mp-gallery-thumb carousel slide" data-ride="carousel">
		<div class="mp-gallery-inner carousel-inner">
			<div class="mp-gallery-thumb-item carousel-item active">
				<div class="row mx-0">
					<?php foreach ( $gallery as $key => $image ) : reset( $gallery ); ?>
						<div id="carousel-selector-<?php echo $key; ?>"
						     class="<?php echo ( $key === key( $gallery ) ) ? 'mp-thumb col-3 col-sm-3 px-2 mb-3 selected' : 'mp-thumb col-3 col-sm-3 px-2 mb-3'; ?>"
						     data-target="#mp-gallery-main"
						     data-image-id="<?php echo $image['id']; ?>"
						     data-slide-to="<?php echo $key; ?>">
							<img src="<?php echo $image['sizes']['thumbnail']; ?>"
							     alt="<?php echo get_the_title() ?>"
							     class="d-block border rounded-lg shadow-sm"
							     width="150" height="150">
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
<?php else : ?>
	<?php the_post_thumbnail( 'full', array( 'alt' => get_the_title(), 'class' => 'mw-100 mx-auto h-auto d-block' ) ); ?>
<?php endif; ?>
