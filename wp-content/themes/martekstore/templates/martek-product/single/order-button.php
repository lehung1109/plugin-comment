<?php
$class = !empty($__variables["class"]) ? 'mp-order-button ' . $__variables["class"] : 'mp-order-button btn btn-primary btn-lg btn-block font-size-16 text-white';
$name = $__variables["name"] ?? '';
$price = $__variables["price"] ?? '';
$variation_name = $__variables["variation_name"] ?? '';
?>

<button type="button"
        class="<?php echo $class; ?>"
        data-toggle="modal" data-target="#orderButton"
        data-name="<?php the_title(); ?>"
        data-price="<?php echo $price; ?>"
        data-quantity="1"
        data-variation="<?php echo $variation_name ?>"
        data-url="<?php the_permalink(); ?>"><?php echo __('Order now', 'martek-product'); ?></button>