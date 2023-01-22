<?php
/**
 * Whols Admin.
 *
 * @since 1.0.0
 */

namespace Whols;

/**
 * Admin class.
 */
class Admin {

    /**
     * Admin constructor.
     *
     * @since 1.0.0
     */
    public function __construct() {
        new Admin\Custom_Posts();
        new Admin\Custom_Taxonomies();
        new Admin\Wholesaler_Request_Metabox();
        new Admin\Product_Metabox();
        new Admin\Role_Cat_Metabox();
        new Admin\Product_Category_Metabox();
        new Admin\User_Metabox();
        new Admin\Role_Manager();
        new Admin\Custom_Columns();

        // Bind admin page link to the plugin action link.
        add_filter( 'plugin_action_links_whols/whols.php', array($this, 'action_links_add'), 10, 4 );

        // Admin assets hook into action.
        add_action( 'admin_head', array( $this, 'enqueue_admin_assets' ) );

        // Set settings page as submenu
        add_action( 'admin_menu', array( $this, 'dashboard_menu_tweaks' ), 30 );
    }

    /**
     * Action link add.
     *
     * @since 1.0.0
     */
    function action_links_add( $actions, $plugin_file, $plugin_data, $context ){

        $settings_page_link = sprintf(
            /*
             * translators:
             * 1: Settings label
             */
            '<a href="'. esc_url( get_admin_url() . 'admin.php?page=whols-admin' ) .'">%1$s</a>',
            esc_html__( 'Settings', 'whols' )
        );

        array_unshift( $actions, $settings_page_link );

        return $actions;
    }

    /**
     * Enqueue admin assets.
     *
     * @since 1.0.0
     */
    public function enqueue_admin_assets() {
        $current_screen = get_current_screen();
        
        if ( 
            $current_screen->post_type  == 'whols_user_request' ||
            $current_screen->base == 'toplevel_page_whols-admin' ||
            $current_screen->post_type == 'product' || 
            'user-edit' == $current_screen->base ||  
            $current_screen->taxonomy == 'whols_role_cat'
        ) {
            wp_enqueue_style( 'vex', WHOLS_ASSETS . '/css/vex.css', null, WHOLS_VERSION );
            wp_enqueue_style( 'vex-theme-plain', WHOLS_ASSETS . '/css/vex-theme-plain.css', null, WHOLS_VERSION );
            wp_enqueue_style( 'whols-admin', WHOLS_ASSETS . '/css/admin.css', null, WHOLS_VERSION );
            wp_enqueue_script( 'vex', WHOLS_ASSETS . '/js/vex.combined.min.js', array('jquery'), WHOLS_VERSION );
            wp_enqueue_script( 'whols-admin', WHOLS_ASSETS . '/js/admin.js', array('jquery'), WHOLS_VERSION );

            // inline js for the settings submenu
            $is_whols_setting = isset( $_GET['page'] ) ? sanitize_text_field($_GET['page']) : '';
            $is_whols_setting = $is_whols_setting == 'whols-admin' ? 1 : 0;
            wp_add_inline_script( 'whols-admin', 'var whols_is_settings_page = '. esc_js( $is_whols_setting ) .';');
        }
    }

    /**
     * Set settings page as submenu
     *
     * @since 1.0.0
     */
    function dashboard_menu_tweaks(){
        global $menu, $submenu;
        $capabilities = whols_get_capabilities();
        
        $query = new \WP_Query(array(
            'post_type' => 'whols_user_request',
            'meta_query' => array(
                'relation' => 'AND',
                 array(
                    'key'     => 'whols_user_request_meta',
                    'value'   => serialize('approve'),
                    'compare' => 'NOT LIKE',
                 ),
                 array(
                    'key'     => 'whols_user_request_meta',
                    'value'   => serialize('reject'),
                    'compare' => 'NOT LIKE',
                 ),
               ),
        ));

        $pending_request_count = $query->post_count;
        wp_reset_postdata();
        
        if($pending_request_count > 0){
            $menu[56][0] = 'Whols <span class="update-plugins whols_request_count"><span>'. $pending_request_count .'</span></span>';
        }

        add_submenu_page( 'whols-admin', esc_html__('Whols Admin', 'whols'), esc_html__( 'Settings', 'whols' ), $capabilities['manage_settings'],'admin.php?page=whols-admin', '', 0);
    }
}