<?php
add_filter('woocommerce_get_availability', 'remove_stock_quantity_display', 10, 2);

function remove_stock_quantity_display($availability, $product)
{
    // Remove the availability message (including stock quantity)
    $availability['availability'] = '';
    return $availability;
}
