<?php

/**
 * @author SmoothThemes - http://www.SmoothThemes.com
 * @copyright 2013
 */


// Remove if debug
// error_reporting(0);
/**
 * Call stFramework
 */
require_once('st-framework/st-framework.php');
require_once('includes/theme-init.php');

/**
 * Write any functions here if you are using child-theme.( You should use child-theme for future update )
 */
add_filter( 'auto_update_plugin', '__return_true' );
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_template_single_add_to_cart');

if ( !current_user_can( 'edit_users' ) ) {
  add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
  add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );
}