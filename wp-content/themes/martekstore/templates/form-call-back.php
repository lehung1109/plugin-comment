<?php
$call_back_form = get_field_object('call_back', 'option');
$call_back_type = get_field('call_back', 'option');
?>

<h4 class="text-uppercase text-white"><?php echo $call_back_form['label']; ?></h4>
<p class="alert alert-success js-form-msg" style="display: none"><?php echo $call_back_type['notice']; ?></p>
<form class="js-google-form" id="<?php echo $call_back_form['name']; ?>" action="<?php echo $call_back_type['action']; ?>">
	<input type="hidden" name="<?php echo $call_back_type['url']; ?>" value="<?php the_permalink(); ?>">
	<div class="input-group mb-1 mb-lg-2">
		<input class="form-control js-mobile" type="text" name="<?php echo $call_back_type['phone_number']; ?>" required placeholder="<?php echo $call_back_form['instructions']; ?>" pattern="(0){1}(9|8|7|5|3){1}[0-9]{8}">
		<div class="input-group-append">
			<button class="btn btn-light" type="submit"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
		</div>
	</div>
</form>