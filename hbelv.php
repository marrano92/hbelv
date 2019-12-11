<?php
/*
Plugin Name: Hbelv
Plugin URI: https://hotelilbelvedere.com
Description: Engine for Hotel il Belvedere WordPress-powered
Version: 0.1
Author: marrano92
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: hbelv
*/

/********************************
 * Globals definitions *
 *******************************/

defined( 'ABSPATH' ) || die( 'Error 403: Access Denied/Forbidden!' );
defined( 'HOUR_IN_SECONDS' ) || define( 'HOUR_IN_SECONDS', 3600 );
define( 'HBELV_PLUGIN_DIR', ( function_exists( 'plugin_dir_path' ) ? plugin_dir_path( __FILE__ ) : __DIR__ . '/' ) );

/**
 * Autoloader init
 */
if ( file_exists( HBELV_PLUGIN_DIR . 'vendor/autoload.php' ) ) {
	require_once HBELV_PLUGIN_DIR . 'vendor/autoload.php';
}

/**
 * Shorthand for a PluginOptions instance
 *
 * @return \Hbelv\PluginOptions
 */
function options_factory() {
	$locale = \Hbelv\Locale::create();

	return \Hbelv\PluginOptions::create( $locale );
}

/**
 * Init action
 *
 * @return void
 */
add_action( 'init', function () {
	/**
	 * WP actions removal
	 */
	remove_action( 'wp_head', 'rest_output_link_wp_head' );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );
	remove_action( 'template_redirect', 'rest_output_link_header', 11 );

	/**
	 * Plugin builders
	 */
	\Hbelv\Cpt\Builder::init();
	\Hbelv\Route\Builder::init();
});

/**
 * Admin menu action
 *
 * @return void
 */
add_action( 'admin_menu', function () {
	\Hbelv\OptionsPage::init( options_factory() );
} );
