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

/**
 * Autoloader init
 */
if ( file_exists( DKWP_PLUGIN_DIR . 'vendor/autoload.php' ) ) {
	require_once DKWP_PLUGIN_DIR . 'vendor/autoload.php';
}

/**
 * Plugins loaded action
 *
 * @return void
 */
function hbelv_plugins_loaded() {
	load_plugin_textdomain( 'hbelv', false, dirname( plugin_basename( __FILE__ ) ) . '/lang' );
}

add_action( 'plugins_loaded', 'dkwp_plugins_loaded' );