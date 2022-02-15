<?php
/**
 * Form to submit guest post
 *
 * @link       https://khanamir.me/
 * @since      1.0.0
 *
 * @package    madmak787
 * @subpackage madmak787/templates/frontend
 */

$args = array(
	'public'   => true,
	'_builtin' => false,
);

$output   = 'objects';
$operator = 'and';

$post_types = get_post_types( $args, $output, $operator );

?>
<div id="guestpost" class="guest-post-wrapper">
	<form id="guestpost-form" action="<?php echo esc_url( admin_url( 'posts.php' ) ); ?>" method="post" class="guest-post-form" enctype="multipart/form-data">
		<p class="guest-post-title">
			<label for="title">Title</label>
			<input name="title" type="text" required="required" />
		</p>
		<p class="guest-post-type">
			<label for="type">Post Type</label>
			<select name="type" required="required">
				<option value="">Select--</option>
				<?php
				foreach ( $post_types  as $ptype ) {
					echo '<option value="' . esc_attr( $ptype->name ) . '">' . esc_html( $ptype->label ) . '</option>';
				}
				?>
			</select>
		</p>
		<p class="guest-post-description">
			<label for="description">Description</label>
			<textarea name="description"></textarea>
		</p>
		<p class="guest-post-excerpt">
			<label for="excerpt">Excerpt</label>
			<textarea name="excerpt"></textarea>
		</p>
		<p class="guest-post-image">
			<label for="image">Featured Image</label>
			<input type="file" name="main_image" id="main_image"  multiple="false" value="" accept=".png, .jpg, .jpeg, .gif"/>
		</p>
		<p class="form-submit">
			<input name="action" type="hidden" value="submit_guest_post">
			<input name="nonce" type="hidden" value="<?php echo esc_attr( wp_create_nonce( 'guest_post' ) ); ?>">
			<button name="submit" type="submit" class="wp-block-button__link">Submit For Approval <img src="<?php echo esc_attr( MDG_PLUGIN_URL . 'assets/img/loader.gif' ); ?>" /></button>
		</p>
	</form>
</div>
