<?php

/**
 * Plugin Name: DevTest
 * Plugin URI: http://www.example.com/
 * Description: A plugin for testing tests.
 * Version: 1.0
 * Author: John Doe
 */

// You can modify this plugin as you need to achieve the following features:

// 1. Add a new menu item to the admin menu for this plugin, and just print 'Hello World' on that page.

// 2. Set a minimum cart quantity of 2 for product id 16 (Long Sleeve Tee).

// 3. Add a discount of 10% on all products for user id 1.

// 4. Enqueue devtest.js and continue the challenge there.

// ensure the wp environment is loaded properly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'DevUser_CodeChallenge_Plugin' ) ) {

	class DevUser_CodeChallenge_Plugin {

		/**
		 * Stores the instance of the DevUser_CodeChallenge_Plugin class
		 *
		 * @var Object $instance
		 * @access private
		 */
		private static $instance;

		/**
		 * Retrieves the instance of the DevUser_CodeChallenge_Plugin class
		 *
		 * @access public
		 * @return Object|DevUser_CodeChallenge_Plugin
		 */
		public static function instance() {

			/**
			 * Make sure we are only instantiating the class once
			 */
			if ( ! isset( self::$instance ) ) {
				self::$instance = new DevUser_CodeChallenge_Plugin();
				self::$instance::setup_constants();
				self::$instance->includes();
				self::$instance->run();
			}

			/**
			* Action that fires after we are done setting things up in the plugin. Extensions of
			* this plugin should instantiate themselves on this hook to make sure the framework
			* is available before they do anything.
			*
			* @param object $instance Instance of the current DevUser_CodeChallenge_Plugin class
			*/
			do_action( 'devuser_codechallenge_plugin_init', self::$instance );

			return self::$instance;
		}

		/**
		* Sets up the constants for the plugin to use
		*
		* @access public
		* @return void
		*/
		public static function setup_constants() {

			// Plugin version.
			if ( ! defined( 'DEVTEST_VERSION' ) ) {
				define( 'DEVTEST_VERSION', '0.1.0' );
			}

			// Plugin Folder Path.
			if ( ! defined( 'DEVTEST_PLUGIN_DIR' ) ) {
				define( 'DEVTEST_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
			}

			// Plugin Folder URL.
			if ( ! defined( 'DEVTEST_PLUGIN_URL' ) ) {
				define( 'DEVTEST_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
			}

			// Plugin Root File.
			if ( ! defined( 'DEVTEST_PLUGIN_FILE' ) ) {
				define( 'DEVTEST_PLUGIN_FILE', __FILE__ );
			}

		}

		/**
		* Load the autoloaded files as well as the access functions
		*
		* @access private
		* @return void
		* @throws Exception
		*/
		private function includes() {

			if ( file_exists( DEVTEST_PLUGIN_DIR . 'vendor/autoload.php' ) ) {
				require_once( DEVTEST_PLUGIN_DIR . 'vendor/autoload.php' );
			} else {
				throw new Exception( __( 'The autoloader could not be found, send help!', 'dev-test' ) );
			}

		}

		/**
		* Instantiate the main classes we need for the plugin
		*
		* @access private
		* @return void
		*/
		private function run() {

			// $assets = new \DevUser_CodeChallenge_Plugin\Assets();
			// $assets->setup();

			$admin_setup = new \DevTest\Admin();
			$admin_setup->init();

            $assets = new \DevTest\Assets();
			$assets->init();

            $customizationsWoo = new \DevTest\CustomizationsWoo();
			$customizationsWoo->init();

			

		}

	}

}

/**
* Function to instantiate the DevTest plugin
*
* @return object|DevUser_CodeChallenge_Plugin Instance of the DevUser_CodeChallenge_Plugin object
* @access public
*/
function devuser_codechallenge_plugin_init() {
	return DevUser_CodeChallenge_Plugin::instance();
}

/**
* Hook into the after_theme_setup hook
*/
add_action( 'plugins_loaded', 'devuser_codechallenge_plugin_init' );
