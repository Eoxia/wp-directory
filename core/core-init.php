<?php
/**
 * Core Init.
 *
 * @author    Eoxia <dev@eoxia.com>
 * @copyright (c) 2006-2018 Eoxia <dev@eoxia.com>
 * @license
 * @package   WPDirectory\
 * @since     1.0.0
 */

namespace wp_directory;

defined( 'ABSPATH' ) || exit;

/**
 * Init of the Core
 */
class Core_Init {
	/**
	 * Core_Init constructor.
	 */
	public function __construct() {
		require_once WP_DIRECTORY_PATH . 'core/class/tgm-plugin-activation.php';
		require_once WP_DIRECTORY_PATH . 'core/helper/core-helper.php';
		require_once WP_DIRECTORY_PATH . 'core/util/core-util.php';
		require_once WP_DIRECTORY_PATH . 'core/class/core-class.php';
		require_once WP_DIRECTORY_PATH . 'core/action/core-action.php';
	}
}
new Core_Init();
