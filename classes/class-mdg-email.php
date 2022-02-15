<?php
/**
 * To add custom mail functionlity.
 *
 * @link       https://khanamir.me/
 * @since      1.0.0
 *
 * @package    madmak787
 * @subpackage madmak787/classes
 */

if ( ! class_exists( 'MDG_Email' ) && defined( 'ABSPATH' ) ) {

	/**
	 * MDG_Email loader class.
	 */
	class MDG_Email {

		/**
		 * MDG_Email constructor.
		 */
		public function __construct() {
			self::set_filters();
		}

		/**
		 * Set filters
		 */
		public function set_filters() {
		}

		/**
		 * Send mail function
		 *
		 * @param String $to Email ID.
		 * @param String $subject Email Subject.
		 * @param String $content Email Content.
		 */
		public function sendmail( $to, $subject, $content ) {
			ob_start();
			include 'email/body.php';
			$message = ob_get_contents();
			ob_end_clean();
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
			// More headers.
			if ( isset( $_SERVER['SERVER_NAME'] ) ) {
				$headers .= 'From: Guest Post <info@' . sanitize_text_field( wp_unslash( $_SERVER['SERVER_NAME'] ) ) . '>' . "\r\n";
			} else {
				$headers .= 'From: Guest Post <info@khanamir.me>' . "\r\n";
			}
			return mail( $to, $subject, $message, $headers );
		}

	}

	new MDG_Email();
}
