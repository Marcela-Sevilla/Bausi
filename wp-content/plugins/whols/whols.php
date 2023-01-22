<?php
/**
 * Plugin Name: Whols - WooCommerce Wholesale Prices
 * Plugin URI:  https://plugins.hasthemes.com/whols/demo/create-sandbox/
 * Description: This plugin provides all the necessary features that you will ever need to sell wholesale products from your WooCommerce online store.
 * Version:     1.1.7
 * Author:      HasThemes
 * Author URI:  https://hasthemes.com
 * License:     GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: whols
 * Domain Path: /languages
 */

// If this file is accessed directly, exit
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Main Whols class
 *
 * @since 1.0.0
 */

final class Whols_Lite {

    /**
     * Whols version
     *
     * @since 1.0.0
     */
    public $version = '1.1.7';

    /**
     * The single instance of the class
     *
     * @since 1.0.0
     */
    protected static $_instance = null;

    /**
     * Main Whols Instance
     *
     * Ensures only one instance of Whols is loaded or can be loaded
     *
     * @since 1.0.0
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Whols Constructor
     *
     * @since 1.0.0
     */
    private function __construct() {
        $this->define_constants();
        $this->includes();
        $this->run();
    }

    /**
     * Define the required constants
     *
     * @since 1.0.0
     */
    private function define_constants() {
        define( 'WHOLS_VERSION', $this->version );
        define( 'WHOLS_FILE', __FILE__ );
        define( 'WHOLS_PATH', __DIR__ );
        define( 'WHOLS_URL', plugins_url( '', WHOLS_FILE ) );
        define( 'WHOLS_ASSETS', WHOLS_URL . '/assets' );
    }

    /**
     * Include files
     *
     * @since 1.0.0
     */
    public function includes() {
        /**
         * Load files
         */
        require_once WHOLS_PATH . '/includes/functions.php';

        if ( ! class_exists( 'CSF' ) ) {
            require_once WHOLS_PATH .'/includes/Admin/settings/classes/setup.class.php';
        }

        require_once WHOLS_PATH . '/includes/Admin.php';
        require_once WHOLS_PATH . '/includes/Admin/Custom_Posts.php';
        require_once WHOLS_PATH . '/includes/Admin/Custom_Taxonomies.php';
        require_once WHOLS_PATH . '/includes/Admin/Wholesaler_Request_Metabox.php';
        require_once WHOLS_PATH . '/includes/Admin/Product_Metabox.php';
        require_once WHOLS_PATH . '/includes/Admin/User_Metabox.php';
        require_once WHOLS_PATH . '/includes/Admin/Global_Settings.php';
        require_once WHOLS_PATH . '/includes/Admin/Role_Cat_Metabox.php';
        require_once WHOLS_PATH . '/includes/Admin/Product_Category_Metabox.php';
        require_once WHOLS_PATH . '/includes/Admin/Role_Manager.php';
        require_once WHOLS_PATH . '/includes/Admin/Custom_Columns.php';
        require_once WHOLS_PATH . '/includes/Admin/recommended-plugins/class.recommended-plugins.php';
        require_once WHOLS_PATH . '/includes/Admin/recommended-plugins/recommendations.php';

        require_once WHOLS_PATH . '/includes/Frontend.php';
        require_once WHOLS_PATH . '/includes/Frontend/Wholesaler_Login_Register.php';

        require_once WHOLS_PATH . '/includes/woo-config.php';
        require_once WHOLS_PATH . '/includes/ajax-actions.php';

        require_once WHOLS_PATH . '/includes/Email_Notifications.php';

        /**
         * Including plugin file for secutiry purpose
         */
        if ( ! function_exists( 'is_plugin_active' ) ) {
            include_once ABSPATH . 'wp-admin/includes/plugin.php';
        }
    }

    /**
     * First initialization of the plugin
     *
     * @since 1.0.0
     */
    private function run() {
        register_activation_hook( __FILE__, array( $this, 'register_activation_hook_cb' ) );

        if ( ! is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
            add_action( 'admin_notices', array( $this, 'build_dependencies_notice' ) );
        } else {
            // Set up localisation.
            add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ) );

            // Finally initialize this plugin
            add_action( 'plugins_loaded', array( $this, 'init' ) );
        }
    }

    /**
     * Do stuff upon plugin activation
     *
     * @since 1.0.0
     */
    public function register_activation_hook_cb() {
        // deactivate the pro plugin if active
        if ( ! function_exists('is_plugin_active') ){ 
            include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        }

        if( is_plugin_active('whols-pro/whols-pro.php') ){
            add_action('update_option_active_plugins', function(){
                deactivate_plugins('whols-pro/whols-pro.php');
            });
        }

        $installed = get_option( 'whols_installed' );

        if ( ! $installed ) {
            update_option( 'whols_installed', time() );
        }

        update_option( 'whols_version', WHOLS_VERSION );
    }

    /**
     * Load the plugin textdomain
     *
     * @since 1.0.0
     */
    public function load_plugin_textdomain() {
        load_plugin_textdomain( 'whols', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
    }

    /**
     * Initialize this plugin
     *
     * @since 1.0.0
     */
    public function init() {
        new Whols\Admin\Global_Settings();

        if ( is_admin() ) {
            new Whols\Admin();
        } else if( whols_get_option('enable_wholesale_store') ) {
            new Whols\Frontend();
        }
    }

    /**
     * Output a admin notice when build dependencies not met
     *
     * @since 1.0.0
     */
    public function build_dependencies_notice() {
        $message = sprintf(
            /*
             * translators:
             * 1: Whols.
             * 2: WooCommerce.
             */
            esc_html__( '%1$s plugin requires the %2$s plugin to be installed and activated in order to work.', 'whols' ),
            '<strong>' . esc_html__( 'Whols', 'whols' ) . '</strong>',
            '<strong>' . esc_html__( 'WooCommerce', 'whols' ) . '</strong>'
        );

        printf( '<div class="notice notice-warning"><p>%1$s</p></div>', $message );
    }

}

/**
 * Returns the main instance of Whols
 *
 * @since 1.0.0
 */

function whols_lite() { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.FunctionNameInvalid
    return Whols_Lite::instance();
}

// Kick-off the plugin
whols_lite();