<?php
/**
 * Adding MOQ Tab Setting Fields.
 *
 * @package moq-controller-plugin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Add_MOQ_Tab_Fields' ) ) {

	/**
	 * Class Add_MOQ_Tab_Fields.
	 */
	class Add_MOQ_Tab_Fields {

		/**
		 *  Constructor.
		 */
		public function __construct() 
        {
			add_action( 'woocommerce_settings_moq_settings', array( $this, 'adds_moqc_settings' ), 60);
            add_action( 'woocommerce_update_options_moq_settings', array( $this, 'update_settings' ));
        }

        /**
         * Adding Settings fields on MOQ tab.
         */
        public function adds_moqc_settings() 
		{
			woocommerce_admin_fields( $this->get_settings_array() );
		}
		
        /**
         * Getting MOQ Setting Array as return.
         * @return array
         */
		public function get_settings_array() 
		{
			$settings = array(
				'section_title' => array(
                    'name'     => __( 'Minimum/Maximum Order Quantity', 'moq-controller' ),
                    'type'     => 'title',
                    'desc'     => 'Set products & categories to be ordered according to minimum or maximum quantity.<br> And also set the step multiples.',
                    'id'       => 'moq-settings-title'
                ),
                'enable_fields' => array(
                    'name' => __( 'Enable', 'moq-controller' ),
                    'type' => 'checkbox',
                    'desc' => 'Check to set min/max quantity on selected products',
                    'id'   => 'enable_fields'
                ),
                'select_products' => array(
                    'name' => __( 'Select Products', 'moq-controller' ),
                    'type' => 'multiselect',
                    'options' => $this->get_products_array(),
                    'desc_tip' => true,
                    'desc'  => "Select products to apply limits on that",
                    'id'   => 'select_products'
                ),
                'select_categories' => array(
                    'name' => __( 'Select Categories', 'moq-controller' ),
                    'type' => 'multiselect',
                    'options' => $this->get_categories_array(),
                    'desc_tip' => true,
                    'desc'  => "Select categories to apply limits on that",
                    'id'   => 'select_categories'
                ),
                'minimum_qty' => array(
                    'name' => __( 'Min Order Quantity', 'moq-controller' ),
                    'type' => 'number',
                    'placeholder' => "Greater than 1",
                    'desc_tip' => true,
                    'desc' => 'Minimum quantity of products that can be ordered',
                    'id'   => 'minimum_qty',
                ),
                'maximum_qty' => array(
                    'name' => __( 'Max Order Quantity', 'moq-controller' ),
                    'type' => 'number',
                    'placeholder' => "Greater than Min Qty",
                    'desc_tip' => true,
                    'desc' => 'Maximum quantity of products that can be ordered',
                    'id'   => 'maximum_qty'
                ),
                'enable_step' => array(
                    'name' => __( 'Enable Step', 'moq-controller' ),
                    'type' => 'checkbox',
                    'desc' => 'Check to set increment/decrement step multiple',
                    'id'   => 'enable_step'
                ),
                'step_multiple' => array(
                    'name' => __( 'Step Multiples', 'moq-controller' ),
                    'type' => 'number',
                    'desc_tip' => true,
                    'desc' => 'Steps by selected products can be increases or decreases',
                    'id'   => 'step_multiple'
                ),
                'section_end' => array(
                     'type' => 'sectionend',
                     'id'   => 'wc_moq_settings_end'
                )
            );
			return apply_filters( 'wc_settings_tab_demo_settings', $settings );
		}

        /**
         * Getting all woocommerce products.
         * @return array 
         */
        public function get_products_array()
        {
            $wp_products = wc_get_products( array( 'status' => 'publish', 'limit' => -1 ) );
            
            $products = array();

            if( !empty($wp_products) )
            {
                foreach ( $wp_products as $wp_product )
                { 
                    $products[$wp_product->get_id()] = $wp_product->get_title();
                }    
            }
            return $products;
        }

        /**
         * Getting all woocommerce categories.
         * @return array 
         */
        public function get_categories_array()
        {
            $wp_categories = get_categories( array( 
                'taxonomy' => 'product_cat',
                'limit' => -1
            ));
            $categories = array();

            if( !empty($wp_categories) )
            {
                foreach ( $wp_categories as $wp_category )
                { 
                    $categories[$wp_category->term_id] = $wp_category->name;
                }  
            }
            return $categories;
        }

        /**
         * Save/Update MOQ tab settings.
         */
        public function update_settings() 
        {
            woocommerce_update_options( $this->get_settings_array() );
        }

    }
}

$obj_1 = new Add_MOQ_Tab_Fields();