<?php
/**
 * Create A Simple Theme Options Panel
 *
 */

// COMO USAR
// $value = fs_get_theme_option( 'select_example' );
// echo $value;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
if ( ! class_exists( 'FS_Theme_Options' ) ) {

	class FS_Theme_Options {

		/**
		 * Start things up
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			// We only need to register the admin panel on the back-end
			if ( is_admin() ) {
				add_action( 'admin_menu', array( 'FS_Theme_Options', 'add_admin_menu' ) );
				add_action( 'admin_init', array( 'FS_Theme_Options', 'register_settings' ) );
			}

		}

		/**
		 * Returns all theme options
		 *
		 * @since 1.0.0
		 */
		public static function get_theme_options() {
			return get_option( 'theme_options' );
		}

		/**
		 * Returns single theme option
		 *
		 * @since 1.0.0
		 */
		public static function get_theme_option( $id ) {
			$options = self::get_theme_options();
			if ( isset( $options[$id] ) ) {
				return $options[$id];
			}
		}

		/**
		 * Add sub menu page
		 *
		 * @since 1.0.0
		 */
		public static function add_admin_menu() {
			add_menu_page(
				esc_html__( 'Opções do tema', 'hFansite' ),
				esc_html__( 'Opções do tema', 'hFansite' ),
				'manage_options',
				'theme-settings',
				array( 'FS_Theme_Options', 'create_admin_page' )
			);
		}

		/**
		 * Register a setting and its sanitization callback.
		 *
		 * We are only registering 1 setting so we can store all options in a single option as
		 * an array. You could, however, register a new setting for each option
		 *
		 * @since 1.0.0
		 */
		public static function register_settings() {
			register_setting( 'theme_options', 'theme_options', array( 'FS_Theme_Options', 'sanitize' ) );
		}

		/**
		 * Sanitization callback
		 *
		 * @since 1.0.0
		 */
		public static function sanitize( $options ) {

			// If we have options lets sanitize them
			if ( $options ) {

				// Checkbox
				if ( ! empty( $options['checkbox_example'] ) ) {
					$options['checkbox_example'] = 'on';
				} else {
					unset( $options['checkbox_example'] ); // Remove from options if not checked
				}

				// Input
				if ( ! empty( $options['input_example'] ) ) {
					$options['input_example'] = sanitize_text_field( $options['input_example'] );
				} else {
					unset( $options['input_example'] ); // Remove from options if empty
				}

				// Select
				if ( ! empty( $options['select_example'] ) ) {
					$options['select_example'] = sanitize_text_field( $options['select_example'] );
				}

			}

			// Return sanitized options
			return $options;

		}

		/**
		 * Settings page output
		 *
		 * @since 1.0.0
		 */
		public static function create_admin_page() { ?>

			<div class="wrap">

				<h1><?php esc_html_e( 'Opcões do tema', 'hFansite' ); ?></h1>

				<form method="post" action="options.php">

					<?php settings_fields( 'theme_options' ); ?>
<!-- 
					<table class="form-table">

						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Exemplo checkbox', 'hFansite' ); ?></th>
							<td>
								<?php $value = self::get_theme_option( 'checkbox_example' ); ?>
								<input type="checkbox" name="theme_options[checkbox_example]" <?php checked( $value, 'on' ); ?>> <?php esc_html_e( 'Checkbox example description.', 'hFansite' ); ?>
							</td>
						</tr>

						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Exemplo input', 'hFansite' ); ?></th>
							<td>
								<?php $value = self::get_theme_option( 'input_example' ); ?>
								<input type="text" name="theme_options[input_example]" value="<?php echo esc_attr( $value ); ?>">
							</td>
						</tr>

						<tr valign="top" class="wpex-custom-admin-screen-background-section">
							<th scope="row"><?php esc_html_e( 'Exemplo select', 'hFansite' ); ?></th>
							<td>
								<?php $value = self::get_theme_option( 'select_example' ); ?>
								<select name="theme_options[select_example]">
									<?php
									$options = array(
										'1' => esc_html__( 'Opção 1', 'hFansite' ),
										'2' => esc_html__( 'Opção 2', 'hFansite' ),
										'3' => esc_html__( 'Opção 3', 'hFansite' ),
									);
									foreach ( $options as $id => $label ) { ?>
										<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $value, $id, true ); ?>>
											<?php echo strip_tags( $label ); ?>
										</option>
									<?php } ?>
								</select>
							</td>
						</tr>

					</table> -->

					<h2>Rádio</h2>

					<table class="form-table">

						<tr valign="top">
							<th scope="row">Status</th>
							<td>
								<?php $value = self::get_theme_option( 'radio_checkbox' ); ?>
								<input type="checkbox" name="theme_options[radio_checkbox]" <?php checked( $value, 'on' ); ?>> Ativo
							</td>
						</tr>

						<tr valign="top">
							<th scope="row">IP</th>
							<td>
								<?php $value = self::get_theme_option( 'radio_ip' ); ?>
								<input type="text" name="theme_options[radio_ip]" value="<?php echo esc_attr( $value ); ?>">
							</td>
						</tr>

						<tr valign="top">
							<th scope="row">Porta</th>
							<td>
								<?php $value = self::get_theme_option( 'radio_port' ); ?>
								<input type="text" name="theme_options[radio_port]" value="<?php echo esc_attr( $value ); ?>">
							</td>
						</tr>

					</table>

					<hr>

					<h2>Admin (Login)</h2>
					
					<table class="form-table">
						<tr valign="top">
							<th scope="row">Logo</th>
							<td>
								<?php $value = self::get_theme_option( 'login_logo' ); ?>
								<input type="file" name="theme_options[login_logo]" value="<?php echo esc_attr( $value ); ?>">
							</td>
						</tr>
					</table>

					<?php submit_button(); ?>

				</form>

			</div><!-- .wrap -->
		<?php }

	}
}
new FS_Theme_Options();

// Helper function to use in your theme to return a theme option value
function fs_get_theme_option( $id = '' ) {
	return FS_Theme_Options::get_theme_option( $id );
}


