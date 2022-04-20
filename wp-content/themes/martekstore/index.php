<?php
/**
 * Description: The template for displaying the Blog index /blog.
 *
 * @package Martek
 */

get_header();

$page_id = get_option( 'page_for_posts' );
?>
<div class="main" id="main">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php echo apply_filters( 'the_content', get_post_field( 'post_content', $page_id ) ); ?>
			</div>
		</div>
	</div>
</div>

<?php
get_footer();
