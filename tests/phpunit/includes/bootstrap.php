<?php
/**
 * BP Registration Options Unit Test Bootstrap
 * @package    BP Registration Options.
 * @subpackage Tests
 * @author     WebDevStudios
 * @license    http://www.gnu.org/licenses/agpl.txt GNU AGPL v3.0
 */

ini_set( 'display_errors', 'on' );
error_reporting( E_ALL );

if ( ! defined( 'BP_TESTS_DIR' ) ) {
	// Apologies. Specific to Michael's setup. Git checkout located in wp-content.
	define( 'BP_TESTS_DIR', __DIR__ . '/../../../../../buddypress-git-trunk/tests' );
}

if ( ! defined( 'BBP_TESTS_DIR' ) ) {
	// Apologies. Specific to Michael's setup. Git checkout located in wp-content.
	define( 'BBP_TESTS_DIR', __DIR__ . '/../../../../../bbpress/tests' );
}

/**
 * Set `WP_TESTS_DIR` to the base directory of WordPress:
 * `svn export http://develop.svn.wordpress.org/trunk/ /tmp/wordpress-tests`
 * Then add this to your bash environment:
 * export WP_TESTS_DIR=/tmp/wordpress/tests
 */
if ( ! $wp_test_dir = getenv( 'WP_TESTS_DIR' ) ) {

	$wp_test_dir = '/tmp/wordpress-tests-lib';

	if ( ! file_exists( $wp_test_dir . '/includes' ) ) {
		die( "Fatal Error: Could not find the WordPress tests directory.\n" );
	}
}

/**
 * Loads WP utility functions like `tests_add_filter` and `_delete_all_posts`.
 */
require_once $wp_test_dir . '/includes/functions.php';

/**
 * Preset wp_options before loading the WordPress stack.
 * Used to activate themes, plugins, as well as other settings in `wp_options`.
 * @see wp_tests_options
 */
$GLOBALS['wp_tests_options'] = array(
	'active_plugins' => array(
		'hello.php',
	),
);

/**
 * Run custom functionality after mu-plugins are loaded.
 */
function _tests_load_bp_registration_options() {

	// Load BuddyPress.
	require BP_TESTS_DIR . '/phpunit/includes/loader.php';

	// Load BuddyPress.
	require BBP_TESTS_DIR . '/phpunit/includes/loader.php';

	define( 'BPRO_DIRECTORY_PATH', trailingslashit( dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) ) );
	// Load BPRO.
	require BPRO_DIRECTORY_PATH . 'loader.php';
}
tests_add_filter( 'muplugins_loaded', '_tests_load_bp_registration_options' );

/**
 * Bootstraps the WordPress stack.
 */
require $wp_test_dir . '/includes/bootstrap.php';
