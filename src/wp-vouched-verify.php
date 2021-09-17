<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/bcolemutech
 * @since             1.0.0
 * @package           Wp_Vouched_Verify
 *
 * @wordpress-plugin
 * Plugin Name:       WP Vouched Verify
 * Plugin URI:        https://bcolemutech.github.io/wp-vouched-verify/
 * Description:       WordPress plugin using Vouched to validate users and ensure users have a single account.
 * Version:           [SEMVER]
 * Author:            Brian Cole
 * Author URI:        https://github.com/bcolemutech
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-vouched-verify
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WP_VOUCHED_VERIFY_VERSION', '[SEMVER]' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-vouched-verify-activator.php
 */
function activate_wp_vouched_verify() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-vouched-verify-activator.php';
	Wp_Vouched_Verify_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-vouched-verify-deactivator.php
 */
function deactivate_wp_vouched_verify() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-vouched-verify-deactivator.php';
	Wp_Vouched_Verify_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_vouched_verify' );
register_deactivation_hook( __FILE__, 'deactivate_wp_vouched_verify' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-vouched-verify.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_vouched_verify() {

	$plugin = new Wp_Vouched_Verify();
	$plugin->run();

}
run_wp_vouched_verify();
