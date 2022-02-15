<?php
/**
 * To register of gutenberg block.
 *
 * @link       https://khanamir.me/
 * @since      1.0.0
 *
 * @package    madmak787
 * @subpackage madmak787/classes
 */

if ( ! class_exists( 'MDG_Gutenberg' ) && defined( 'ABSPATH' ) ) {

	/**
	 * MDG_Gutenberg loader class.
	 */
	class MDG_Gutenberg {

		/**
		 * MDG_Gutenberg constructor.
		 */
		public function __construct() {
			self::set_filters();
		}

		/**
		 * Set filters
		 */
		public function set_filters() {
			add_action( 'init', array( $this, 'guest_post_block' ) );
		}

		/**
		 * Add gutenberg block to admin
		 */
		public function guest_post_block() {
			wp_enqueue_script( 'mdg-gutenberg-blocks', plugins_url( '../build/index.js', __FILE__ ), array( 'wp-blocks' ), time(), 'all' );
			register_block_type(
				'madmak/guestpost-form',
				array(
					'editor_script' => 'mdg-gutenberg-blocks',
				)
			);
			register_block_type(
				'madmak/guestpost',
				array(
					'editor_script' => 'mdg-gutenberg-blocks',
				)
			);
		}

	}

	new MDG_Gutenberg();
}
