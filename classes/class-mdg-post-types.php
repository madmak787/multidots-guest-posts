<?php
/**
 * To register custom post type.
 *
 * @link       https://khanamir.me/
 * @since      1.0.0
 *
 * @package    madmak787
 * @subpackage madmak787/classes
 */

if ( ! class_exists( 'MDG_Post_Types' ) && defined( 'ABSPATH' ) ) {

	/**
	 * MDG_Post_Types loader class.
	 */
	class MDG_Post_Types {

		/**
		 * MDG_Post_Types constructor.
		 */
		public function __construct() {
			self::set_filters();
		}

		/**
		 * Set filters
		 */
		public function set_filters() {
			add_action( 'init', array( $this, 'register_custom_post_types' ) );
		}

		/**
		 * Register post types here
		 */
		public function register_custom_post_types() {

			register_post_type(
				'guest_post',
				array(
					'labels'     => array( 'name' => 'Guest Posts' ),
					'public'     => true,
					'menu_icon'  => 'dashicons-welcome-write-blog',
					'supports'   => array( 'title', 'editor', 'thumbnail', 'comments' ),
					'taxonomies' => array( 'category' ),
				)
			);
		}

	}

	new MDG_Post_Types();
}
