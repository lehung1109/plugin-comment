<div class="alert alert-info p-lg-5 mt-3 my-lg-4 text-center" id="was-this-helpful" data-post-id="<?php echo $post_id ?? ''; ?>" data-thank-text="<?php echo get_option( "dh_thank_text" ); ?>">
	<h4 id="dh-title"><?php echo get_option( "dh_question_text" ); ?></h4>
	<div class="mt-lg-4 mt-2" id="dh-yes-no">
		<span class="btn btn-success mr-md-3" data-value="1" data-toggle="modal" data-target="#helpfulYes">
			<i class="fa fa-thumbs-up"></i>
			<?php echo get_option( "dh_yes_text" ); ?>
		</span>
		<span class="btn btn-danger" data-value="0" data-toggle="modal" data-target="#helpfulNo">
			<i class="fa fa-thumbs-down"></i>
			<?php echo get_option( "dh_no_text" ); ?>
		</span>
	</div>
</div>