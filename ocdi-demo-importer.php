<?php
/**
 * OCDI Demo Importer
 *
 * Core class used for installing demo packs using OCDI.
 *
 * @package radiustheme\RT_OCDI
 */

namespace RadiusTheme\RT_OCDI;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * OCDI Demo Importer
 */
class Ocdi_Demo_Importer {
	/**
	 * Theme Specific Import Data.
	 *
	 * @var array
	 */
	private $data = [];

	/**
	 * Class Constructor.
	 *
	 * @return void
	 */
	public function __construct() {
		require_once 'demo-importer/demo-importer-init.php';

		$this->data['theme']             = 'Gymat';
		$this->data['data_server']       = 'https://radiustheme.net/rafiz/demos/gymat/';
		$this->data['manual_import_doc'] = 'https://radiustheme.com/demo/wordpress/themes/gymat/docs/#section-4-2';

		$this->data['demo'] = [
			[
				'name'    => __( 'Home 1', 'my-theme-text-domain' ),
				'preview' => plugins_url( 'screenshots/screenshot1.jpg', __FILE__ ),
				'demo'    => 'https://www.radiustheme.com/demo/wordpress/themes/gymat/',
			],
			[
				'name'    => __( 'Home 2', 'my-theme-text-domain' ),
				'preview' => plugins_url( 'screenshots/screenshot2.jpg', __FILE__ ),
				'demo'    => 'https://www.radiustheme.com/demo/wordpress/themes/gymat/home-2/',
			],
			[
				'name'    => __( 'Home 3', 'my-theme-text-domain' ),
				'preview' => plugins_url( 'screenshots/screenshot3.jpg', __FILE__ ),
				'demo'    => 'https://www.radiustheme.com/demo/wordpress/themes/gymat/home-3/',
			],
			[
				'name'    => __( 'Home 4', 'my-theme-text-domain' ),
				'preview' => plugins_url( 'screenshots/screenshot4.jpg', __FILE__ ),
				'demo'    => 'https://www.radiustheme.com/demo/wordpress/themes/gymat/home-4/',
			],
			[
				'name'    => __( 'Home 5', 'my-theme-text-domain' ),
				'preview' => plugins_url( 'screenshots/screenshot5.jpg', __FILE__ ),
				'demo'    => 'https://www.radiustheme.com/demo/wordpress/themes/gymat/home-5/',
			],
		];

		$this->data['menus'] = [
			[
				'menu_location' => 'primary',
				'menu_name'     => 'Main Menu',
			],
			[
				'menu_location' => 'header_5_left_menu',
				'menu_name'     => 'Header 5 Left Menu',
			],
			[
				'menu_location' => 'header_5_right_menu',
				'menu_name'     => 'Header 5 Right Menu',
			],
		];

		$this->data['plugins'] = [
			[
				'name'     => 'RT Framework (Required)',
				'slug'     => 'rt-framework',
				'source'   => get_template_directory_uri() . '/inc/plugins/rt-framework.zip',
				'required' => true,
			],
			[
				'name'     => 'Breadcrumb NavXT (Required)',
				'slug'     => 'breadcrumb-navxt',
				'required' => true,
			],
			[
				'name'     => 'Elementor Page Builder (Required)',
				'slug'     => 'elementor',
				'required' => true,
			],
			[
				'name'     => 'WP Fluent Forms (Optional)',
				'slug'     => 'fluentform',
				'required' => false,
			],
			[
				'name'     => 'Woocommerce (Optional)',
				'slug'     => 'woocommerce',
				'required' => false,
			],
		];

		// Init Demo Importer.
		$this->init();
	}

	/**
	 * Initializes the demo importer using the provided data.
	 *
	 * @return void
	 */
	public function init() {
		$demo_importer = new Demo_Importer_Init();
		$demo_importer->init( $this->data );
	}
}

new Ocdi_Demo_Importer();
