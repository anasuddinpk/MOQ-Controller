<?php
/**
 * Main Loader
 *
 * @package moq-controller-plugin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MOQC_Loader' ) ) {
	/**
	 * Class MOQC_Loader
	 */
	class MOQC_Loader {

		/**
		 *  Constructor.
		 */
		public function __construct() {
			add_action( 'admin_enqueue_scripts', array( $this, 'moqc_enqueue_scripts' ) );
			$this->includes();
		}

		/**
		 * Includes files depend on platform
		 */
		public function includes() {
			include 'class-moqc-add-moq-tab.php';
			include 'class-moqc-add-moq-fields.php';
			include 'class-moqc-min-max-step.php';
			include 'class-moqc-shop-min-max-step.php';
			include 'class-moqc-cart-update.php';
		}

		/**
		 * Enqueue Files.
		 */
		public function moqc_enqueue_scripts() {
			wp_enqueue_script( 'moq-tab-script', plugin_dir_url( __DIR__ ) . 'assets/js/moq-tab-script.js', array( 'jquery' ), wp_rand() );
		}
	}
}

new MOQC_Loader();
