<?php
/**
 * Demo Importer Actions.
 *
 * Demo Importer Actions before and after OCDI Demo Import.
 *
 * @package RadiusTheme\RT_OCDI
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Demo Importer Actions.
 */
class RT_OCDI_Import_Actions {
	/**
	 * Import Data.
	 *
	 * @var array
	 */
	private $data = [];

	/**
	 * Class Init.
	 *
	 * @return void
	 */
	public function init() {
		// Get Import Data.
		$this->data = ( new RT_OCDI_Theme_Config() )->get_import_data();

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
}
