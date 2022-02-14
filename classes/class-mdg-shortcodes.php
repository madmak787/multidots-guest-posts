<?php
/**
 * To register of shortcuts.
 *
 * @link       https://khanamir.me/
 * @since      1.0.0
 *
 * @package    madmak787
 * @subpackage madmak787/classes
 */

if ( ! class_exists( 'MDG_Shortcodes' ) && defined( 'ABSPATH' ) ) {

	/**
	 * MDG_Shortcodes loader class.
	 */
	class MDG_Shortcodes {

		/**
		 * MDG_Shortcodes constructor.
		 */
		public function __construct() {
			self::set_filters();
		}

		/**
		 * Set filters
		 */
		public function set_filters() {
			add_action( 'wp_enqueue_scripts', array( $this, 'shortcode_register_scripts' ) );

			add_shortcode( 'guest_post_submit', array( $this, 'guest_post_submit' ), 10, 0 );
		}

		/**
		 * Register styles and scripts
		 */
		public function shortcode_register_scripts() {
			wp_register_style( 'mdg-style', plugins_url( '../assets/css/style.css', __FILE__ ), array(), time(), 'all' );
			wp_register_script( 'mdg-script', plugins_url( '../assets/js/script.js', __FILE__ ), array(), time(), 'all' );
		}

		/**
		 * Shortcode to show guest post form
		 */
		public function guest_post_submit() {
			wp_enqueue_style( 'mdg-style' );
			wp_enqueue_script( 'mdg-script' );

			ob_start();
			include MDG_PLUGIN_PATH . 'templates/frontend/form.php';
			$html = ob_get_contents();
			ob_end_clean();
			return $html;
		}

	}

	new MDG_Shortcodes();
}
