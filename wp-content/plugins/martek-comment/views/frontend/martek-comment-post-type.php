<?php

	if ( post_password_required() ) { ?>
			<p class="nocomments"><?php _e( 'This post is password protected. Enter the password to view comments.' ); ?></p>
		<?php
		return;
	}
	?>

	<!-- You can start editing here. -->

	<?php
	    do_action( 'martek_comment_post_type_comments' );
	?>

