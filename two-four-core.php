<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://gitlab.com/two-four/
 * @since             1.0.0
 * @package           Two_Four_Core
 *
 * @wordpress-plugin
 * Plugin Name:       Two Four Core
 * Plugin URI:        https://gitlab.com/two-four/core
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Two Four
 * Author URI:        https://gitlab.com/two-four/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       two-four-core
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
define( 'TWO_FOUR_CORE_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-two-four-core-activator.php
 */
function activate_two_four_core() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-two-four-core-activator.php';
	Two_Four_Core_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-two-four-core-deactivator.php
 */
function deactivate_two_four_core() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-two-four-core-deactivator.php';
	Two_Four_Core_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_two_four_core' );
register_deactivation_hook( __FILE__, 'deactivate_two_four_core' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-two-four-core.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_two_four_core() {

	$plugin = new Two_Four_Core();
	$plugin->run();

}
run_two_four_core();
