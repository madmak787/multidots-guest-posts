<?php
/**
 * The admin ajax processing.
 *
 * @link       https://khanamir.me/
 * @since      1.0.0
 *
 * @package    madmak787
 * @subpackage madmak787/classes
 */

if ( ! class_exists( 'MDG_Ajax' ) && defined( 'ABSPATH' ) ) {

	/**
	 * MDG_Ajax loader class.
	 */
	class MDG_Ajax {

		/**
		 * MDG_Ajax constructor.
		 */
		public function __construct() {
			self::set_filters();
		}

		/**
		 * Set filters
		 */
		public function set_filters() {
			add_action( 'wp_ajax_submit_guest_post', array( $this, 'submit_guest_post' ) );
			add_action( 'wp_ajax_nopriv_submit_guest_post', array( $this, 'please_login' ) );

			add_action( 'wp_ajax_approve_guest_post', array( $this, 'approve_guest_post' ) );
		}

		/**
		 * Ajax to handle guest post submit
		 */
		public function submit_guest_post() {

			$return = array(
				'success' => false,
				'message' => 'An error occurred.',
			);
			// Nonce check for an extra layer of security, the function will exit if it fails.
			if ( ! wp_verify_nonce( wp_unslash( $_POST['nonce'] ), 'guest_post' ) ) { // phpcs:ignore
				$return['message'] = 'Nonce not verified.';
				echo wp_json_encode( $return );
				exit;
			}

			require_once ABSPATH . 'wp-admin/includes/admin.php';

			$file_return = wp_handle_upload( $_FILES['main_image'], array( 'test_form' => false ) ); // phpcs:ignore

			if( !isset( $file_return['error'] ) ) { // phpcs:ignore

				// Insert post.
				$guest_post = array(
					'post_title'   => isset( $_POST['title'] ) ? sanitize_text_field( wp_unslash( $_POST['title'] ) ) : '',
					'post_content' => isset( $_POST['description'] ) ? sanitize_text_field( wp_unslash( $_POST['description'] ) ) : '',
					'post_excerpt' => isset( $_POST['excerpt'] ) ? sanitize_text_field( wp_unslash( $_POST['excerpt'] ) ) : '',
					'post_type'    => isset( $_POST['type'] ) ? sanitize_text_field( wp_unslash( $_POST['type'] ) ) : '',
					'post_status'  => 'draft',
				);
				$post_id    = wp_insert_post( $guest_post, $wp_error );

				// Insert image and attach to post.
				$filename   = $file_return['file'];
				$attachment = array(
					'post_mime_type' => $file_return['type'],
					'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
					'post_content'   => '',
					'post_status'    => 'inherit',
					'guid'           => $file_return['url'],
				);

				$attachment_id = wp_insert_attachment( $attachment, $file_return['url'], $post_id );
				require_once ABSPATH . 'wp-admin/includes/image.php';
				$attachment_data = wp_generate_attachment_metadata( $attachment_id, $filename );
				wp_update_attachment_metadata( $attachment_id, $attachment_data );
				set_post_thumbnail( $post_id, $attachment_id );

				// Sendmail to admin.
				$message  = 'Hi <br>We got a new guest post submission.<br>';
				$message .= 'To review, please click here:<br>';
				$message .= '<a href="' . admin_url( 'edit.php?post_type=guest_post' ) . '">' . admin_url( 'edit.php?post_type=guest_post' ) . '</a>';
				$subject  = 'New Post Approval Required | Guest Post';
				$to       = get_option( 'admin_email' );
				MDG_Email::sendmail( $to, $subject, $content );

				$return['success'] = true;
				$return['message'] = 'Post insterted with ID #' . $post_id;
			}
			echo wp_json_encode( $return );
			exit;

		}

		/**
		 * If user is not logged in
		 */
		public function please_login() {
			$return = array(
				'success' => false,
				'message' => 'You must log in to like',
			);
			echo wp_json_encode( $return );
			exit;
		}

		/**
		 * Approve guest post
		 */
		public function approve_guest_post() {
			$return = array(
				'success' => false,
				'message' => 'An error occurred.',
			);
			// Nonce check for an extra layer of security, the function will exit if it fails.
			if ( ! wp_verify_nonce( wp_unslash( $_POST['nonce'] ), 'approve_guest_post' ) ) { // phpcs:ignore
				$return['message'] = 'Nonce not verified.';
				echo wp_json_encode( $return );
				exit;
			}
			$post_id = isset( $_POST['post_id'] ) ? sanitize_text_field( wp_unslash( $_POST['post_id'] ) ) : '';
			wp_publish_post( $post_id );
			$return = array(
				'success' => true,
				'message' => 'Post published.',
			);
			echo wp_json_encode( $return );
			exit;
		}

	}

	new MDG_Ajax();
}
