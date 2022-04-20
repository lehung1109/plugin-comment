(function ($) {

	/**
	 * Number.prototype.format(n, x)
	 *
	 * @param n
	 * @param x
	 */
	Number.prototype.format = function (n, x) {
		let re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
		return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
	};

	function update_order(qty) {
		let orderButton = $(' .mp-order-button ');
		let name = orderButton.data('name');
		let variation = orderButton.data('variation');
		let price = orderButton.data('price');
		let url = orderButton.data('url');
		let total = price * qty;

		// Model info
		$(' .mp-info-order-total ').text(total.format() + ' đ');
		$(' .mp-info-order-variation ').text(variation);
		$(' .mp-info-order-quantity ').text(qty);

		// Model form
		$('.mp-form-product').val(name);
		$('.mp-form-variation').val(variation);
		$('.mp-form-price').val(price);
		$('.mp-form-quantity').val(qty);
		$('.mp-form-total').val(total);
		$('.mp-form-url').val(url);
	}

	$(document).ready(function () {
		update_order(1);
		$('.mp-quantity select').change(function () {
			let qty = $(this).val();

			$(' .mp-order-button ').attr('data-quantity', qty);
			update_order(qty);
		});

		$('.mp-variation').click(function () {
			// Add class active
			$('.mp-variations').find('.active').removeClass('active');
			$(this).addClass('active');

			// Get data
			let id = $(this).data('id');
			let variation = $(this).data('variation');

			// Send Ajax
			$.post(ajaxurl, {
				action: "product_variations",
				id: id,
				variation: variation,
				nonce: nonce_product_variations
			}).done(function (result) {
				let {price, description, quantity, status, image, order_button, image_id} = result.data;
				$('.mp-price').replaceWith(price);
				$('.mp-description').replaceWith(description);
				$('.mp-quantity').replaceWith(quantity);
				$('.mp-status').replaceWith(status);
				$('.mp-order-button').replaceWith(order_button);

				// Order Form
				$('.mp-info-order-image').replaceWith(image);

				// Trigger gallery
				let slideTo = $("[data-image-id='" + image_id + "']").data('slide-to');
				$('#mp-gallery-main').carousel(slideTo);

				// Trigger quantity
				update_order(1);
				$('.mp-quantity select').change(function () {
					let qty = $(this).val();

					$(' .mp-order-button ').attr('data-quantity', qty);
					update_order(qty);
				});
			});
		})
	});
})(jQuery);