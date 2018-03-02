<?php
/*
Plugin Name: Hook Me Up Api
Plugin URI:  http://ukcoding.com
Description: import/export woocommerce products using rest api
Version:     1.0.0
Author:      Noureddine Latreche
Text Domain: Hook Me Up
Domain Path: /languages
License:     GPL3

*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
define ('SITE_ROOT', realpath(dirname(__FILE__)));
/**
 * first we call the files we are using
 */
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}


require_once dirname( __FILE__ ) . '/oauth-one.php';

use Inc\Base\Activate;
use Inc\Base\Deactivate;
function hook_me_up_activate () {
	Activate::activate();
}
function hook_me_up_deactivate () {
	Deactivate::deactivate();
}
register_activation_hook( __FILE__, 'hook_me_up_activate' );
register_deactivation_hook( __FILE__, 'hook_me_up_deactivate' );


if (class_exists ('Inc\\Init')) {
	//Inc\Init::register_services();
}

use Inc\Pages\Admin;
new Admin();

use Inc\Base\Enqueue;
new Enqueue();


add_action('init', 'addpoost');
function addpoost()
{
	$count = post_exists('Product with attributes only PHP22233');
	if($count != 0 ) {
		$post = array(
			'post_title' => 'Product with attributes only PHP22233',
			'post_content' => '',
			'post_status' => 'publish',
			'post_type' => "product"
		);
		$new_post_id = wp_insert_post($post);
		wp_set_object_terms($new_post_id, 'variable', 'product_type');

		/**
		 * Add product attribute.
		 */
		$attr_names = array(
			'Colour' => array('Red'),
			'Size' => array('Small', 'Large')
		);
		$attr_data = array();
		foreach ($attr_names as $attr_name => $attr_values) {
			$attr_sanitized_name = 'pa_' . sanitize_title($attr_name);
			$attr_data += array(
				$attr_sanitized_name => array(
					'name' => $attr_name,
					'value' => implode('|', $attr_values),
					'is_visible' => 1,
					'is_variation' => 1,
					'is_taxonomy' => 0,
					'position' => 0,
				)
			);
		}
		update_post_meta($new_post_id, '_product_attributes', $attr_data, TRUE);
	}
}
