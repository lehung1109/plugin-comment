<?php
$helpful_no_form = get_field_object( 'helpful_no', 'option' );
$helpful_no_type = get_field( 'helpful_no', 'option' );
?>

<div class="modal fade" id="helpfulNo" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content bg-light p-3 border-0">
			<div class="modal-body">
				<h4 class="text-uppercase mb-3">Gửi góp ý</h4>
				<p class="alert alert-success js-form-msg" style="display: none"><?php echo $helpful_no_type['notice']; ?></p>
				<form class="js-google-form" id="<?php echo $helpful_no_form['name']; ?>"
				      action="<?php echo $helpful_no_type['action']; ?>">
					<input type="hidden" name="<?php echo $helpful_no_type['url']; ?>" value="<?php the_permalink(); ?>">
					<div class="form-group">
						<input class="form-control bg-white js-email" type="email" name="<?php echo $helpful_no_type['email']; ?>" required placeholder="Email">
					</div>
					<div class="form-group">
						<textarea class="form-control bg-white" name="<?php echo $helpful_no_type['content']; ?>" cols="30" rows="5" placeholder="Nội dung nhắn gửi"></textarea>
					</div>
					<div class="d-flex mt-3">
						<button type="submit" class="btn btn-submit btn-primary">Gửi góp ý</button>
					</div>
				</form>
			</div>
			<button type="button" class="close position-absolute px-1 m-3 d-none d-lg-block" style="top: 0; right: 0" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	</div>

</div>