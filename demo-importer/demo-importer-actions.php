<?php
/**
 * Demo Importer Actions.
 *
 * Demo Importer Actions before and after OCDI Demo Import.
 *
 * @package radiustheme\RT_OCDI
 */

namespace RadiusTheme\RT_OCDI;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Demo Importer Actions.
 */
class Demo_Importer_Actions {
	/**
	 * Class Init.
	 *
	 * @return void
	 */
	public function init() {
		add_filter( 'ocdi/before_content_import', [ $this, 'before_import_actions' ] );
		add_filter( 'ocdi/after_import', [ $this, 'after_import_actions' ] );
	}

	/**
	 * Executes cleanup operations and other actions that need to be performed before the demo import.
	 *
	 * @return $this
	 */
	public function before_import_actions() {
		$this
			->cleanups()
			->delete_pages()
			->draft_post();

		return $this;
	}

	/**
	 * Performs actions that need to be executed after a demo pack is imported using OCDI. This includes assigning menus,
	 * updating WooCommerce pages, assigning front and blog pages, and flushing rewrite rules.
	 *
	 * @param string $selected_import The name of the imported file.
	 * @return void
	 */
	public function after_import_actions( $selected_import ) {
		$this
			->assign_menus()
			->assign_front_page( $selected_import )
			->assign_woo_pages()
			->set_elementor_active_kit()
			->update_permalinks();

		// Settings Update.
		update_option( $this->data['theme'] . '_ocdi_importer_rewrite_flash', true );
		update_option( 'rt_demo_importer_activated', 'true' );
	}
}
