<?php

namespace DevTest;

class CustomizationsWoo
{
    
    private const COUPON_CODE = 'SUPERUSERDISCOUNT';
    private const USER_DISCOUNT_ID = 1;
    private const MIN_ADD_TO_CART_QUANTITY = 2;

    public function init()
    {
        add_filter( 'woocommerce_quantity_input_args', [$this, 'set_minimum_cart_quantity'], 20, 2);

        // Add coupon when user views cart before checkout (shipping calculation page).
        add_action( 'woocommerce_before_cart_table', [ $this, 'add_discount_on_all_products' ] );

        // Add coupon when user views checkout page (would not be added otherwise, unless user views cart first).
        add_action( 'woocommerce_before_checkout_form', [ $this, 'add_discount_on_all_products' ] );
    }

    function set_minimum_cart_quantity($args, $product)
    {

        $product_ids = ['16'];

        $quantity = self::MIN_ADD_TO_CART_QUANTITY;

        if (in_array($product->get_id(), $product_ids) || ($product->is_type('variation') && in_array($product->get_parent_id(), $product_ids))) {
            $args['min_value'] = $quantity;
        }

        return $args;
    }


    function add_discount_on_all_products()
    {

        global $woocommerce;
        $coupon_code = self::COUPON_CODE;

        // Only apply coupon if user id == 1.
        if ( get_current_user_id() == self::USER_DISCOUNT_ID ) {

            // If coupon has been already been added remove it.
            if ($woocommerce->cart->has_discount(sanitize_text_field($coupon_code))) {

                if (!$woocommerce->cart->remove_coupons(sanitize_text_field($coupon_code))) {

                    wc_print_notices();
                }
            }

            // Add coupon
            if (!$woocommerce->cart->add_discount(sanitize_text_field($coupon_code))) {

                wc_print_notices();
            } else {

                wc_print_notices();
            }

            // Manually recalculate totals. 
            $woocommerce->cart->calculate_totals();
        } else {

            // Coupon is not valid.  Remove it.
            if ($woocommerce->cart->has_discount(sanitize_text_field($coupon_code))) {

                if ($woocommerce->cart->remove_coupons(sanitize_text_field($coupon_code))) {

                    wc_print_notices();
                }

                // Recalculate totals. 
                $woocommerce->cart->calculate_totals();
            }
        }
    }
}
