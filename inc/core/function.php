<?php
if (!defined('ABSPATH')) exit; // No direct access allowed


function create_values_wc_f_p_c($id)
{
    $values = get_post_custom($id);
    // Expiry date.
    woocommerce_wp_checkbox(
        array(
            'id' => 'first_purchase',
            'label' => __('اولین خرید', 'wc_f_p_c'),
            'description' => __('اگر میخواهید این کد فقط برای اولین خرید فعال باشد ، فعال کنید.', 'wc_f_p_c'),
            'value' => @$values['first_purchase'][0],

        )
    );
    woocommerce_wp_text_input(
        array(
            'id' => 'alert_first_purchase',
            'value' => isset($values['alert_first_purchase'][0]) ? $values['alert_first_purchase'][0] : __('این کد تخفیف فقط برای اولین خرید قابل استفاده است.', 'wc_f_p_c'),
            'label' => __('پبغام برای اولین خرید', 'wc_f_p_c'),
            'placeholder' => '',
            'description' => '',
            'class' => '',
        )
    );
}

add_action('woocommerce_coupon_options', 'create_values_wc_f_p_c');

function save_values_wc_f_p_c($post_id)
{

    update_post_meta($post_id, 'first_purchase', (true == $_POST['first_purchase']) ? 'yes' : 'no');
    update_post_meta($post_id, 'alert_first_purchase', $_POST['alert_first_purchase']);
}

add_action('woocommerce_coupon_options_save', 'save_values_wc_f_p_c');

function validate_coupon_wc_f_p_c($result, $the_coupon)
{
    if (get_post_meta($the_coupon->get_id(), 'first_purchase')[0] == "yes") {
        $customer_orders = get_posts(array(
            'numberposts' => -1,
            'meta_key' => '_customer_user',
            'meta_value' => get_current_user_id(),
            'post_type' => 'shop_order', // WC orders post type
            'post_status' => 'wc-completed' // Only orders with status "completed"
        ));
        if (count($customer_orders) > 0) {
            return false;
        }
        return true;
    }
}

add_filter('woocommerce_coupon_is_valid', 'validate_coupon_wc_f_p_c', 10, 2);

function massage_coupon_wc_f_p_c($result, $code, $the_coupon)
{

    if (get_post_meta($the_coupon->get_id(), 'first_purchase', true) == "yes") {
        $customer_orders = get_posts(array(
            'numberposts' => -1,
            'meta_key' => '_customer_user',
            'meta_value' => get_current_user_id(),
            'post_type' => 'shop_order', // WC orders post type
            'post_status' => 'wc-completed' // Only orders with status "completed"
        ));
        if (count($customer_orders) > 0) {
            return get_post_meta($the_coupon->get_id(), 'alert_first_purchase', true);

        }
        return $result;
    }

    return $result;
}

add_filter('woocommerce_coupon_error', 'massage_coupon_wc_f_p_c', 10, 3);


