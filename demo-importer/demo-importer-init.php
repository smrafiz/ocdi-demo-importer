<?php
/**
 * Demo Importer Init.
 *
 * Init class used for installing demo packs using OCDI.
 *
 * @package radiustheme\Gymat_Core
 */

namespace radiustheme\RT_OCDI;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Demo Importer Init.
 */
class Demo_Importer_Init {
	/**
	 * Import Data.
	 *
	 * @var array
	 */
	private $data = [];

	/**
	 * The admin page slug for the one-click demo importer.
	 *
	 * @var string
	 */
	private $page = 'one-click-demo-import';

	/**
	 * Demo Importer Init.
	 *
	 * Init class used for installing demo packs using OCDI.
	 *
	 * @param mixed $data The data to be used in the initialization process.
	 * @return void
	 */
	public function init( $data ) {
		// Demo Data.
		$this->data = $data;

		// Scripts.
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_backend_scripts' ] );

		// Recommended Plugins.
		add_filter( 'ocdi/register_plugins', [ $this, 'recommended_plugins' ] );

		// Before Import Actions.
		add_filter( 'ocdi/before_content_import', [ $this, 'before_import_actions' ] );

		// Import files.
		add_filter( 'ocdi/import_files', [ $this, 'import_files' ] );

		// After Import Actions.
		add_filter( 'ocdi/after_import', [ $this, 'after_import_actions' ] );

		// Intro Text.
		add_filter( 'ocdi/plugin_intro_text', [ $this, 'intro_text' ] );

		// Rewrite Flush Check.
		add_action( 'init', [ $this, 'rewrite_flush_check' ] );

		// Remove Notices.
		add_action( 'admin_init', [ $this, 'remove_all_notices' ] );
	}

	/**
	 * Enqueue backend demo importer scripts and styles.
	 *
	 * @param string $hook The current admin page.
	 * @return void
	 */
	public function enqueue_backend_scripts( $hook ) {
		if ( 'appearance_page_' . $this->page !== $hook ) {
			return;
		}

		wp_enqueue_style( 'rt-ocdi-importer', GYMAT_CORE_BASE_URL . 'demo-importer/assets/rt-importer.css', '', '1.0.0' );
		wp_enqueue_script( 'rt-ocdi-importer', GYMAT_CORE_BASE_URL . 'demo-importer/assets/rt-importer.js', [ 'jquery' ], '1.0.0', true );
	}

	/**
	 * Recommended plugins for the theme.
	 *
	 * @param array $plugins An associative array of plugin info.
	 * @return array Recommended plugins.
	 */
	public function recommended_plugins( $plugins ) {
		if ( empty( $this->data['plugins'] ) ) {
			return $plugins;
		}

		return $this->data['plugins'];
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
	 * Executes a chain of cleanup operations, including resetting active widgets, deleting navigation menus,
	 * and removing theme modifications.
	 *
	 * @return $this
	 */
	public function cleanups() {
		$this
			->reset_widgets()
			->delete_nav_menus()
			->remove_theme_mods();

		return $this;
	}

	/**
	 * Resets all active widgets in the system by deleting them from their respective sidebars.
	 *
	 * @return $this
	 */
	public function reset_widgets() {
		$sidebars_widgets = wp_get_sidebars_widgets();

		// Reset active widgets.
		foreach ( $sidebars_widgets as $key => $widgets ) {
			$sidebars_widgets[ $key ] = [];
		}

		wp_set_sidebars_widgets( $sidebars_widgets );

		return $this;
	}

	/**
	 * Deletes any navigation menus that are already registered in the system.
	 *
	 * @return $this
	 */
	public function delete_nav_menus() {
		$nav_menus = wp_get_nav_menus();

		// Delete navigation menus.
		if ( ! empty( $nav_menus ) ) {
			foreach ( $nav_menus as $nav_menu ) {
				wp_delete_nav_menu( $nav_menu->slug );
			}
		}

		return $this;
	}

	/**
	 * Removes theme modifications made before the demo import.
	 *
	 * @return $this
	 */
	public function remove_theme_mods() {
		remove_theme_mods();

		return $this;
	}

	/**
	 * Deletes some pages.
	 *
	 * @return $this
	 */
	public function delete_pages() {
		$pages_to_delete = [
			'My Account',
			'Checkout',
		];

		foreach ( $pages_to_delete as $page_title ) {
			$page = get_page_by_title( $page_title );

			if ( $page ) {
				wp_delete_post( $page->ID, true );
			}
		}

		return $this;
	}

	/**
	 * Updates the 'Hello World!' blog post by making it a draft
	 *
	 * @return $this
	 */
	public function draft_post() {
		// Update the Hello World! post by making it a draft.
		$hello_world = get_page_by_title( 'Hello World!', OBJECT, 'post' );

		if ( $hello_world ) {
			$hello_world_arg = [
				'ID'          => 1,
				'post_status' => 'draft',
			];

			// Update the post into the database.
			wp_update_post( $hello_world_arg );
		}

		return $this;
	}

	/**
	 * Generates an array of import files for OCDI based on the demo pack data.
	 *
	 * @return array[] An array of import files in the format recognized by OCDI.
	 */
	public function import_files() {
		$import_files = [];
		$pages        = $this->data['demo'];

		foreach ( $pages as $page ) {
			$import_files[] = [
				'import_file_name'           => $page['name'],
				'import_preview_image_url'   => $page['preview'],
				'preview_url'                => $page['demo'],
				'import_file_url'            => $this->data['data_server'] . 'content.xml',
				'import_widget_file_url'     => $this->data['data_server'] . 'widgets.wie',
				'import_customizer_file_url' => $this->data['data_server'] . 'customizer.dat',
			];
		}

		return $import_files;
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

		// Rewrite flag.
		update_option( $this->data['theme'] . '_ocdi_importer_rewrite_flash', true );
	}

	/**
	 * Assigns the imported navigation menus to their respective locations.
	 *
	 * @return $this
	 */
	public function assign_menus() {
		$menus_to_register = $this->data['menus'];

		foreach ( $menus_to_register as $menu ) {
			$menu_id = get_term_by( 'name', $menu['menu_name'], 'nav_menu' )->term_id;

			$menus[ $menu['menu_location'] ] = $menu_id;
		}

		if ( ! empty( $menus ) ) {
			set_theme_mod( 'nav_menu_locations', $menus );
		}

		return $this;
	}

	/**
	 * Assigns the imported front and blog pages to the 'front page' and 'posts page' options in WordPress.
	 *
	 * @param string $selected_import The name of the imported file.
	 * @return $this
	 */
	public function assign_front_page( $selected_import ) {
		// Assign front page and posts page (blog page).
		$front = get_page_by_title( $selected_import['import_file_name'] );
		$blog  = get_page_by_title( 'Blog' );

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front->ID );
		update_option( 'page_for_posts', $blog->ID );

		return $this;
	}

	/**
	 * Assigns WooCommerce pages to their respective option values.
	 *
	 * If the WooCommerce plugin is not active, this method has no effect.
	 *
	 * @return $this
	 */
	public function assign_woo_pages() {
		if ( ! class_exists( 'WooCommerce' ) ) {
			return $this;
		}

		global $wpdb;

		$wc_pages = [
			'shop'      => [
				'name'  => 'shop',
				'title' => 'Shop',
			],
			'cart'      => [
				'name'  => 'cart',
				'title' => 'Cart',
			],
			'checkout'  => [
				'name'  => 'checkout',
				'title' => 'Checkout',
			],
			'myaccount' => [
				'name'  => 'my-account',
				'title' => 'My Account',
			],
		];

		// Set WC pages properly.
		foreach ( $wc_pages as $key => $wc_page ) {

			// Get the ID of every page with matching name or title.
			$page_ids = $wpdb->get_results(
				$wpdb->prepare(
					"SELECT ID FROM $wpdb->posts WHERE (post_name = %s OR post_title = %s) AND post_type = 'page' AND post_status = 'publish'",
					$wc_page['name'],
					$wc_page['title']
				)
			);

			if ( ! is_null( $page_ids ) ) {
				$page_id    = 0;
				$delete_ids = [];

				// Retrieve page with greater id and delete others.
				if ( sizeof( $page_ids ) > 1 ) {
					foreach ( $page_ids as $page ) {
						if ( $page->ID > $page_id ) {
							if ( $page_id ) {
								$delete_ids[] = $page_id;
							}

							$page_id = $page->ID;
						} else {
							$delete_ids[] = $page->ID;
						}
					}
				} else {
					$page_id = $page_ids[0]->ID;
				}

				// Delete posts.
				foreach ( $delete_ids as $delete_id ) {
					wp_delete_post( $delete_id, true );
				}

				// Update WC page.
				if ( $page_id > 0 ) {
					wp_update_post(
						[
							'ID'        => $page_id,
							'post_name' => sanitize_title( $wc_page['name'] ),
						]
					);
					update_option( 'woocommerce_' . $key . '_page_id', $page_id );
				}
			}
		}

		// We no longer need WC setup wizard redirect.
		delete_transient( '_wc_activation_redirect' );

		return $this;
	}

	/**
	 * Sets the active Elementor kit by updating the 'elementor_active_kit' option in the database.
	 *
	 * @return $this
	 */
	public function set_elementor_active_kit() {
		global $wpdb;

		$page_ids = $wpdb->get_results(
			$wpdb->prepare(
				"SELECT ID FROM $wpdb->posts WHERE (post_name = %s OR post_title = %s) AND post_type = 'elementor_library' AND post_status = 'publish'",
				'default-kit',
				'Default Kit'
			)
		);

		if ( ! is_null( $page_ids ) ) {
			$page_id    = 0;
			$delete_ids = [];

			// Retrieve page with greater id and delete others.
			if ( sizeof( $page_ids ) > 1 ) {
				foreach ( $page_ids as $page ) {
					if ( $page->ID > $page_id ) {
						if ( $page_id ) {
							$delete_ids[] = $page_id;
						}

						$page_id = $page->ID;
					} else {
						$delete_ids[] = $page->ID;
					}
				}
			} else {
				$page_id = $page_ids[0]->ID;
			}

			// Update `elementor_active_kit` page.
			if ( $page_id > 0 ) {
				wp_update_post(
					[
						'ID'        => $page_id,
						'post_name' => sanitize_title( 'Default Kit' ),
					]
				);
				update_option( 'elementor_active_kit', $page_id );
			}
		}

		return $this;
	}


	/**
	 * Updates the permalink structure to "/%postname%/".
	 *
	 * @return $this
	 */
	public function update_permalinks() {
		update_option( 'permalink_structure', '/%postname%/' );

		return $this;
	}

	/**
	 * Returns a custom HTML block to be added to the plugin intro text.
	 *
	 * @return string HTML code for the custom intro text.
	 */
	public function intro_text() {
		return '<div class="ocdi__intro-text"><p class="about-description">Please note that, no data will be lost upon importing demo data, but it is recommended to use one click demo data for a new website. <br /> If one click demo import does not work please try manual demo import. <a href="' . esc_url( $this->data['manual_import_doc'] ) . '" target="_blank">Check Documentation.</a></p></div>';
	}

	/**
	 * Check if the option to flush the rewrite rules has been set, and if so, flushes them and deletes the option.
	 *
	 * @return void
	 */
	public function rewrite_flush_check() {
		$option = $this->data['theme'] . '_ocdi_importer_rewrite_flash';

		if ( true === get_option( $option ) ) {
			flush_rewrite_rules();
			delete_option( $option );
		}
	}

	/**
	 * Remove all admin notices from the demo import page.
	 *
	 * @return void
	 */
	public function remove_all_notices() {
		global $pagenow;

		if ( $pagenow === 'themes.php' && isset( $_GET['page'] ) && $this->page === $_GET['page'] ) {
			remove_all_actions( 'admin_notices' );
		}
	}
}
