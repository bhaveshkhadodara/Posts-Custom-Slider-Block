<?php
/**
 * Plugin Name: Posts Custom Slider Block
 * Description: This plugin provides custom slider for posts.
 * Version:     1.0.0
 * Author:      Bhavesh khadodara
 * Author URI:  https://profiles.wordpress.org/bhaveshkhadodara/
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: post-custom-slider
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

require_once( plugin_dir_path( __FILE__ ) . 'class-postcs-gutenberg-blocks.php' );

$PostCustomSlider = new PostCustomSlider();
$PostCustomSlider->postcs_init_hook();
