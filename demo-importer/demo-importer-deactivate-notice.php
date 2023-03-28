<?php
/**
 * Demo Importer Deactivation Notice.
 *
 * Class to display the plugin deactivation notice.
 *
 * @package radiustheme\RT_OCDI
 */

namespace RadiusTheme\RT_OCDI;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Demo Importer Deactivation Notice.
 */
class Demo_Importer_Deactivate_Notice {
	/**
	 * Class Init.
	 *
	 * @return void
	 */
	public function init() {
		add_action( 'admin_notices', [ $this, 'deactivate_notice_markup' ], 0 );
		add_action( 'admin_init', [ $this, 'deactivate_plugin' ], 0 );
		add_action( 'admin_init', [ $this, 'ignore_plugin_deactivate_notice' ], 0 );
	}

	/**
	 * Show HTML markup if conditions meet.
	 */
	/**
	 * HTML markup of notice.
	 *
	 * @return void
	 */
	public function deactivate_notice_markup() {
		$demo_imported            = get_option( 'rt_demo_importer_activated' );
		$ignore_deactivate_notice = get_option( 'rt_demo_importer_plugin_deactivate_notice' );

		if ( ! $demo_imported || ! current_user_can( 'deactivate_plugin' ) || ( $ignore_deactivate_notice && current_user_can( 'deactivate_plugin' ) ) ) {
			return;
		}
		?>
		<div class="notice notice-success rt-demo-importer-notice plugin-deactivate-notice is-dismissible" style="position:relative;">
			<p>
				<?php
				_e(
					'It seems you\'ve imported the theme demo data successfully. So, the purpose of <b>One Click Demo Import</b> plugin is fulfilled and it has no more use. <br />If you\'re satisfied with theme demo data import, you can safely deactivate it by clicking below \'Deactivate\' button.',
					'gymat'
				);
				?>
			</p>

			<p class="links">
				<a href="<?php echo esc_url( wp_nonce_url( add_query_arg( 'deactivate-one-click-demo-import', 'true' ), 'deactivate_rt_ocdi', '_deactivate_rt_ocdi_nonce' ) ); ?>" class="btn button-primary">
					<span><?php esc_html_e( 'Deactivate Demo Importer Plugun', 'gymat' ); ?></span>
				</a>
				<a class="btn button-secondary" href="?nag_rt_demo_importer_plugin_deactivate_notice=0">Dismiss This Notice</a>
			</p>
		</div>
		<?php
	}

	/**
	 * Plugin deactivation.
	 *
	 * @return void
	 */
	public function deactivate_plugin() {
		// Deactivate the plugin.
		if ( isset( $_GET['deactivate-one-click-demo-import'] ) && isset( $_GET['_deactivate_rt_ocdi_nonce'] ) ) {
			if ( ! wp_verify_nonce( $_GET['_deactivate_rt_ocdi_nonce'], 'deactivate_rt_ocdi' ) ) {
				wp_die( __( 'Action failed. Please refresh the page and retry.', 'gymat' ) );
			}

			// Get the plugin.
			$plugin = 'one-click-demo-import/one-click-demo-import.php';

			if ( is_plugin_active( $plugin ) ) {
				deactivate_plugins( $plugin );
			}

			// Redirect to main dashboard page.
			wp_safe_redirect( admin_url( 'plugins.php' ) );
		}
	}

	/**
	 * Remove the plugin deactivate notice permanently.
	 */
	public function ignore_plugin_deactivate_notice() {
		/* If user clicks to ignore the notice, add that to the options table. */
		if ( isset( $_GET['nag_rt_demo_importer_plugin_deactivate_notice'] ) && '0' == $_GET['nag_rt_demo_importer_plugin_deactivate_notice'] ) {
			update_option( 'rt_demo_importer_plugin_deactivate_notice', 'true' );
		}
	}
}
