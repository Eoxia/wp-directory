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

if ( empty( $directory ) ) :
	return;
endif;

$directory_summary     = get_field( 'directory_summary', $directory->ID );
$directory_description = get_field( 'directory_description', $directory->ID );
$directory_phone       = get_field( 'directory_phone', $directory->ID );
$directory_phone_link  = get_field( 'directory_phone_link', $directory->ID );
$directory_email       = get_field( 'directory_email', $directory->ID );
$directory_website     = get_field( 'directory_website', $directory->ID );
?>
<div class="wpd-item">
	<div class="wpd-item-padder">
		<div class="wpd-header">
			<?php echo ! empty( $directory->post_title ) ? '<div class="wpd-title">' . esc_html( $directory->post_title ) . '</div>' : ''; ?>
			<?php echo ! empty( $directory_summary ) ? '<div class="wpd-summary">' . esc_html( $directory_summary ) . '</div>' : ''; ?>
		</div>
		<div class="wpd-container">
			<?php echo ! empty( $directory_description ) ? '<div class="wpd-description">' . $directory_description . '</div>' : ''; // phpcs:ignore WordPress.Security.EscapeOutput ?>
			<?php if ( ! empty( $directory_phone ) ) : ?>
				<a href="<?php echo ! empty( $directory_phone_link ) ? 'tel:' . esc_html( $directory_phone_link ) : '#'; ?>" class="wpd-phone">
					<i class="dashicons dashicons-phone"></i> <?php echo esc_html( $directory_phone ); ?>
				</a>
			<?php endif; ?>
			<?php if ( ! empty( $directory_email ) ) : ?>
				<a href="mailto:<?php echo esc_html( $directory_email ); ?>" class="wpd-email">
					<i class="dashicons dashicons-email"></i> <?php echo esc_html( $directory_email ); ?>
				</a>
			<?php endif; ?>
			<?php if ( ! empty( $directory_website ) ) : ?>
				<a href="<?php echo esc_url( $directory_website ); ?>" class="wpd-website" target="_blank">
					<i class="dashicons dashicons-admin-site-alt3"></i> <?php esc_html_e( 'View website', 'wp-directory' ); ?>
				</a>
			<?php endif; ?>

			<?php if ( have_rows( 'directory_contacts', $directory->ID ) ) : ?>
				<div class="wpd-contacts">
					<div class="wpd-contact-title"><?php esc_html_e( 'Contacts', 'wp-directory' ); ?></div>
					<?php
					while ( have_rows( 'directory_contacts', $directory->ID ) ) :
						the_row();

						$firstname  = get_sub_field( 'firstname' );
						$lastname   = get_sub_field( 'lastname' );
						$phone      = get_sub_field( 'phone' );
						$phone_link = get_sub_field( 'phone_link' );
						$email      = get_sub_field( 'email' );
						?>
						<div class="wpd-contact">
							<?php if ( ! empty( $firstname ) || ! empty( $lastname ) ) : ?>
								<div class="wpd-contact-name">
									<?php echo ! empty( $firstname ) ? '<span class="wpd-contact-firstname">' . esc_html( $firstname ) . '</span>' : ''; ?>
									<?php echo ! empty( $lastname ) ? '<span class="wpd-contact-lastname">' . esc_html( $lastname ) . '</span>' : ''; ?>
								</div>
							<?php endif; ?>
							<div class="wpd-contact-info">
								<?php if ( ! empty( $phone ) ) : ?>
									<a href="<?php echo ! empty( $phone_link ) ? 'tel:' . esc_html( $phone_link ) : '#'; ?>" class="wpd-contact-phone">
										<i class="dashicons dashicons-phone"></i> <?php echo esc_html( $phone ); ?>
									</a>
								<?php endif; ?>
								<?php if ( ! empty( $email ) ) : ?>
									<a href="mailto:<?php echo esc_html( $email ); ?>" class="wpd-contact-email">
										<i class="dashicons dashicons-email"></i> <?php echo esc_html( $email ); ?>
									</a>
								<?php endif; ?>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
