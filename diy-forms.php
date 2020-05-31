<?php

/**
 * Plugin Name: DIY Forms
 * Plugin URI: https://darisstrickland.com/diy-forms
 * GitHub Plugin URI: https://github.com/strickdj/diy-forms
 * Description: A lightweight form builder / processor for WordPress
 * Author: Daris Strickland
 * Author URI: http://darisstrickland.com
 * Version: 0.0.1
 * Text Domain: diyforms
 * Domain Path: /languages/
 * Requires at least: 5.4
 * Tested up to: 5.4
 * Requires PHP: 7.0
 * License: GPL-3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 *
 * @package  DIYForms
 * @category Plugin
 * @author   Daris Strickland
 * @version  0.0.1
 */


// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

// Plugin version.
if (!defined('DIYFORMS_VERSION')) {
    define('DIYFORMS_VERSION', '0.0.1');
}

// Plugin Folder Path.
if (!defined('DIYFORMS_PLUGIN_DIR')) {
    define('DIYFORMS_PLUGIN_DIR', plugin_dir_path(__FILE__));
}

// Plugin Folder URL.
if (!defined('DIYFORMS_PLUGIN_URL')) {
    define('DIYFORMS_PLUGIN_URL', plugin_dir_url(__FILE__));
}

// Plugin Root File.
if (!defined('DIYFORMS_PLUGIN_FILE')) {
    define('DIYFORMS_PLUGIN_FILE', __FILE__);
}

// Plugin textdomain
if (!defined('DIYFORMS_TEXT_DOMAIN')) {
    define('DIYFORMS_TEXT_DOMAIN', 'diyforms');
}

// autoloading
if (!defined('DIYFORMS_AUTOLOAD')) {
    define('DIYFORMS_AUTOLOAD', true);
}


if (!class_exists('DIYForms')) :

    /**
     * DIYForms class singleton thingy
     */
    final class DIYForms
    {
        /**
         * Stores the instance of the DIYForms class
         *
         * @var DIYForms
         * @since  0.0.1
         */
        private static $instance;

        /**
         * The instance of the WPGraphQL object
         *
         * @return object|DIYForms
         * @since  0.0.1
         */
        public static function instance()
        {
            if (!isset(self::$instance) && !(self::$instance instanceof DIYForms)) {
                self::$instance = new DIYForms();
                self::$instance->includes();
                self::$instance->actions();
                self::$instance->filters();
            }

            return self::$instance;
        }

        /**
         * Function to execute when the user activates the plugin.
         *
         * @since  0.0.1
         */
        public function activate()
        {
            update_option('diyforms_version', DIYFORMS_VERSION, 'no');
        }

        /**
         * Function to execute when the user deactivates the plugin.
         *
         * @since  0.0.1
         */
        public function deactivate()
        {
            delete_option('diyforms_version');
        }

        /**
         * Include required files.
         * Uses composer's autoload
         *
         * @since  0.0.1
         * @return void
         */
        private function includes() {
            if ( defined( 'DIYFORMS_AUTOLOAD' ) && true === DIYFORMS_AUTOLOAD ) {
                require_once DIYFORMS_PLUGIN_DIR . 'vendor/autoload.php';
            }
        }

        /**
         * Register WordPress Actions
         *
         * @since  0.0.1
         * @return void
         */
        private function actions() {}

        /**
         * Register WordPress Filters
         *
         * @since  0.0.1
         * @return void
         */
        private function filters() {}

    }
endif;

if (!function_exists('diyforms_init')) {
    /**
     * Pluggable Function that instantiates the plugins main class
     *
     * @since 0.0.1
     */
    function diyforms_init()
    {
        return \DIYForms::instance();
    }
}

diyforms_init();
