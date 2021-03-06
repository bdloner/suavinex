<?php
/**
 * Filter Shortcodes
 *
 * Defines all the shortcodes supported by the plugin, and additional functions to support external compose
 *
 * @author  YITH
 * @package YITH WooCommerce Ajax Product Filter
 * @version 4.0
 */

if ( ! defined( 'YITH_WCAN' ) ) {
	exit;
} // Exit if accessed directly

if ( ! class_exists( 'YITH_WCAN_Shortcodes' ) ) {
	/**
	 * Shortcodes classes
	 */
	class YITH_WCAN_Shortcodes {
		/**
		 * A list of available plugin shortcodes
		 *
		 * @var array $_available_shortcodes
		 */
		private static $_available_shortcodes;

		/**
		 * Register shortcode and performs all shortcodes related ops
		 *
		 * @reutrn void
		 */
		public static function init() {
			// init available shortcodes.
			self::$_available_shortcodes = array(
				'yith_wcan_filters',
				'yith_wcan_active_filters_labels',
				'yith_wcan_reset_button',
				'yith_wcan_mobile_modal_opener',
			);

			add_action( 'init', array( __CLASS__, 'init_shortcodes' ) );
			add_action( 'init', array( __CLASS__, 'init_elementor_widgets' ) );
		}

		/**
		 * Register plugin shortcodes
		 *
		 * @return void
		 */
		public static function init_shortcodes() {
			if ( empty( self::$_available_shortcodes ) ) {
				return;
			}

			foreach ( self::$_available_shortcodes as $tag ) {
				$classname = str_replace( 'yith_wcan', 'YITH_WCAN_Shortcode', $tag );
				$classname = str_replace( ' ', '_', ucwords( str_replace( '_', ' ', $classname ) ) );

				if ( class_exists( $classname ) ) {
					add_shortcode( $tag, array( $classname, 'render' ) );

					if ( method_exists( $classname, 'get_gutenberg_config' ) ) {
						yith_plugin_fw_gutenberg_add_blocks( $classname::get_gutenberg_config() );
					}
				}
			}
		}

		/**
		 * Register custom widgets for Elementor
		 *
		 * @return void
		 */
		public static function init_elementor_widgets() {
			// check if elementor is active.
			if ( ! defined( 'ELEMENTOR_VERSION' ) ) {
				return;
			}

			// register widgets.
			add_action( 'elementor/widgets/widgets_registered', array( __CLASS__, 'register_elementor_widgets' ) );
		}

		/**
		 * Register Elementor Widgets
		 *
		 * @return void
		 */
		public static function register_elementor_widgets() {
			if ( empty( self::$_available_shortcodes ) ) {
				return;
			}

			foreach ( self::$_available_shortcodes as $tag ) {
				$classname = str_replace( 'yith_wcan', 'YITH_WCAN_Elementor', $tag );
				$classname = str_replace( ' ', '_', ucwords( str_replace( '_', ' ', $classname ) ) );
				$filename  = 'class.' . strtolower( str_replace( '_', '-', $classname ) );
				$filepath  = YITH_WCAN_INC . 'elementor/' . $filename . '.php';

				if ( ! file_exists( $filepath ) ) {
					continue;
				}

				include_once( $filepath );

				if ( class_exists( $classname ) ) {
					\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $classname() );
				}
			}
		}
	}
}
