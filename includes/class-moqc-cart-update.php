<?php
/**
 * Updating prices on Cart Page.
 *
 * @package moq-controller-plugin
 */

if ( ! defined( 'ABSPATH' ) ) 
{
	exit;
}

if ( ! class_exists( 'Update_Cart' ) ) 
{
	/**
	 * Class Update_Cart
	 */
	class Update_Cart 
    {
		/**
		 *  Constructor.
		 */
		public function __construct() 
        {
           add_filter( 'woocommerce_cart_item_quantity', array( $this, 'handles_cart_quantities' ), 10, 3 );
        }  
        
        /**
		 *  Sets Min/Max Quantities & Step Multiples on Cart page.
         * @param array
         * @param string
         * @param array
         * @return array
		 */
        public function handles_cart_quantities( $product_quantity, $cart_item_key, $cart_item ) {  
            
            $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

            if( !empty(get_option('select_products')) || !empty(get_option('select_categories')) )
            {
                foreach(get_option('select_products') as $key => $prod_ids)
                {
                    if( $_product->get_id() == $prod_ids )
                    {
                        $product_quantity = woocommerce_quantity_input( array(
                            'input_name'   => "cart[{$cart_item_key}][qty]",
                            'input_value'  => $cart_item['quantity'],
                            'max_value'    => get_option('maximum_qty'),
                            'min_value'    => get_option('minimum_qty'),
                            'step'         => get_option('step_multiple'),
                            'product_name' => $_product->get_name(),
                            ), $_product, false );
                    }
                }
                
                foreach(get_option('select_categories') as $key => $selected_cat_ids)
                {
                    foreach ($_product->category_ids as $key => $total_cat_ids) 
                    {
                        if( $selected_cat_ids == $total_cat_ids )
                        {
                            $product_quantity = woocommerce_quantity_input( array(
                                'input_name'   => "cart[{$cart_item_key}][qty]",
                                'input_value'  => $cart_item['quantity'],
                                'max_value'    => get_option('maximum_qty'),
                                'min_value'    => get_option('minimum_qty'),
                                'step'         => get_option('step_multiple'),
                                'product_name' => $_product->get_name(),
                                ), $_product, false );
                        }
                    }
                }
            }
            else
            {
                foreach ($_product->category_ids as $key => $total_cat_ids) 
                {
                    $product_quantity = woocommerce_quantity_input( array(
                        'input_name'   => "cart[{$cart_item_key}][qty]",
                        'input_value'  => $cart_item['quantity'],
                        'max_value'    => get_option('maximum_qty'),
                        'min_value'    => get_option('minimum_qty'),
                        'step'         => get_option('step_multiple'),
                        'product_name' => $_product->get_name(),
                        ), $_product, false );
                }
            }

           return $product_quantity;
        }
    }
}

new Update_Cart;