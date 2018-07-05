<?php

/*
Plugin Name: VXM Forms
Plugin URI: http://viendoporelmundo.com
Description: Information input forms plugin for www.viendoporelmundo.com
Version: 1.0.0
Author: Gerardo Mijares
Author URI: http://lapsusdev.com
*/

add_action('wp_enqueue_scripts', 'vxm_forms_enqueue_scripts');
function vxm_forms_enqueue_scripts() {   
    wp_register_script( 'vxm-forms-main', plugin_dir_url( __FILE__ ) . 'js/vxm-forms-main.js', array( 'jquery' ), '5.1.1', true );
    wp_enqueue_script( 'vxm-forms-main' );
}



include_once( plugin_dir_path(__FILE__).'includes/vxm-forms-functions.php' );

?>