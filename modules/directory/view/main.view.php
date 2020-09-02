<?php
/**
 * Main view of Directory Module.
 *
 * @author    Eoxia <dev@eoxia.com>
 * @copyright (c) 2006-2018 Eoxia <dev@eoxia.com>
 * @license
 * @package   WPDirectory\Directory\View
 * @since     1.0.0
 */

namespace wp_directory;

defined( 'ABSPATH' ) || exit;

$list_directories = new Directory_Class( $block['id'] );

if ( ! empty( $list_directories ) ) :

	if ( $list_directories->options['display_search'] ) : ?>
		<div class="wpd-directory-search">
			<div class="wpd-content" contenteditable="true"></div>
			<div class="wpd-placeholder active"><?php esc_html_e( 'Search by directory name or contact infos', 'wp-directory' ); ?></div>
		</div>
	<?php endif; ?>

	<div class="wp-directory">
		<div class="wpd-grid-sizer"></div>
		<?php
		foreach ( $list_directories->list_directories as $directory ) :
			$view_path = Core_Util::get_instance()->get_module_view_path( 'directory', 'default.view' );
			include $view_path;
		endforeach;
		?>
	</div>
	<?php
endif;
