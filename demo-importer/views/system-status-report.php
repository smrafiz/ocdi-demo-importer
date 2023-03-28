<?php
/**
 * Admin View: Page - System Status
 *
 * @package ThemeGrill_Demo_Importer
 */

namespace RadiusTheme\RT_OCDI;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

global $wpdb, $wp_rewrite;

$curl_data = function_exists( 'curl_version' ) ? curl_version() : false;
$gd_data   = function_exists( 'gd_info' ) ? gd_info() : false;
$theme     = wp_get_theme();

// Server Data.
$max_execution_time = ini_get( 'max_execution_time' );
$max_upload_size    = ini_get( 'upload_max_filesize' );
$post_max_size      = ini_get( 'post_max_size' );
$memory_limit       = ini_get( 'memory_limit' );
?>

<div class="demo-importer-system-status">
	<h1><?php esc_html_e( 'System Status for Demo Importer', 'gymat' ); ?></h1>

	<table class="demo-importer-status-table widefat">
		<thead>
		<tr>
			<th><?php esc_html_e( 'System Info', 'gymat' ); ?></th>
			<th></th>
			<th></th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td><?php esc_html_e( 'Operating System:', 'gymat' ); ?></td>
			<td><?php echo esc_html( PHP_OS ); ?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'Server:', 'gymat' ); ?></td>
			<td><?php echo esc_html( wp_unslash( $_SERVER['SERVER_SOFTWARE'] ) ); ?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'MySQL Version:', 'gymat' ); ?></td>
			<td><?php echo esc_html( $wpdb->get_var( 'SELECT VERSION()' ) ); ?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'PHP Version:', 'gymat' ); ?></td>
			<td><?php echo esc_html( PHP_VERSION ); ?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'PHP Max Execution Time:', 'gymat' ); ?></td>
			<td class="<?php echo $max_execution_time < 300 ? 'error' : ''; ?>"><?php echo esc_html( $max_execution_time ); ?></td>
			<td><?php echo $max_execution_time < 300 ? 'Recommended PHP Max Execution Time is 300' : ''; ?></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'PHP Max Upload Size:', 'gymat' ); ?></td>
			<td class="<?php echo $max_upload_size < 256 ? 'error' : ''; ?>"><?php echo esc_html( $max_upload_size ); ?></td>
			<td><?php echo $max_upload_size < 256 ? 'Recommended PHP Max Execution Time is 256M' : ''; ?></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'PHP Post Max Size:', 'gymat' ); ?></td>
			<td class="<?php echo $post_max_size < 512 ? 'error' : ''; ?>"><?php echo esc_html( $post_max_size ); ?></td>
			<td><?php echo $post_max_size < 512 ? 'Recommended PHP Post Max Size is 512M' : ''; ?></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'PHP Max Input Vars:', 'gymat' ); ?></td>
			<td><?php echo esc_html( ini_get( 'max_input_vars' ) ); ?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'PHP Memory Limit:', 'gymat' ); ?></td>
			<td class="<?php echo $memory_limit < 256 ? 'error' : ''; ?>"><?php echo esc_html( $memory_limit ); ?></td>
			<td><?php echo $memory_limit < 256 ? 'Recommended PHP Memory Limit is 256M' : ''; ?></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'cURL Installed:', 'gymat' ); ?></td>
			<td><?php extension_loaded( 'curl' ) ? esc_html_e( 'Yes', 'gymat' ) : esc_html_e( 'No', 'gymat' ); ?></td>
			<td></td>
		</tr>
		<?php if ( $curl_data ) : ?>
			<tr>
				<td><?php esc_html_e( 'cURL version:', 'gymat' ); ?></td>
				<td><?php echo esc_html( $curl_data['version'] ); ?></td>
				<td></td>
			</tr>
		<?php endif; ?>
		<tr>
			<td><?php esc_html_e( 'GD Installed:', 'gymat' ); ?></td>
			<td><?php extension_loaded( 'gd' ) ? esc_html_e( 'Yes', 'gymat' ) : esc_html_e( 'No', 'gymat' ); ?></td>
			<td></td>
		</tr>
		<?php if ( $gd_data ) : ?>
			<tr>
				<td><?php esc_html_e( 'GD version:', 'gymat' ); ?></td>
				<td><?php echo esc_html( $gd_data['GD Version'] ); ?></td>
				<td></td>
			</tr>
		<?php endif; ?>
		<tr>
			<td><?php esc_html_e( 'Data Server Connection:', 'gymat' ); ?></td>
			<td><span class="data-server"><?php echo Demo_Importer_Fns::get_data_server_status(); ?></span></td>
			<td></td>
		</tr>
		</tbody>
	</table>


	<table class="demo-importer-status-table widefat">
		<thead>
		<tr>
			<th><?php esc_html_e( 'WordPress Info', 'gymat' ); ?></th>
			<th></th>
			<th></th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td><?php esc_html_e( 'Version:', 'gymat' ); ?></td>
			<td><?php echo esc_html( get_bloginfo( 'version' ) ); ?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'Site URL:', 'gymat' ); ?></td>
			<td><?php echo esc_html( get_site_url() ); ?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'Home URL:', 'gymat' ); ?></td>
			<td><?php echo esc_html( get_home_url() ); ?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'Multisite:', 'gymat' ); ?></td>
			<td><?php is_multisite() ? esc_html_e( 'Yes', 'gymat' ) : esc_html_e( 'No', 'gymat' ); ?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'Max Upload Size:', 'gymat' ); ?></td>
			<td><?php echo esc_html( size_format( wp_max_upload_size() ) ); ?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'Memory Limit:', 'gymat' ); ?></td>
			<td><?php echo esc_html( WP_MEMORY_LIMIT ); ?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'Max Memory Limit:', 'gymat' ); ?></td>
			<td><?php echo esc_html( WP_MAX_MEMORY_LIMIT ); ?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'Permalink Structure:', 'gymat' ); ?></td>
			<td><?php echo '' !== $wp_rewrite->permalink_structure ? esc_html( $wp_rewrite->permalink_structure ) : esc_html__( 'Plain', 'gymat' ); ?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'Language:', 'gymat' ); ?></td>
			<td><?php echo esc_html( get_bloginfo( 'language' ) ); ?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'Debug Mode Enabled:', 'gymat' ); ?></td>
			<td><?php WP_DEBUG ? esc_html_e( 'Yes', 'gymat' ) : esc_html_e( 'No', 'gymat' ); ?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'Script Debug Mode Enabled:', 'gymat' ); ?></td>
			<td><?php SCRIPT_DEBUG ? esc_html_e( 'Yes', 'gymat' ) : esc_html_e( 'No', 'gymat' ); ?></td>
			<td></td>
		</tr>
		</tbody>
	</table>


	<table class="demo-importer-status-table widefat">
		<thead>
		<tr>
			<th><?php esc_html_e( 'Theme Info', 'gymat' ); ?></th>
			<th></th>
			<th></th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td><?php esc_html_e( 'Name:', 'gymat' ); ?></td>
			<td><?php echo esc_html( $theme->get( 'Name' ) ); ?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'Version:', 'gymat' ); ?></td>
			<td><?php echo esc_html( $theme->get( 'Version' ) ); ?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'Author:', 'gymat' ); ?></td>
			<td><?php echo esc_html( $theme->get( 'Author' ) ); ?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'Author URL:', 'gymat' ); ?></td>
			<td><?php echo esc_html( $theme->get( 'AuthorURI' ) ); ?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'Child Theme:', 'gymat' ); ?></td>
			<td><?php is_child_theme() ? esc_html_e( 'Yes', 'gymat' ) : esc_html_e( 'No', 'gymat' ); ?></td>
			<td></td>
		</tr>
		<?php if ( is_child_theme() ) : ?>
			<tr>
				<td><?php esc_html_e( 'Parent Theme Name:', 'gymat' ); ?></td>
				<td><?php echo esc_html( $theme->parent()->get( 'Name' ) ); ?></td>
				<td></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Parent Theme Version:', 'gymat' ); ?></td>
				<td><?php echo esc_html( $theme->parent()->get( 'Version' ) ); ?></td>
				<td></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Parent Theme Author:', 'gymat' ); ?></td>
				<td><?php echo esc_html( $theme->parent()->get( 'Author' ) ); ?></td>
				<td></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Parent Theme Author URL:', 'gymat' ); ?></td>
				<td><?php echo esc_html( $theme->parent()->get( 'AuthorURI' ) ); ?></td>
				<td></td>
			</tr>
		<?php endif; ?>
		</tbody>
	</table>


	<table class="demo-importer-status-table widefat">
		<thead>
		<tr>
			<th><?php esc_html_e( 'Active Plugins', 'gymat' ); ?></th>
			<th></th>
			<th></th>
		</tr>
		</thead>
		<tbody>
		<?php
		$active_plugin_lists = Demo_Importer_Fns::get_active_plugins();

		// Display the active plugin lists.
		foreach ( $active_plugin_lists as $active_plugin_list ) :
			echo '<tr>';
			echo '<td>';
			if ( $active_plugin_list['PluginURI'] ) :
				$plugin_name = '<a href="' . $active_plugin_list['PluginURI'] . '" target="_blank">' . $active_plugin_list['Name'] . '</a>';
			else :
				$plugin_name = $active_plugin_list['Name'];
			endif;

			if ( $active_plugin_list['Version'] ) :
				$plugin_name .= ' - ' . $active_plugin_list['Version'];
			endif;

			echo $plugin_name;
			echo '</td>';

			echo '<td>';
			if ( $active_plugin_list['Author'] ) :
				printf(
				/* translators: 1. Plugin author name. */
					esc_html__( 'By %s', 'gymat' ),
					esc_html( $active_plugin_list['Author'] )
				);
			endif;
			echo '</td>';

			echo '<td></td>';
			echo '</tr>';
		endforeach;
		?>
		</tbody>
	</table>


	<table class="demo-importer-status-table widefat">
		<thead>
		<tr>
			<th><?php esc_html_e( 'Inactive Plugins', 'gymat' ); ?></th>
			<th></th>
			<th></th>
		</tr>
		</thead>
		<tbody>
		<?php
		$inactive_plugin_lists = Demo_Importer_Fns::get_inactive_plugins();

		// Display the inactive plugin lists.
		foreach ( $inactive_plugin_lists as $inactive_plugin_list ) :
			echo '<tr>';
			echo '<td>';
			if ( $inactive_plugin_list['PluginURI'] ) :
				$plugin_name = '<a href="' . $inactive_plugin_list['PluginURI'] . '" target="_blank">' . $inactive_plugin_list['Name'] . '</a>';
			else :
				$plugin_name = $inactive_plugin_list['Name'];
			endif;

			if ( $inactive_plugin_list['Version'] ) :
				$plugin_name .= ' - ' . $inactive_plugin_list['Version'];
			endif;

			echo $plugin_name;
			echo '</td>';

			echo '<td>';
			if ( $inactive_plugin_list['Author'] ) :
				printf(
				/* translators: 1. Plugin author name. */
					esc_html__( 'By %s', 'gymat' ),
					esc_html( $inactive_plugin_list['Author'] )
				);
			endif;
			echo '</td>';

			echo '<td></td>';
			echo '</tr>';
		endforeach;
		?>
		</tbody>
	</table>


	<h2><?php esc_html_e( 'Copy &amp; Paste System Status Data', 'gymat' ); ?></h2>

	<div class="demo-importer-status-report">
		<p><?php esc_html_e( 'While creating support request, please provide us the details generated below within the support request. It might help us to debug on the issue more conveniently.', 'gymat' ); ?></p>
		<div id="system-status-report">
			<textarea readonly="readonly"></textarea>
		</div>

		<p class="submit">
			<button id="copy-system-status-report" class="button-primary">
				<?php esc_html_e( 'Copy System Status', 'gymat' ); ?>
			</button>
		</p>
	</div>
</div>
