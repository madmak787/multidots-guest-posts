<?php
/**
 * The plugin bootstrap file
 *
 * @link              https://khanamir.me/
 * @since             1.0.0
 * @package           madmak787
 */

/*
 * Plugin Name: Guest Post Submission by MultiDots
 * Plugin URI:  https://#
 * Description: This plugin is about creating an interface in Front-end site of website, so that guest authors can submit posts from front-side.
 * Version:     1.0.0
 * Author:      Khan Amir (madmak787)
 * Author URI:  https://khanamir.me/
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: wpspins
 * Domain Path: /languages
 */

define( 'MDG_VERSION', '1.0.0' );
define( 'MDG_NAME', 'Guest Post Submission' );
define( 'MDG_PLUGIN_NAME', 'mdg-guest-post-submission' );
define( 'MDG_PLUGIN_FILE', plugin_basename( __FILE__ ) );
define( 'MDG_PLUGIN_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'MDG_PLUGIN_URL', trailingslashit( plugins_url( basename( plugin_dir_path( __FILE__ ) ), basename( __FILE__ ) ) ) );

require 'classes/load-classes.php';
