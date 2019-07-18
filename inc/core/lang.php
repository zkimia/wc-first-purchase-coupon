<?php
/**
 * Created by PhpStorm.
 * User: Amir Hossein
 * Date: 5/8/2019
 * Time: 1:37 PM
 */
if (!defined('ABSPATH')) exit; // No direct access allowed

add_action('plugins_loaded', 'wc_f_p_c_textdomain');

function wc_f_p_c_textdomain()
{
    load_plugin_textdomain('wc_f_p_c', false, dirname(plugin_basename(wc_f_p_c_path)) . '/languages');
}