<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://shebinkp.co.in/
 * @since             1.0.0
 * @package           Detailed_Page_Gallery_By_Curiosityhub
 *
 * @wordpress-plugin
 * Plugin Name:       detailed page gallery by curiosityhub
 * Plugin URI:        https://curiosityhub.in/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Shebin KP
 * Author URI:        https://shebinkp.co.in/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       detailed-page-gallery-by-curiosityhub
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
define( 'DETAILED_PAGE_GALLERY_BY_CURIOSITYHUB_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-detailed-page-gallery-by-curiosityhub-activator.php
 */
function activate_detailed_page_gallery_by_curiosityhub() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-detailed-page-gallery-by-curiosityhub-activator.php';
	Detailed_Page_Gallery_By_Curiosityhub_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-detailed-page-gallery-by-curiosityhub-deactivator.php
 */
function deactivate_detailed_page_gallery_by_curiosityhub() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-detailed-page-gallery-by-curiosityhub-deactivator.php';
	Detailed_Page_Gallery_By_Curiosityhub_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_detailed_page_gallery_by_curiosityhub' );
register_deactivation_hook( __FILE__, 'deactivate_detailed_page_gallery_by_curiosityhub' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-detailed-page-gallery-by-curiosityhub.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_detailed_page_gallery_by_curiosityhub() {

	$plugin = new Detailed_Page_Gallery_By_Curiosityhub();
	$plugin->run();

}
run_detailed_page_gallery_by_curiosityhub();
