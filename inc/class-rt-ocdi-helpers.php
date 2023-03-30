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
			$output = '<span class="failure">' . __( 'Connection Error', 'gymat' ) . '</span>';
		} else {
			$output = '<span class="success">' . __( 'Connected', 'gymat' ) . '</span>';
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
}
