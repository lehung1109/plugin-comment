<?php

$title   = $args['title'] ?? '';
$content = $args['content'] ?? ''; ?>

<div class="martek-fieldset border border-primary rounded p-3 my-4">
	<div class="martek-fieldset-legend bg-white font-weight-bold text-primary text-uppercase"><?php echo $title; ?></div>
	<div class="martek-fieldset-content mt-4 mt-lg-0"><?php echo $content; ?></div>
</div>