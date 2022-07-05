<?php
/**
 * Plugin Name: MOQ Controller Plugin
 * Plugin URI: https://www.linkedin.com/in/anasuddinpk/
 * Description: Made for setting Minimum/Maximum Order Quantity.
 * Version: 1.1.1.0
 * Author: Anas Uddin
 * Author URI: https://www.linkedin.com/in/anasuddinpk/
 * Text Domain: moq-controller
 * 
 * @package moq-controller-plugin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'MOQC_PLUGIN_DIR' ) ) {
	define( 'MOQC_PLUGIN_DIR', __DIR__ );
}

if ( ! defined( 'MOQC_PLUGIN_DIR_URL' ) ) {
	define( 'MOQC_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'MOQC_ABSPATH' ) ) {
	define( 'MOQC_ABSPATH', dirname( __FILE__ ) );
}

include_once MOQC_ABSPATH . '/includes/class-moqc-loader.php';