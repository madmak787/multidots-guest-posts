<?php
/**
 * Email body
 *
 * @link       https://khanamir.me/
 * @since      1.0.0
 *
 * @package    madmak787
 * @subpackage madmak787/templates/email
 */

require 'header.php';
?>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><?php echo esc_html( $content ); ?></p>
<?php
require 'footer.php';
?>
