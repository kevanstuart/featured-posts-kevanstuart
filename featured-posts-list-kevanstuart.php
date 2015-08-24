<?php
/**
 * Plugin name: Featured Posts List by selected ID's
 * Description: Display a list of selected posts on the sidebar
 * Author: Kevan Stuart
 * Adapted from: SAN – w3cgallery.com & Windowshostingpoint.com & Syed Balkhi
 * Version: 1.0.0
 * Licence: GPL
 */

require_once('fpk_admin_page.php');
require_once('fpk_display.php');

/**
 * Check is_admin function doesn't exist and throw error
 */
if (!function_exists('is_admin')) 
{
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

/**
 * Functions run on activation and deactivation
 */
register_activation_hook(__FILE__,'featured_posts_list_install'); 
register_deactivation_hook( __FILE__, 'featured_posts_list_remove' );

/**
 * Install plugin function
 */
function featured_posts_list_install() 
{ /* Do Nothing */ }

/**
 * Remove plugin function
 */
function featured_posts_list_remove()
{
    delete_option('featured_posts_list');
}

/**
 * Check if admin is accessing
 */
if(is_admin())
{
    add_action('admin_menu', 'featured_posts_list_admin_menu');
}
else
{
    add_action('init', 'featured_posts_list_init');
    add_shortcode('fpk_list', 'insert_fpk_featured_list');
    add_shortcode('fpk_menu', 'insert_fpk_featured_menu');
}
?>