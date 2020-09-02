<?php
/**
 * Init of core and modules
 *
 * @author    Eoxia <dev@eoxia.com>
 * @copyright (c) 2006-2019 Eoxia <dev@eoxia.com>
 * @license
 * @package   WPDirectory\
 * @since     1.0.0
 */

namespace wp_directory;

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Class WP_Directory_Init
 *
 * @package wp_directory
 */
class WP_Directory_Init {

	/**
	 * WP_Directory_Init constructor.
	 */
	public function __construct() {
		// Core include.
		require_once WP_DIRECTORY_PATH . 'core/core-init.php';

		// Modules include.
		if ( \wp_directory\Core_Helper::get_instance()->is_acf() ) {
			require_once WP_DIRECTORY_PATH . 'modules/directory/directory-init.php';
		}
	}

}
new WP_Directory_Init();
