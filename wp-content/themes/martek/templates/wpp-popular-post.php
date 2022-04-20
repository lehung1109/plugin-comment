<?php $popular_post = $args['popular_post'] ?? null; ?>

<li class="media mt-4">
	<a href="<?php echo get_the_permalink( $popular_post->id ); ?>" class="popular-posts__image d-block align-self-center mr-2">
		<?php echo get_the_post_thumbnail( $popular_post->id, 'thumbnail', ['class' => 'w-100 h-100'] ); ?>
	</a>

	<div class="popular-posts__body media-body">
		<a href="<?php echo get_the_permalink( $popular_post->id ); ?>" class="popular-posts__link font-weight-bold" title="<?php echo $popular_post->title; ?>" target="_self"><?php echo $popular_post->title; ?></a>
	</div>
</li>