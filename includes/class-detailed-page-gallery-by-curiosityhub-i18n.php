<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://shebinkp.co.in/
 * @since      1.0.0
 *
 * @package    Detailed_Page_Gallery_By_Curiosityhub
 * @subpackage Detailed_Page_Gallery_By_Curiosityhub/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Detailed_Page_Gallery_By_Curiosityhub
 * @subpackage Detailed_Page_Gallery_By_Curiosityhub/includes
 * @author     Shebin KP <shebinkp7@gmail.com>
 */
class Detailed_Page_Gallery_By_Curiosityhub_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'detailed-page-gallery-by-curiosityhub',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
