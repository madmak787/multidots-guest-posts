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
			add_shortcode( 'guest_posts', array( $this, 'guest_posts' ), 10, 0 );
		}

		/**
		 * Register styles and scripts
		 */
		public function shortcode_register_scripts() {
			wp_register_style( 'mdg-style', plugins_url( '../assets/css/style.css', __FILE__ ), array(), time(), 'all' );
			wp_enqueue_script( 'jquery' );
			wp_register_script( 'mdg-script', plugins_url( '../assets/js/script.js', __FILE__ ), array(), time(), 'all' );
			wp_add_inline_script( 'mdg-script', "var ajaxurl='" . admin_url( 'admin-ajax.php' ) . "';" );
		}

		/**
		 * Shortcode to show guest post form
		 */
		public function guest_post_submit() {
			wp_enqueue_style( 'mdg-style' );
			wp_enqueue_script( 'mdg-script' );

			if ( is_user_logged_in() ) {
				if ( current_user_can( 'administrator' ) || current_user_can( 'author' ) ) {
					ob_start();
					include MDG_PLUGIN_PATH . 'templates/frontend/form.php';
					$html = ob_get_contents();
					ob_end_clean();
				} else {
					$html = '<p>Please login as author or administrator.</p>';
				}
			} else {
				$html = '<p>Please <a href="' . wp_login_url( get_permalink() ) . '">login</a> to submit the post.</p>';
			}

			return $html;
		}

		/**
		 * Shortcode to show guest posts list
		 */
		public function guest_posts() {
			wp_enqueue_style( 'mdg-style' );
			wp_enqueue_script( 'mdg-script' );

			if ( is_user_logged_in() ) {
				if ( current_user_can( 'administrator' ) || current_user_can( 'author' ) ) {
					$guest_posts = array();
					$args        = array(
						'post_type'      => 'guest_post',
						'post_status'    => 'draft',
						'posts_per_page' => 10,
						'paged'          => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1,
					);

					$the_query = new WP_Query( $args );
					if ( $the_query->have_posts() ) :
						while ( $the_query->have_posts() ) :
							$the_query->the_post();
							global $post;
							$guest_posts[ get_the_ID() ] = $post;
						endwhile;
					endif;

					ob_start();
					include MDG_PLUGIN_PATH . 'templates/frontend/list.php';
					$html = ob_get_contents();
					ob_end_clean();

					wp_reset_postdata();
				} else {
					$html = '<p>Please login as author or administrator.</p>';
				}
			} else {
				$html = '<p>Please <a href="' . wp_login_url( get_permalink() ) . '">login</a> to submit the post.</p>';
			}
			return $html;
		}

	}

	new MDG_Shortcodes();
}
