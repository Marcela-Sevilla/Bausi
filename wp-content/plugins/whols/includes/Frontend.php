<?php
/**
 * Whols Frontend
 *
 * @since 1.0.0
 */

namespace Whols;

/**
 * Frontend class.
 */
class Frontend {

    /**
     * Frontend constructor.
     *
     * @since 1.0.0
     */
    public function __construct() {
        new Frontend\Wholesaler_Login_Register();

        // Admin assets hook into action.
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_frontend_assets' ) );
    }

    /**
     * Enqueue frontend assets
     *
     * @since 1.0.0
     */
    public function enqueue_frontend_assets() {
        // Scripts
        $suffix = \Automattic\Jetpack\Constants::is_true( 'SCRIPT_DEBUG' ) ? '' : '.min';
        wp_enqueue_script( 'serializejson', WC()->plugin_url() . '/assets/js/jquery-serializejson/jquery.serializejson' . $suffix . '.js', array( 'jquery' ), '2.8.1' );

        wp_enqueue_style( 'whols-style', WHOLS_ASSETS . '/css/style.css', null, WHOLS_VERSION );
    }
}