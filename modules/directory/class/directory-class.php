<?php
/**
 * Class of Call Directory.
 *
 * @author    Eoxia <dev@eoxia.com>
 * @copyright (c) 2006-2018 Eoxia <dev@eoxia.com>
 * @license
 * @package   WPDirectory\Directory\Class
 * @since     1.0.0
 */

namespace wp_directory;

defined( 'ABSPATH' ) || exit;

/**
 * Class Directory_Class.
 *
 * @package wp_directory
 */
class Directory_Class {
	/**
	 * Main block ID, required for query.
	 *
	 * @var $block_id
	 */
	public $block_id;

	/**
	 * List obtained by query.
	 *
	 * @var array $list_directories
	 */
	public $list_directories;

	/**
	 * List of field options
	 *
	 * @var array $options;
	 */
	public $options;

	/**
	 * Constructor of the Class
	 *
	 * @method __construct
	 * @param string $block_id Main Block Id.
	 */
	public function __construct( $block_id ) {
		if ( empty( $block_id ) ) {
			return;
		}

		$this->block_id  = $block_id;
		$directory_query = $this->get_query();
		if ( ! empty( $directory_query ) ) {
			$this->list_directories = $directory_query;
		}
		$options = $this->get_options();
		if ( ! empty( $options ) ) {
			$this->options = $options;
		}
	}

	/**
	 * Get list of directoris with the block ID.
	 *
	 * @return array List of posts.
	 */
	public function get_query() {
		$args = array(
			'post_type'      => 'wp_directory',
			'posts_per_page' => -1,
		);

		$display_mode = get_field( 'directories_display', $this->block_id );
		if ( 'categories' === $display_mode ) {
			$taxonomies_ids    = get_field( 'directories_display_taxonomies', $this->block_id );
			$args['tax_query'] = array(
				array(
					'taxonomy'         => 'directory_taxonomy',
					'field'            => 'term_id',
					'terms'            => $taxonomies_ids,
					'include_children' => false,
				),
			);
		}
		elseif ( 'manual' === $display_mode ) {
			$manual_ids       = get_field( 'directories_display_manual', $this->block_id );
			$args['post__in'] = $manual_ids;
		}

		return get_posts( $args );
	}

	/**
	 * Get list of field options
	 *
	 * @return array List of options.
	 */
	public function get_options() {
		$options = array(
			'display_search' => get_field( 'directories_display_search', $this->block_id ),
		);
		$options = apply_filters( 'wpd_define_options', $options, $this->block_id );
		return $options;
	}
}
