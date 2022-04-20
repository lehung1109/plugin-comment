<?php $popular_post = $args['popular_post'] ?? null; ?>

<li class="media border-bottom py-3">
	<a href="<?php echo get_the_permalink( $popular_post->id ); ?>" class="popular-posts__image d-block rounded-lg ratio mr-2" style="width: 85px;">
		<?php echo get_the_post_thumbnail( $popular_post->id, 'thumbnail', [ 'alt' => $popular_post->title, 'class' => 'w-100 h-100'] ); ?>
	</a>

	<div class="popular-posts__body media-body">
		<div class="popular-post__categories font-size-12 mb-1">
			<?php the_category(', ', '', $popular_post->id); ?>
		</div>
		<h3>
			<a href="<?php echo get_the_permalink( $popular_post->id ); ?>" class="popular-posts__link" title="<?php echo $popular_post->title; ?>" target="_self">
				<?php echo $popular_post->title; ?>
			</a>
		</h3>
	</div>
</li>