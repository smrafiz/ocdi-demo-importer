<?php
/**
 * Demo Importer Status.
 *
 * Responsible for demo importer status page.
 *
 * @package RadiusTheme\RT_OCDI
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Demo Importer Status.
 */
class RT_OCDI_System_Status {
	/**
	 * Class Init.
	 *
	 * @return void
	 */
	public function init() {
		add_action( 'admin_menu', [ $this, 'admin_menu' ], 11 );
	}

	/**
	 * Add Status Page.
	 *
	 * @return void
	 */
	public function admin_menu() {
		add_theme_page(
			__( 'Demo Importer Status', 'gymat' ),
			__( 'Demo Importer Status', 'gymat' ),
			'switch_themes',
			'rt-demo-importer-status',
			[ $this, 'status_menu' ]
		);
	}

	/**
	 * Demo Importer status page output.
	 *
	 * @return void
	 */
	public function status_menu() {
		?>
		<div class="wrap demo-importer-status">
			<?php
			RT_OCDI_Helpers::system_status();
			?>
		</div>
		<?php
	}
}
