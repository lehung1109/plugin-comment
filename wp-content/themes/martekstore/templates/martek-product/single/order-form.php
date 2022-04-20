<?php
$image_id = $__variables['image_id'] ?? null;
$price = $__variables['price'] ?? null;
$variation = $__variables['variation_name'] ?? null;
?>

<div class="modal fade" id="orderButton" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content bg-gradient-light p-3 border-0">
			<h2 class="modal-title text-primary text-center mb-3"><?php the_title(); ?></h2>
			<div class="modal-body p-0 p-lg-3">
				<div class="row">
					<div class="col-lg-6 col-md-12">
						<div class="row mb-3">
							<div class="col-6">
								<div class="mp-info-order-image">
									<?php echo wp_get_attachment_image( $image_id, 'thumbnail', '', ['class' => 'rounded-lg'] ); ?>
								</div>
							</div>
							<div class="col-6">
								<div class="h4">Giá: <span class="mp-info-order-total"><?php echo number_format( floatval( $price ) ) . ' đ'; ?></span></div>
								<?php echo kk_star_ratings(); ?>
								<div class="<?php echo !empty($variation) ? 'text-dark' : 'd-none'; ?>">Loại sản phẩm: <span class="mp-info-order-variation"><?php echo $variation; ?></span></div>
								<div class="text-dark">Số lượng: <span class="mp-info-order-quantity">1</span></div>
								<div class="text-dark">Lượt mua: <?php echo martek_get_sold_views( get_the_ID() ); ?></div>
								<div class="text-dark">Chia sẻ: <?php echo martek_get_share_views( get_the_ID() ); ?></div>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-12 text-danger">
								Bạn vui lòng nhập đúng số điện thoại để chúng tôi sẽ gọi xác nhận đơn hàng trước khi giao hàng. Xin cảm ơn!
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-12">
						<h4 class="text-uppercase mb-3">Thông tin mua hàng</h4>
						<form action="#">
							<input class="mp-form-product" type="hidden" value="">
							<input class="mp-form-variation" type="hidden" value="">
							<input class="mp-form-price" type="hidden" value="">
							<input class="mp-form-quantity" type="hidden" value="">
							<input class="mp-form-total" type="hidden" value="">
							<input class="mp-form-url" type="hidden" value="">

							<div class="form-group">
								<input class="form-control bg-white" type="text" placeholder="Họ tên">
							</div>
							<div class="form-group">
								<input class="form-control bg-white" type="text" placeholder="Số điện thoại">
							</div>
							<div class="form-group">
								<input class="form-control bg-white" type="text" placeholder="Địa chỉ">
							</div>
							<div class="form-group">
								<textarea class="form-control bg-white" name="" id="" rows="3" placeholder="Ghi chú"></textarea>
							</div>
							<div class="input-group mb-3">
								<input type="text" class="form-control bg-white" placeholder="Mã giảm giá">
								<div class="input-group-append">
									<button class="btn btn-primary px-4" type="button">Áp dụng</button>
								</div>
							</div>
							<button type="button" class="btn btn-primary btn-lg px-5">Đặt mua</button>
							<a href="javascript:void(0)" data-dismiss="modal" aria-label="Close" class="ml-3">Hủy đơn hàng ?</a>
						</form>
					</div>
				</div>
			</div>
			<button type="button" class="close position-absolute px-1 m-3 d-none d-lg-block border-0 bg-transparent" style="top: 0; right: 0" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	</div>
</div>