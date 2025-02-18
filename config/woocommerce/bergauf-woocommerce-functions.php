<?php
/**
 * Bergauf WooCommerce functions.
 *
 * @package bergauf
 */

if ( ! function_exists( 'bergauf_is_woocommerce_activated' ) ) {
	/**
	 * Query WooCommerce activation
	 */
	function bergauf_is_woocommerce_activated() { 
		return class_exists( 'WooCommerce' ) ? true : false;
	}
}