<?php
/**
 * Direcoty actions
 *
 * @author    Eoxia <dev@eoxia.com>
 * @copyright (c) 2006-2019 Eoxia <dev@eoxia.com>
 * @license
 * @package   WPDirectory\Modules\Actions
 * @since     1.0.0
 */

namespace wp_directory;

defined( 'ABSPATH' ) || exit;

/**
 * Initialise les scripts JS et CSS du Plugin
 * Ainsi que le fichier MO
 */
class Directory_Action {

	/**
	 * Le constructeur ajoutes les actions WordPress suivantes:
	 * admin_enqueue_scripts (Pour appeller les scripts JS et CSS dans l'admin)
	 * admin_print_scripts (Pour appeler les scripts JS en bas du footer)
	 * plugins_loaded (Pour appeler le domaine de traduction)
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_directory_post_type' ), 0 );
		add_action( 'init', array( $this, 'register_directory_taxonomy' ), 0 );
		add_action( 'acf/init', array( $this, 'init_directory_block' ) );
	}

	/**
	 * Register Direcoty Post Type.
	 */
	public function register_directory_post_type() {
		$labels = array(
			'name'          => _x( 'Directories', 'Post Type General Name', 'wp-directory' ),
			'singular_name' => _x( 'Directory', 'Post Type Singular Name', 'wp-directory' ),
		);

		$args = array(
			'label'               => __( 'Directory', 'wp-directory' ),
			'description'         => __( 'Post Type Description', 'wp-directory' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'thumbnail' ),
			'taxonomies'          => array( 'directory_taxonomy' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 20,
			'menu_icon'           => 'dashicons-index-card',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => false,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => false,
			'publicly_queryable'  => false,
			'rewrite'             => false,
			'capability_type'     => 'post',
		);
		register_post_type( 'wp_directory', $args );

	}

	/**
	 * Register Directory taxonomy.
	 */
	public function register_directory_taxonomy() {

		$labels = array(
			'name'          => _x( 'Categories', 'Taxonomy General Name', 'wp-directory' ),
			'singular_name' => _x( 'Category', 'Taxonomy Singular Name', 'wp-directory' ),
		);

		$rewrite = array(
			'slug'         => 'directory-category',
			'with_front'   => true,
			'hierarchical' => false,
		);

		$args = array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
			'rewrite'           => $rewrite,
		);
		register_taxonomy( 'directory_taxonomy', array( 'wp_directory' ), $args );

	}

	/**
	 * Init Diaporama block for Gutenberg
	 *
	 * @return void
	 */
	public function init_directory_block() {
		if ( function_exists( 'acf_register_block' ) ) {
			acf_register_block(
				array(
					'name'            => 'wp_directory',
					'title'           => esc_html__( 'Directory', 'wp-directory' ),
					'description'     => esc_html__( 'Display your directories', 'wp-directory' ),
					'mode'            => 'auto',
					'category'        => 'formatting',
					'icon'            => 'index-card',
					'keywords'        => array( 'directory', 'directories', 'eoxia' ),
					'render_callback' => array( $this, 'directory_action_render_callback' ),
					'enqueue_assets'  => function() {
						wp_enqueue_style( 'block-wp-directory-style', WP_DIRECTORY_URL . '/modules/directory/assets/css/style.min.css', array(), '1.0.0' );

						wp_enqueue_script( 'block-wp-directory-masonry', WP_DIRECTORY_URL . 'modules/directory/assets/js/masonry.pkgd.min.js', array( 'jquery' ), '1.0.0', true );
						wp_enqueue_script( 'block-wp-directory-script', WP_DIRECTORY_URL . 'modules/directory/assets/js/script.js', array( 'jquery' ), '1.0.0', true );
					},
				)
			);
		}
	}

	/**
	 * Diaporama Block Callback Function.
	 *
	 * @param   array  $block The block settings and attributes.
	 * @param   string $content The block inner HTML (empty).
	 * @param   bool   $is_preview True during AJAX preview.
	 * @param   int    $post_id The post ID this block is saved to.
	 */
	function directory_action_render_callback( $block, $content = '', $is_preview = false, $post_id = 0 ) {
		$view_path = Core_Util::get_instance()->get_module_view_path( 'directory', 'main.view' );
		include $view_path;
	}

}
new Directory_Action();
