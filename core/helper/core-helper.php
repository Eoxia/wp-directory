<?php
/**
 * Core Helper
 *
 * @author    Eoxia <dev@eoxia.com>
 * @copyright (c) 2006-2019 Eoxia <dev@eoxia.com>
 * @license
 * @package   WPDirectory\Helper
 * @since     1.0.0
 */

namespace wp_directory;

defined( 'ABSPATH' ) || exit;

class Core_Helper {
	/**
	 * Instance.
	 *
	 * @var Singleton
	 * @access private
	 * @static
	 */
	private static $instance = null;

	/**
	 * Méthode qui crée l'unique instance de la classe
	 * si elle n'existe pas encore puis la retourne.
	 *
	 * @param void
	 * @return Singleton
	 */
	public static function get_instance() {

		if ( is_null( self::$instance ) ) {
			self::$instance = new Core_Helper();
		}

		return self::$instance;
	}

	/**
	 * Le constructeur
	 *
	 * @since 0.1.0-alpha
	 * @version 0.1.0-alpha
	 */
	private function __construct() {}

	/**
	 * Return true if acf exists
	 *
	 * @method is_acf
	 */
	public function is_acf() {
		if ( class_exists( 'acf' ) ) :
			return true;
		endif;
	}
}
