<?php
/**
 * Lists guest post
 *
 * @link       https://khanamir.me/
 * @since      1.0.0
 *
 * @package    madmak787
 * @subpackage madmak787/templates/frontend
 */

?>

<table class="guest-posts-list">
	<tr>
		<th>ID</th>
		<th>Post Title</th>
		<th>Featured Image</th>
		<th>Action</th>
	</tr>
	<?php
	foreach ( $guest_posts as $gp ) {
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $gp->ID ), 'single-post-thumbnail' );
		?>
		<tr>
			<td><?php echo esc_html( $gp->ID ); ?></td>
			<td><?php echo esc_html( $gp->post_title ); ?></td>
			<td><img src="<?php echo esc_attr( $image[0] ); ?>" /></td>
			<td><a href="#" class="wp-block-button__link approve-guest-post" data-id="<?php echo esc_html( $gp->ID ); ?>" data-nonce="<?php echo esc_attr( wp_create_nonce( 'approve_guest_post' ) ); ?>">Approve <img src="<?php echo esc_attr( MDG_PLUGIN_URL . 'assets/img/loader.gif' ); ?>" /></a></td>
		</tr>
		<?php
	}
	?>
</table>
<div class="pagination">
	<?php
	$big = 999999999;
	echo paginate_links( // phpcs:ignore
		array(
			'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format'  => '?paged=%#%',
			'current' => max( 1, get_query_var( 'paged' ) ),
			'total'   => $the_query->max_num_pages,
		)
	);
	?>
</div>
