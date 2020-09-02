<?php
/**
 * Directory filter.
 *
 * @author    Eoxia <dev@eoxia.com>
 * @copyright (c) 2006-2018 Eoxia <dev@eoxia.com>
 * @license
 * @package   WPDirectory\Directory\Filter
 * @since     1.0.0
 */

namespace wp_directory;

defined( 'ABSPATH' ) || exit;

/**
 * Diaporama filters
 */
class Directory_Filter {
	/**
	 * Constructor
	 */
	public function __construct() {
		add_filter( 'acf/settings/load_json', array( $this, 'load_diaporama_json' ) );
	}

	/**
	 * Add a json acf directory
	 *
	 * @method load_diaporama_json
	 * @param  Array $paths Acf folders.
	 * @return Array $paths Acf folders
	 */
	function load_diaporama_json( $paths ) {
		$paths[] = WP_DIRECTORY_PATH . 'modules/directory/assets/json';
		return $paths;
	}

}
new Directory_Filter();
