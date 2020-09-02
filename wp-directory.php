<?php
/**
 * Plugin Name: WP Directory
 * Plugin URI:
 * Description: Display simple and design directory on the frontend.
 * Version: 1.0.0
 * Author: Eoxia <dev@eoxia.com>
 * Author URI: http://www.eoxia.com/
 * License: AGPLv3
 * License URI: https://spdx.org/licenses/AGPL-3.0-or-later.html
 * Text Domain: wp-directory
 * Domain Path: /language
 *
 * @package WP Directory
 */

namespace wp_directory;

defined( 'ABSPATH' ) || exit;

DEFINE( 'WP_DIRECTORY_PATH', realpath( plugin_dir_path( __FILE__ ) ) . '/' );
DEFINE( 'WP_DIRECTORY_URL', plugins_url( basename( __DIR__ ) ) . '/' );
DEFINE( 'WP_DIRECTORY_DIR', basename( __DIR__ ) );

require_once WP_DIRECTORY_PATH . 'wp-directory-init.php';
