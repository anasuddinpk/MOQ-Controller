<?php
/**
 * Setting default Add to Cart quantity for Shop page.
 *
 * @package moq-controller-plugin
 */

if ( ! defined( 'ABSPATH' ) ) 
{
	exit;
}

if ( ! class_exists( 'Replace_Shop_Add_to_Cart' ) ) 
{
	/**
	 * Class Replace_Shop_Add_to_Cart.
	 */
	class Replace_Shop_Add_to_Cart 
    {
		/**
		 *  Constructor.
		 */
		public function __construct() 
        {
            add_action( 'woocommerce_after_shop_loop_item', array( $this, 'remove_add_to_cart_buttons'), 1 );
            add_action( 'woocommerce_after_shop_loop_item', array( $this, 'woocommerce_template_loop_add_to_cart'), 1 );
        }

        /**
         * Removes Shop's default Add to Cart button.
         */
        public function remove_add_to_cart_buttons() 
        {
            if( is_product_category() || is_shop() || is_product() ) 
            { 
                remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
                remove_action( 'woocommerce_after_single_product', 'woocommerce_template_loop_add_to_cart');
            }
        }

        /**
         * Create new Shop's Add to Cart button.
         */
        public function woocommerce_template_loop_add_to_cart( $args = array() ) 
        {
            global $product;

            if ( $product ) 
            {
                $prod_quantity = 1;

                if( get_option('enable_fields') == 'yes' && !empty(get_option('select_products')) || !empty(get_option('select_categories')) )
                {
                    $proceed_to_category = true;
                    
                    foreach (get_option('select_products') as $key => $selected_prods) 
                    {
                        if( $selected_prods == $product->id )
                        {
                            $prod_quantity = get_option('minimum_qty');
                            $proceed_to_category = false;
                            break;
                        }
                        else
                        {
                            $prod_quantity = 1;
                            $proceed_to_category = true;
                        }
                    }

                    if( $proceed_to_category )
                    {
                        foreach(get_option('select_categories') as $key => $selected_cat_ids)
                        {
                            foreach ($product->category_ids as $key => $total_cat_ids) 
                            {
                                if( $selected_cat_ids == $total_cat_ids)
                                {
                                    $prod_quantity = get_option('minimum_qty');
                                    break 2;
                                }
                                else
                                {
                                    $prod_quantity = 1;
                                }
                            }
                        }
                    }

                }
                else if( get_option('enable_fields') == 'yes' && empty(get_option('select_products')) && empty(get_option('select_categories')) )
                {
                    $prod_quantity = get_option('minimum_qty');
                }

                $defaults = array(
                    'quantity'   => $prod_quantity,
                    'class'      => implode(
                        ' ',
                        array_filter(
                            array(
                                'button',
                                'product_type_' . $product->get_type(),
                                $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                                $product->supports( 'ajax_add_to_cart' ) && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
                            )
                        )
                    ),
                    'attributes' => array(
                        'data-product_id'  => $product->get_id(),
                        'data-product_sku' => $product->get_sku(),
                        'aria-label'       => $product->add_to_cart_description(),
                        'rel'              => 'nofollow',
                    ),
                );

                $args = apply_filters( 'woocommerce_loop_add_to_cart_args', wp_parse_args( $args, $defaults ), $product );
    
                if ( isset( $args['attributes']['aria-label'] ) ) {
                    $args['attributes']['aria-label'] = wp_strip_all_tags( $args['attributes']['aria-label'] );
                }
    
                wc_get_template( 'loop/add-to-cart.php', $args );
            }
        }
    }
}

new Replace_Shop_Add_to_Cart;