<?php
/**
 * Mains actions of module
 *
 * @author    Eoxia <dev@eoxia.com>
 * @copyright (c) 2006-2019 Eoxia <dev@eoxia.com>
 * @license
 * @package   WPDirectory\Actions
 * @since     1.0.0
 */

namespace wp_directory;

defined( 'ABSPATH' ) || exit;

/**
 * Initialise les scripts JS et CSS du Plugin
 * Ainsi que le fichier MO
 */
class Core_Action {

	/**
	 * Le constructeur ajoutes les actions WordPress suivantes:
	 * admin_enqueue_scripts (Pour appeller les scripts JS et CSS dans l'admin)
	 * admin_print_scripts (Pour appeler les scripts JS en bas du footer)
	 * plugins_loaded (Pour appeler le domaine de traduction)
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'callback_language' ), 11 );
		add_action( 'tgmpa_register', array( \wp_directory\Core_Util::get_instance(), 'wp_directory_register_required_plugins' ), 11 );
		add_action( 'admin_enqueue_scripts', array( $this, 'callback_admin_scripts' ), 11 );
		add_action( 'wp_enqueue_scripts', array( $this, 'callback_front_scripts' ), 11 );
	}

	/**
	 * Charge le dossier de traduction du plugin
	 */
	public function callback_language() {
		$i18n_loaded = load_plugin_textdomain( 'wp-directory', false, WP_DIRECTORY_DIR . '/core/assets/language/' );
	}

	/**
	 * Initialise les script .js et style .css du coeur dans l'administration
	 */
	public function callback_admin_scripts() {
//		wp_enqueue_style( 'beflex-pro-core-style', BEFLEX_PRO_URL . 'core/assets/css/style.min.css', array(), '1.0.0' );

//		wp_enqueue_script( 'beflex-pro-core-script', BEFLEX_PRO_URL . 'core/assets/js/core.js', array(), '', true );
	}
	/**
	 * Initialise les script .js et style .css du coeur dans le front
	 */
	public function callback_front_scripts() {
//		wp_enqueue_style( 'beflex-pro-core-style', BEFLEX_PRO_URL . 'core/assets/css/style.min.css', array(), '1.0.0' );

//		wp_enqueue_script( 'beflex-pro-core-script', BEFLEX_PRO_URL . 'core/assets/js/core.js', array( 'jquery' ), '', true );
	}
}
new Core_Action();
