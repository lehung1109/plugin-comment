<?php
$price_html       = __( 'Price: contact', 'martek-product' );
$regular_price = $__variables["regular_price"] ?? null;
$sale_price    = $__variables["sale_price"] ?? null;

if ( ! empty( $regular_price ) ) {
	$regular_price = number_format( floatval( $regular_price ) );
	$price_html       = "<strong>{$regular_price} đ</strong>";
	if ( ! empty( $sale_price ) ) {
		$sale_price = number_format( floatval( $sale_price ) );
		$price_html    = "<strong>{$sale_price} đ</strong><del class='ml-md-2'>{$regular_price} đ</del>";
	}
}
?>

<div class='mp-price d-flex flex-column flex-md-row'><?php echo $price_html; ?></div>