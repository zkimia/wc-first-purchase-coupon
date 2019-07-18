<?php
/*
Plugin Name:پلاگین کد تخفیف اولین خرید
Plugin URI:https://zhaket.com/product/wc-first-purchase-coupon
Description:  بهترین پلاگین برای ارائه ی کد تخفیف اولین خرید
Version: 1.0.0
Author: Zeynab Kimiamehr
Author URI: https://zhaket.com/store/wp-kar/
Text Domain: wc_f_p_c
Domain Path: /languages
License: GPL3
Requires PHP: 5.6
WC requires at least: 3.0.0
WC tested up to: 3.5.1
*/
if (!defined('ABSPATH')) exit; // No direct access allowed

define('wc_f_p_c_path', __FILE__);

// ~~~~~~ START ADMIN MENU ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
include(plugin_dir_path(wc_f_p_c_path) . '/inc/core/load.php');
// ~~~~~~ END ADMIN MENU ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~



