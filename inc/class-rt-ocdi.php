<?php
/**
 * Demo Importer Init.
 *
 * Init class used for installing demo packs using OCDI.
 *
 * @package RadiusTheme\RT_OCDI
 */

// Do not allow directly accessing this file.
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Demo Importer Init.
 */
class RT_OCDI {
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
	 * @return void
	 */
	public function init() {
		// If OCDI plugin is not active, return.
		if ( ! RT_OCDI_Helpers::is_ocdi_active() ) {
			return;
		}

		// Init Classes.
		$this->init_classes();

		if ( wp_get_theme()->get( 'Name' ) !== $this->data['theme'] ) {
			return;
		}

		// Init Hooks.
		$this->init_hooks();
	}

	/**
	 * Initializes the necessary classes for the demo importer.
	 *
	 * @return void
	 */
	public function init_classes() {
		$classes = [
			RT_OCDI_Theme_Config::class,
			RT_OCDI_System_Status::class,
			RT_OCDI_Import_Actions::class,
			RT_OCDI_Deactivate_Notice::class,
		];

		foreach ( $classes as $class ) {
			if ( method_exists( $class, 'get_import_data' ) ) {
				$this->data = ( new $class() )->get_import_data();
			} else {
				( new $class() )->init();
			}
		}
	}

	/**
	 * Initializes the necessary hooks for the demo importer, including scripts, filters, and actions.
	 *
	 * @return void
	 */
	public function init_hooks() {
		// Scripts.
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_backend_scripts' ] );

		// Recommended Plugins.
		add_filter( 'ocdi/register_plugins', [ $this, 'recommended_plugins' ] );

		// Import files.
		add_filter( 'ocdi/import_files', [ $this, 'import_files' ] );

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
		if ( ( 'appearance_page_' . $this->page === $hook ) || ( 'appearance_page_rt-demo-importer-status' === $hook ) ) {
			wp_enqueue_style( 'rt-ocdi-importer', plugin_dir_url( dirname( __FILE__ ) ) . 'assets/css/rt-importer.css', '', '1.0.0' );
			wp_enqueue_script( 'rt-ocdi-importer', plugin_dir_url( dirname( __FILE__ ) ) . 'assets/js/rt-importer.js', [ 'jquery' ], '1.0.0', true );
		}
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
	 * Returns a custom HTML block to be added to the plugin intro text.
	 *
	 * @return string HTML code for the custom intro text.
	 */
	public function intro_text() {
		ob_start();
		?>
		<div class="ocdi__intro-text">
			<div class="col intro-text-col">
				<p class="about-description">Please note that importing demo data should not result in any data loss, but it is recommended to use one-click demo data to set up a new website. In case the one-click demo import does not work, you can try manual demo import.</p>
			</div>
			<div class="col intro-btn-col">
				<div class="btn-wrapper">
					<a class="button button-primary" href="<?php echo esc_url( $this->data['import_doc_link'] ); ?>" target="_blank">Check Documentation</a>
					<a class="button button-primary" href="<?php echo esc_url( admin_url( 'themes.php?page=rt-demo-importer-status' ) ); ?>">Check System Status</a>
				</div>
			</div>
		</div>
		<?php
		return ob_get_clean();
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

		if ( $pagenow === 'themes.php' && isset( $_GET['page'] ) && ( $this->page === $_GET['page'] || 'rt-demo-importer-status' === $_GET['page'] ) ) {
			remove_all_actions( 'admin_notices' );
		}
	}
}
