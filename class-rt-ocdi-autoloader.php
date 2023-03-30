<?php
/**
 * RT OCDI Demo Importer Autoload
 *
 * Core class used for locating and loading other class-files.
 *
 * @package RadiusTheme\RT_OCDI
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * RT OCDI Demo Importer Autoload
 */
class RT_OCDI_Autoloader {
	/**
	 * Directory Paths.
	 *
	 * @var array $directories Required directory Paths.
	 */
	private $directories = [
		'inc',
	];

	/**
	 * Autoload.
	 *
	 * @return void
	 */
	public function register() {
		spl_autoload_register( [ $this, 'autoload_class' ] );
	}

	/**
	 * The class autoloader.
	 * Finds the path to a class that we're requiring and includes the file.
	 *
	 * @param string $class The name of the class we're trying to load.
	 * @return true|void
	 */
	private function autoload_class( $class ) {
		if ( 0 !== strpos( $class, 'RT_OCDI' ) ) {
			return;
		}

		foreach ( $this->directories as $key => $directory ) {
			$abs_dir = trailingslashit( dirname( __FILE__ ) . DIRECTORY_SEPARATOR . $directory );
			$file    = $abs_dir . strtolower( str_replace( '_', '-', "class-$class.php" ) );

			if ( file_exists( $file ) ) {
				include_once wp_normalize_path( $file );
				return true;
			}
		}
	}
}

// Autoload Classes.
( new RT_OCDI_Autoloader() )->register();

// Init Demo Importer.
( new RT_OCDI() )->init();
