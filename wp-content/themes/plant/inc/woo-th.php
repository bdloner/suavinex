<?php
/**
 * WooCommerce Thai Adjustment by Seed Webs
 *
 * @package Plant
 */

/**
 * Change Billing Title to Shipping Title
 */
function plant_shipping_title( $page_title, $load_address ) {
    return "ที่อยู่ในการจัดส่ง";
}
add_filter( 'woocommerce_my_account_edit_address_title', 'plant_shipping_title', 10, 3 );

/*  Required Address_2 https://docs.woocommerce.com/document/tutorial-customising-checkout-fields-using-actions-and-filters/ */
add_filter( 'woocommerce_default_address_fields' , 'custom_override_default_address_fields' );
function custom_override_default_address_fields( $address_fields ) {
     $address_fields['address_2']['required'] = true;
     return $address_fields;
}