<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.lovrohrust.com.hr
 * @since             1.0.0
 * @package           Ntg_Cookie_Consent
 *
 * @wordpress-plugin
 * Plugin Name:       Cookie consent for developers
 * Plugin URI:        
 * Description:       Give user a choice to control cookie or similar technology usage from your and third party sites
 * Version:           1.0.0
 * Author:            Lovro Hrust
 * Author URI:        http://www.lovrohrust.com.hr
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ntg-cookie-consent
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
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-ntg-cookie-consent-activator.php
 */
function activate_ntg_cookie_consent() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ntg-cookie-consent-activator.php';
	Ntg_Cookie_Consent_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-ntg-cookie-consent-deactivator.php
 */
function deactivate_ntg_cookie_consent() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ntg-cookie-consent-deactivator.php';
	Ntg_Cookie_Consent_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_ntg_cookie_consent' );
register_deactivation_hook( __FILE__, 'deactivate_ntg_cookie_consent' );


/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-ntg-cookie-consent.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_ntg_cookie_consent() {

	$plugin = new Ntg_Cookie_Consent();
	$plugin->run();

}
run_ntg_cookie_consent();