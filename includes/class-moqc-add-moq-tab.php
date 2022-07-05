<?php
/**
 * Adding MOQ Tab in Woocommerce Settings
 *
 * @package moq-controller-plugin
 */

if ( ! defined( 'ABSPATH' ) ) 
{
	exit;
}

if ( ! class_exists( 'Add_MOQ_Tab' ) ) 
{
	/**
	 * Class Add_MOQ_Tab
	 */
	class Add_MOQ_Tab 
    {
		/**
		 *  Constructor.
		 */
		public function __construct() 
        {
            add_filter( 'woocommerce_settings_tabs_array', array( $this, 'adds_moqc_tab' ), 50);
        }

        /**
         * Adds MOQ tab in Woocommerce settings
         * @param array
         * @return array
         */
        public function adds_moqc_tab($settings_tabs)
        {
            $settings_tabs['moq_settings'] = __( 'MOQ', 'moq-controller' );
            return $settings_tabs;
        }
    }      
}

new Add_MOQ_Tab;