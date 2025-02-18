<?php
/**
 * Bergauf WooCommerce Class
 *
 * Dies ist eine Kopie des Templates class-storefront-woocommerce.php vom Storefront Theme, angepasst an das Bergauf Theme
 * 
 * @package  Bergauf
 * @since    1.0.0
 * @template Storefront
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Bergauf_WooCommerce' ) ) :

	/**
	 * The Bergauf WooCommerce Integration class
	 */
	class Bergauf_WooCommerce {

		/**
		 * Setup class.
		 *
		 * @since 1.0
		 */
		public function __construct() {
			add_action( 'after_setup_theme', array( $this, 'setup' ) );
			add_filter( 'body_class', array( $this, 'woocommerce_body_class' ) );
			add_filter( 'woocommerce_breadcrumb_defaults', array( $this, 'change_breadcrumb_delimiter' ) );
			add_filter( 'woocommerce_loop_add_to_cart_link', array($this, 'custom_loop_add_to_cart_quantity'), 10, 2 );
		}

		/**
		 * Sets up theme defaults and registers support for various WooCommerce features.
		 *
		 * Note that this function is hooked into the after_setup_theme hook, which
		 * runs before the init hook. The init hook is too late for some features, such
		 * as indicating support for post thumbnails.
		 *
		 * @since 2.4.0
		 * @return void
		 */
		public function setup() {
			add_theme_support(
				'woocommerce',
				apply_filters(
					'Bergauf_woocommerce_args',
					array(
						'single_image_width'    => 416,
						'thumbnail_image_width' => 324,
						'product_grid'          => array(
							'default_columns' => 3,
							'default_rows'    => 4,
							'min_columns'     => 1,
							'max_columns'     => 6,
							'min_rows'        => 1,
						),
					)
				)
			);

			add_theme_support( 'wc-product-gallery-zoom' );
			add_theme_support( 'wc-product-gallery-lightbox' );
			add_theme_support( 'wc-product-gallery-slider' );

			/**
			 * Add 'Bergauf_woocommerce_setup' action.
			 *
			 * @since  2.4.0
			 */
			do_action( 'Bergauf_woocommerce_setup' );
		}

		/**
		 * Add WooCommerce specific classes to the body tag
		 *
		 * @param  array $classes css classes applied to the body tag.
		 * @return array $classes modified to include 'woocommerce-active' class
		 */
		public function woocommerce_body_class( $classes ) {
			$classes[] = 'woocommerce-active';

			// Remove `no-wc-breadcrumb` body class.
			$key = array_search( 'no-wc-breadcrumb', $classes, true );

			if ( false !== $key ) {
				unset( $classes[ $key ] );
			}

			return $classes;
		}

		/**
		 * Query WooCommerce Extension Activation.
		 *
		 * @param string $extension Extension class name.
		 * @return boolean
		 */
		public function is_woocommerce_extension_activated( $extension = 'WC_Bookings' ) {
			return class_exists( $extension ) ? true : false;
		}

		/**
		 * Remove the breadcrumb delimiter
		 *
		 * @param  array $defaults The breadcrumb defaults.
		 * @return array           The breadcrumb defaults.
		 * @since 2.2.0
		 */
		public function change_breadcrumb_delimiter( $defaults ) {
			$defaults['delimiter']   = '<span class="breadcrumb-separator"> / </span>';
			$defaults['wrap_before'] = '<div class="Bergauf-breadcrumb"><div class="col-full"><nav class="woocommerce-breadcrumb" aria-label="' . esc_attr__( 'breadcrumbs', 'Bergauf' ) . '">';
			$defaults['wrap_after']  = '</nav></div></div>';
			return $defaults;
		}

		/**
		 * Add quantity to cart
		 *
		 * @since 1.0.0
		 */
		public function custom_loop_add_to_cart_quantity($html, $product) {
			if ($product->is_type('simple')) {
				$quantity_input = woocommerce_quantity_input(array(
					'input_name'  => 'quantity',
					'input_value' => 1,
					'min_value'   => 1,
					'max_value'   => $product->get_stock_quantity() ? $product->get_stock_quantity() : '',
				), $product, false);
		
				$html = '<form class="cart" action="' . esc_url($product->add_to_cart_url()) . '" method="post" enctype="multipart/form-data">';
				$html .= $quantity_input;
				$html .= '<button type="submit" name="add-to-cart" value="' . esc_attr($product->get_id()) . '" class="button add_to_cart_button ajax_add_to_cart">' . esc_html($product->add_to_cart_text()) . '</button>';
				$html .= '</form>';
			}
			return $html;
		}
	}

endif;

return new Bergauf_WooCommerce();
