<?php
/*
Plugin Name: WC Custom Order Form
Description: Remove required fields on checkout for certain products
Author: James Fry
Author URI: https://github.com/jfbuildstuff
Version: 1.0

License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

/**
 * Check if WooCommerce is active.
 */
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {


    add_filter( 'woocommerce_checkout_fields' , 'woo_remove_billing_checkout_fields' );

    /**
     * Remove unwanted checkout fields
     *
     * @return $fields array
    */

    function woo_remove_billing_checkout_fields( $fields ) {

        if( woo_cart_has_product_ID() == true ) {
            unset($fields['billing']['billing_first_name']);
            unset($fields['billing']['billing_last_name']);
            unset($fields['billing']['billing_company']);
            unset($fields['billing']['billing_address_1']);
            unset($fields['billing']['billing_address_2']);
            unset($fields['billing']['billing_city']);
            unset($fields['billing']['billing_postcode']);
            unset($fields['billing']['billing_country']);
            unset($fields['billing']['billing_state']);
            unset($fields['billing']['billing_phone']);
            unset($fields['order']['order_comments']);
            unset($fields['billing']['billing_address_2']);
            unset($fields['billing']['billing_postcode']);
            unset($fields['billing']['billing_company']);
            unset($fields['billing']['billing_city']);
        }
        
        //blows away all fields except email address
        return $fields;
    }

    /**
     * Check if the cart contains product ID
     *
     * @return bool
    */

    function woo_cart_has_product_ID() {

        global $woocommerce;

        //set default ID to false
        $is_product_ID = false;

        // Get all products in cart
        $products = $woocommerce->cart->get_cart();

        // Loop through cart products
        foreach( $products as $product ) {
              
            // Check if specific product IDs match
            if( $product['product_id'] == 125 || $product['product_id'] == 471 ) { 
                $is_product_ID = true;
            }

        }

        return $is_product_ID;
    }
}