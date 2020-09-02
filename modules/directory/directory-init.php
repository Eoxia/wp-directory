<?php
/**
 * Init of Directory module
 *
 * @author    Eoxia <dev@eoxia.com>
 * @copyright (c) 2006-2018 Eoxia <dev@eoxia.com>
 * @license
 * @package   WPDirectory\Directory\
 * @since     1.0.0
 */

namespace wp_directory;

defined( 'ABSPATH' ) || exit;

/**
 * Init of the ACF Font Awesome Module
 */
class Directory_Init {
	/**
	 * Directory_Init constructor.
	 */
	public function __construct() {
		require_once WP_DIRECTORY_PATH . 'modules/directory/action/directory-action.php';
		require_once WP_DIRECTORY_PATH . 'modules/directory/filter/directory-filter.php';
		require_once WP_DIRECTORY_PATH . 'modules/directory/class/directory-class.php';
	}
}
new Directory_Init();
