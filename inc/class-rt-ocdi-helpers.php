<?php
/**
 * Demo Importer Helpers.
 *
 * Helper functions to be used for Demo Importer.
 *
 * @package RadiusTheme\RT_OCDI
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Demo Importer Helpers.
 */
class RT_OCDI_Helpers {
	/**
	 * Handles the display of System Status.
	 */
	public static function system_status() {
		include_once dirname( __FILE__ ) . '/views/system-status-report.php';
	}

	/**
	 * Check if we can connect to data server for demo import feature.
	 *
	 * @return string
	 */
	public static function get_data_server_status() {
		$output              = '';
		$package_file_server = wp_remote_get( 'https://www.radiustheme.com/demo/wordpress/demo-content/README.md' );
		$http_response_code  = wp_remote_retrieve_response_code( $package_file_server );

		if ( is_wp_error( $package_file_server ) || 200 !== (int) $http_response_code ) {
			$output = '<span class="failure">' . __( 'Connection Error', 'my-plugin-text-domain' ) . '</span>';
		} else {
			$output = '<span class="success">' . __( 'Connected', 'my-plugin-text-domain' ) . '</span>';
		}

		return $output;
	}

	/**
	 * Get lists of active plugins.
	 *
	 * @return array
	 */
	public static function get_active_plugins() {
		// Ensure get_plugins function is loaded.
		if ( ! function_exists( 'get_plugins' ) ) {
			include ABSPATH . '/wp-admin/includes/plugin.php';
		}

		$active_plugins = get_option( 'active_plugins' );
		$active_plugins = array_intersect_key( get_plugins(), array_flip( $active_plugins ) );

		return $active_plugins;
	}

	/**
	 * Get lists of inactive plugins.
	 *
	 * @return array
	 */
	public static function get_inactive_plugins() {
		return array_diff_key( get_plugins(), self::get_active_plugins() );
	}

	/**
	 * Checks if OCDI is active.
	 *
	 * @return bool
	 */
	public static function is_ocdi_active() {
		if ( ! function_exists( 'is_plugin_active' ) ) {
			include_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		return is_plugin_active( 'one-click-demo-import/one-click-demo-import.php' );
	}

	/**
	 * Get page by title.
	 *
	 * @param string $title Page name.
	 * @param string $post_type Post type.
	 *
	 * @return WP_Post|null
	 */
	public static function get_page_by_title( $title, $post_type = 'page' ) {
		$query = new WP_Query(
			[
				'post_type'              => esc_html( $post_type ),
				'title'                  => esc_html( $title ),
				'post_status'            => 'all',
				'posts_per_page'         => 1,
				'no_found_rows'          => true,
				'ignore_sticky_posts'    => true,
				'update_post_term_cache' => false,
				'update_post_meta_cache' => false,
				'orderby'                => 'post_date ID',
				'order'                  => 'ASC',
			]
		);

		if ( ! empty( $query->post ) ) {
			$page_got_by_title = $query->post;
		} else {
			$page_got_by_title = null;
		}

		return $page_got_by_title;
	}

	/**
	 * Searches for an array with the given ID in a nested array.
	 *
	 * @param array  $array The array to search.
	 * @param string $search_id The id to search for.
	 *
	 * @return mixed|null
	 */
	public static function search_nested_array( $array, $search_id ) {
		if ( ! is_array( $array ) ) {
			return $array;
		}

		foreach ( $array as $key => $value ) {
			if ( is_array( $value ) ) {
				$result = self::search_nested_array( $value, $search_id );

				if ( null !== $result ) {
					return $result;
				}
			} else {
				if ( 'id' === $key && $value === $search_id ) {
					return $array;
				}
			}
		}
		return null;
	}

	/**
	 * Recursively searches a nested array for a given key and replaces its value.
	 *
	 * @param array  $array The array to search.
	 * @param string $search The key to search for.
	 * @param mixed  $replace The value to replace.
	 */
	public static function replace_nested_array( &$array, $search, &$replace ) {
		foreach ( $array as &$value ) {
			if ( is_array( $value ) ) {
				// check if this is the array that contains the search value.
				if ( isset( $value['id'] ) && $value['id'] === $search ) {
					$value = $replace;
					return;
				}

				self::replace_nested_array( $value, $search, $replace );
			}
		}
	}
}
