<?php
/**
 * RT OCDI Theme Config
 *
 * Theme Configuration for installing demo packs using OCDI.
 *
 * @package RadiusTheme\RT_OCDI
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * RT OCDI Theme Config
 */
class RT_OCDI_Theme_Config {
	/**
	 * Theme Specific Import Data.
	 *
	 * @var array
	 */
	private $data = [];

	/**
	 * Class Constructor.
	 *
	 * @return array
	 */
	public function get_import_data() {
		$this
			->theme_data()
			->demos()
			->menus()
			->plugins();

		return $this->data;
	}

	/**
	 * Sets the theme data.
	 *
	 * @return $this
	 */
	private function theme_data() {
		$this->data['theme']                 = 'Gymat';
		$this->data['data_server']           = 'https://radiustheme.com/demo/wordpress/demo-content/gymat/ocdi/';
		$this->data['demo_link']             = 'https://radiustheme.com/demo/wordpress/themes/gymat/';
		$this->data['import_doc_link']       = 'https://radiustheme.com/demo/wordpress/themes/gymat/docs/#section-4';
		$this->data['elementor_cpt_support'] = [
			'post',
			'page',
			'gymat_class',
		];

		return $this;
	}

	/**
	 * Sets the list of theme demos.
	 *
	 * @return $this
	 */
	private function demos() {
		$this->data['demo'] = [
			[
				'name'    => __( 'Home 1', 'my-plugin-text-domain' ),
				'preview' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/screenshot1.jpg',
				'demo'    => 'https://www.radiustheme.com/demo/wordpress/themes/gymat/',
			],
			[
				'name'    => __( 'Home 2', 'my-plugin-text-domain' ),
				'preview' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/screenshot2.jpg',
				'demo'    => 'https://www.radiustheme.com/demo/wordpress/themes/gymat/home-2/',
			],
			[
				'name'    => __( 'Home 3', 'my-plugin-text-domain' ),
				'preview' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/screenshot3.jpg',
				'demo'    => 'https://www.radiustheme.com/demo/wordpress/themes/gymat/home-3/',
			],
			[
				'name'    => __( 'Home 4', 'my-plugin-text-domain' ),
				'preview' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/screenshot4.jpg',
				'demo'    => 'https://www.radiustheme.com/demo/wordpress/themes/gymat/home-4/',
			],
			[
				'name'    => __( 'Home 5', 'my-plugin-text-domain' ),
				'preview' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/screenshot5.jpg',
				'demo'    => 'https://www.radiustheme.com/demo/wordpress/themes/gymat/home-5/',
			],
		];

		return $this;
	}

	/**
	 * Sets the list of menus.
	 *
	 * @return $this
	 */
	private function menus() {
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

		return $this;
	}

	/**
	 * Sets the list of required plugins.
	 *
	 * @return void
	 */
	private function plugins() {
		$this->data['plugins'] = [
			[
				'name'        => 'RT Framework',
				'description' => 'This plugin is <b><i>Required</i></b>.',
				'slug'        => 'rt-framework',
				'source'      => get_template_directory_uri() . '/inc/plugins/rt-framework.zip',
				'required'    => true,
			],
			[
				'name'        => 'Breadcrumb NavXT',
				'description' => 'This plugin is <b><i>Required</i></b>.',
				'slug'        => 'breadcrumb-navxt',
				'required'    => true,
			],
			[
				'name'        => 'Elementor Page Builder',
				'description' => 'This plugin is <b><i>Required</i></b>.',
				'slug'        => 'elementor',
				'required'    => true,
			],
			[
				'name'        => 'WP Fluent Forms',
				'description' => 'This plugin is <b><i>Optional</i></b>.',
				'slug'        => 'fluentform',
				'required'    => false,
			],
			[
				'name'        => 'Woocommerce',
				'description' => 'This plugin is <b><i>Optional</i></b>.',
				'slug'        => 'woocommerce',
				'required'    => false,
			],
		];
	}
}
