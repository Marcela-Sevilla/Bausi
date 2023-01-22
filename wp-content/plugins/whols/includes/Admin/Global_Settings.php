<?php
/**
 * Whols Global_Settings
 *
 * @since 1.0.0
 */

namespace Whols\Admin;

/**
 * Global_Settings class
 */
class Global_Settings {

    /**
     * Global_Settings constructor
     *
     * @since 1.0.0
     */
    public function __construct() {
        $this->plugin_global_settings();
    }

    /**
     * All the global settings of this plugin
     *
     * @since 1.0.0
     */
    public function plugin_global_settings() {
        $prefix = 'whols_options';

        $roles = whols_get_taxonomy_terms();
        $price_type_2_tabs_arr = array();

        foreach( $roles as $role_slug => $role ){
            $price_type_2_tabs_arr[] =  array(
                'title'  => $role,
                'fields' => array(
                    // enable this pricing
                    array(
                        'id'         => $role_slug. '__enable_this_pricing',
                        'type'       => 'switcher',
                        'title'      => esc_html__( 'Enable This Pricing', 'whols'),
                        'text_on'    => esc_html__( 'Yes', 'whols' ),
                        'text_off'   => esc_html__( 'No', 'whols' ),
                    ),

                    // price type
                    array(
                        'id'          => $role_slug. '__price_type',
                        'type'        => 'select',
                        'title'       => esc_html__( 'Price Type', 'whols'),
                        'options'     => array(
                            'flat_rate'     => esc_html__( 'Flat Rate', 'whols' ),
                            'percent'       => esc_html__( 'Percentage', 'whols' ),
                        ),
                    ),

                    // price value
                    array(
                        'id'    => $role_slug. '__price_value',
                        'type'  => 'text',
                        'title' => esc_html__( 'Price Value', 'whols' ),
                        'attributes'  => array(
                            'type'      => 'number',
                        ),
                    ),

                    // minimum quantity
                    array(
                        'id'    => $role_slug. '__minimum_quantity',
                        'type'  => 'text',
                        'title' => esc_html__( 'Minimum Quantity', 'whols' ),
                        'attributes'  => array(
                            'type'      => 'number',
                        ),
                    ),
                ),
            );
        }

        // titles with help image
        $retailer_price_options_title = sprintf(
            /*
             * translators:
             * 1: label
             */
            '%1$s <i class="dashicons-before dashicons-editor-help"></i><img class="whols_help_image" src="'. WHOLS_ASSETS .'/images/retailer-price-help-image.jpg">',
            esc_html__( 'Retailer Price Label', 'whols' )
        );

        $wholesaler_price_options_title = sprintf(
            /*
             * translators:
             * 1: label
             */
            '%1$s <i class="dashicons-before dashicons-editor-help"></i><img class="whols_help_image" src="'. WHOLS_ASSETS .'/images/wholesale-price-help-image.jpg">',
            esc_html__( 'Wholesaler Price Label', 'whols' )
        );

        $discount_label_options_title = sprintf(
            /*
             * translators:
             * 1: label
             */
            '%1$s <i class="dashicons-before dashicons-editor-help"></i><img class="whols_help_image" src="'. WHOLS_ASSETS .'/images/save-price-help-image.jpg">',
            esc_html__( 'Discount Label', 'whols' )
        );

        $capabilities = whols_get_capabilities();

        // Create Settings Wrapper
        \CSF::createOptions( $prefix, array(
            'menu_title'         => esc_html__( 'Whols', 'whols' ),
            'menu_slug'          => 'whols-admin',
            'menu_icon'          => 'dashicons-money-alt',
            'menu_capability'    => $capabilities['manage_settings'],
            'framework_title'    => esc_html__( 'WooCommerce Wholesale Price Settings', 'whols' ),
            'theme'              => 'light',
            'sticky_header'      => false,
            'class'              => 'whols_global_options',
            'show_sub_menu'      => false,
            'menu_position'      => 56,
            'show_search'        => false,
            'show_reset_all'     => true,
            'show_reset_section' => true,
            'show_bar_menu'      => false,
            'footer_credit'      => esc_html__('Made with Love by HasThemes', 'whols'),
            'defaults'           => array(
                'pricing_model'           => 'single_role',
                'price_type_1_properties' => array(
                    'enable_this_pricing' => '',
                    'price_type'          => 'flat_rate',
                    'price_value'         => '',
                    'minimum_quantity'    => '',
                ),
                'price_type_2_properties'   => array(
                    'whols_default_role__enable_this_pricing' => '',
                    'whols_default_role__price_type'          => 'flat_rate',
                    'whols_default_role__price_value'         => '',
                    'whols_default_role__minimum_quantity'    => '',
                ),
                'retailer_price_options' => array(
                    'hide_retailer_price'         => '',
                    'retailer_price_custom_label' => '',
                ),
                'wholesaler_price_options'  => array(
                    'hide_wholesaler_price'         => '',
                    'wholesaler_price_custom_label' => '',
                ),
                'discount_label_options' => array(
                    'hide_discount_percent'         => '',
                    'discount_percent_custom_label' => ''
                ),
                'lgoin_to_see_price_label'                                 => '',
                'hide_wholesale_only_products_from_other_customers'             => '',
                'hide_general_products_from_wholesalers'                   => '',
                'default_wholesale_role'                                   => 'whols_default_role',
                'enable_auto_approve_customer_registration'                => '',
                'registration_successful_message_for_auto_approve'         => 'Thank you for registering.',
                'registration_successful_message_for_manual_approve'       => 'Thank you for registering. Your account will be reviewed by us & approve manually. Please wait to be approved.',
                'redirect_page_customer_registration'                      => '',
                'redirect_page_customer_login'                             => '',
                'hide_price_for_guest_users'                               => '',
                'enable_website_restriction'                               => '',
                'who_can_access_shop'                                      => 'everyone',
                'who_can_access_entire_website'                            => 'everyone',
                'disable_coupon_for_wholesale_customers'                   => '',
                'disable_specific_payment_gateway_for_wholesale_customers' => '',
                'allow_free_shipping_for_wholesale_customers'              => '',

                'show_wholesale_price_for'            => 'only_wholesalers',
                'exclude_tax_for_wholesale_customers' => '',
                'enable_wholesale_store'              => '1',
            )
        ) );

        // General Settings Tab
        \CSF::createSection( $prefix, array(
            'title'  => esc_html__( 'General Settings', 'whols' ),
            'fields' => array(

                // enable_wholesale_store
                array(
                    'id'          => 'enable_wholesale_store',
                    'type'        => 'checkbox',
                    'title'       => esc_html__( 'Enable Wholesale Store', 'whols' ),
                    'label'       => esc_html__( 'Yes', 'whols' ),
                ),

                // role type
                array(
                    'id'          => 'pricing_model',
                    'type'        => 'select',
                    'title'       => esc_html__( 'Pricing Model', 'whol' ),
                    'placeholder' => '',
                    'options'     => array(
                        'single_role'       => esc_html__( 'Single Role Based', 'whols' ),
                        'multiple_role'     => esc_html__( 'Multiple Role Based', 'whols' ),
                    ),
                    'after'       => __( '<b>Single Role</b> is useful when you have only one type of wholesaler. <br> <b>Multiple Role</b> is useful when you have different kind of wholesaler and you want different price for each kind of wholesaler.', 'whols' ),
                    'class'       => 'whols_pro',
                ),

                // show wholesale price for
                array(
                    'id'          => 'show_wholesale_price_for',
                    'type'        => 'radio',
                    'title'       => esc_html__( 'Show Wholesale Price For', 'whols' ),
                    'placeholder' => '',
                    'options'     => array(
                        'only_wholesalers' => esc_html__( 'Only Wholesaler Users ', 'whols' ),
                        'all_users'        => esc_html__( 'All Users', 'whols' ),
                    ),
                    'desc'       => __( 'If you choose "Only Wholesaler" plugin will be active for only wholesaler customers. Otherwise plugin will be active for all users. <br>You may use "All Users" option when you want to test the pricing.', 'whols' ),
                ),


                // price type 1 properties
                array(
                  'id'         => 'price_type_1_properties',
                  'type'       => 'fieldset',
                  'title'      => esc_html__( 'Price Options For Pricing Model: Single Role', 'whols' ),
                  'dependency' => array( 'pricing_model', '==', 'single_role' ),
                  'fields'     => array(
                        // enable this pricing
                        array(
                          'id'         => 'enable_this_pricing',
                          'type'       => 'switcher',
                          'title'      => esc_html__( 'Enable This Pricing', 'whols'),
                          'text_on'    => esc_html__( 'Yes', 'whols' ),
                          'text_off'   => esc_html__( 'No', 'whols' ),
                        ),

                        // price type
                        array(
                          'id'          => 'price_type',
                          'type'        => 'select',
                          'title'       => esc_html__( 'Price Type', 'whols'),
                          'options'     => array(
                            'flat_rate'     => esc_html__( 'Flat Rate', 'whols' ),
                            'percent'       => esc_html__( 'Percentage', 'whols' ),
                          ),
                        ),

                        // price value
                        array(
                          'id'    => 'price_value',
                          'type'  => 'text',
                          'title' => esc_html__( 'Price Value', 'whols' ),
                          'attributes'  => array(
                            'type'      => 'number',
                          ),
                          'desc'  => esc_html__('Example: If "Price Type" is set to "Percentage" & if you enter 75. Then product price will be 75% of the existing price & wholesaler will get 25% discount.', 'whols')
                        ),

                        // minimum quantity
                        array(
                          'id'    => 'minimum_quantity',
                          'type'  => 'text',
                          'title' => esc_html__( 'Minimum Quantity', 'whols' ),
                          'attributes'  => array(
                            'type'      => 'number',
                          ),
                          'desc'  => esc_html__('Minimum quantity to purchase to qualify the price. A notice with the "Minimum Quantity" value will be shown with the products', 'whols')
                        ),
                    ),
                  'after' => esc_html__( '(These options can be overridden for each category & product individually.)', 'whols'  ),
                ),

                array(
                    'id'     => 'retailer_price_options',
                    'type'   => 'fieldset',
                    'title'  => $retailer_price_options_title,
                    'fields' => array(
                        // hide retailer price
                        array(
                            'id'       => 'hide_retailer_price',
                            'type'     => 'switcher',
                            'title'    => esc_html__( 'Hide Retailer Price', 'whols'),
                            'text_on'  => esc_html__( 'Yes', 'whols' ),
                            'text_off' => esc_html__( 'No', 'whols' ),
                            'label'    => esc_html__( 'This label will be shown in the product listing/loop of your shop page & product details page.', 'whols'  ),
                        ),
                        // retailer price custom label
                        array(
                            'id'    => 'retailer_price_custom_label',
                            'type'  => 'text',
                            'title' => esc_html__( 'Retailer Price Custom Label', 'whols' ),
                            'after' => esc_html__( 'This label will be shown in the product listing/loop of your shop page & product details page.', 'whols'  ),
                            'dependency'  => array( 'hide_retailer_price', '==', 'false' ),
                        ),
                    ),
                ),

                array(
                    'id'     => 'wholesaler_price_options',
                    'type'   => 'fieldset',
                    'title'  => $wholesaler_price_options_title,
                    'fields' => array(
                        // hide wholesaler price
                        array(
                            'id'       => 'hide_wholesaler_price',
                            'type'     => 'switcher',
                            'title'    => esc_html__( 'Hide Wholesaler Price', 'whols'),
                            'text_on'  => esc_html__( 'Yes', 'whols' ),
                            'text_off' => esc_html__( 'No', 'whols' ),
                            'label'    => esc_html__( 'Hide the wholesaler price which appear into the product listing/loop of your shop page & product details page.', 'whols'  ),
                        ),
                        // wholesaler price custom label
                        array(
                            'id'    => 'wholesaler_price_custom_label',
                            'type'  => 'text',
                            'title' => esc_html__( 'Wholesaler Price Custom Label', 'whols' ),
                            'after' => esc_html__( 'This label will be shown in the product listing/loop of your shop page & product details page.', 'whols'  ),
                            'dependency'  => array( 'hide_wholesaler_price', '==', 'false' ),
                        ),
                    ),
                ),

                array(
                    'id'     => 'discount_label_options',
                    'type'   => 'fieldset',
                    'title'  => $discount_label_options_title,
                    'fields' => array(

                        // show discount %
                        array(
                            'id'       => 'hide_discount_percent',
                            'type'     => 'switcher',
                            'title'    => esc_html__( 'Hide Discount %', 'whols'),
                            'text_on'  => esc_html__( 'Yes', 'whols' ),
                            'text_off' => esc_html__( 'No', 'whols' ),
                            'label'    => esc_html__( 'Enabling this option will hide the discount amount (%) from the product listing/loop of your shop page & product details page', 'whols'  ),
                        ),

                        // discount percent custom label
                        array(
                            'id'    => 'discount_percent_custom_label',
                            'type'  => 'text',
                            'title' => esc_html__( 'Discount Percentage Custom Label', 'whols' ),
                            'after' => esc_html__( 'This label will be shown in the product listing/loop of your shop page & product details page.', 'whols'  ),
                            'dependency'  => array( 'hide_discount_percent', '==', 'false' ),
                        ),
                    ),
                ),
            )
        ) );

        // Product Visibility Settings Tab
        \CSF::createSection( $prefix, array(
            'title'  => esc_html__( 'Product Visibility Settings',  'whols' ),
            'fields' => array(

                // hide wholesale products for from other customers
                array(
                  'id'         => 'hide_wholesale_only_products_from_other_customers',
                  'type'       => 'checkbox',
                  'title'      => esc_html__( 'Hide "Wholesale Only" Products From Visitors & General Customers', 'whols' ),
                  'label'      => esc_html__( 'Enable this option to hide the "Wholesale Only" products from the visitors & general customers. Note: You can mark an individual product as a wholesale product from the "Whols" tab in the product edit screen.'  , 'whols' ),
                ),

                // hide general products from wholesalers
                array(
                  'id'         => 'hide_general_products_from_wholesalers',
                  'type'       => 'checkbox',
                  'title'      => esc_html__( 'Hide "General" Products From Wholesalers', 'whols' ),
                  'label'      => esc_html__( 'Enable this option to hide the "General products" from the wholesalers. Note: "General Product" means the product that has not been marked as a wholesale product from the product edit screen.'  , 'whols' ),
                ),
            )
        ) );

        // Registration Settings Tab
        \CSF::createSection( $prefix, array(
            'title'  => esc_html__( 'Registration & Login',  'whols' ),
            'fields' => array(

                // notice
                array(
                  'type'    => 'notice',
                  'style'   => 'success',
                  'content' => 'Use this shortcode <code>[whols_registration_form]</code> anywhere on a page, to show the wholesaler registration form.',
                ),

                // default wholesale role
                array(
                    'id'          => 'default_wholesale_role',
                    'type'        => 'select',
                    'title'       => esc_html__( 'Default Wholesaler Role', 'whols' ),
                    'options'     => whols_get_taxonomy_terms(),
                    'after'       => esc_html__( 'Select the default role of a wholesaler that will be used for the new wholesaler registration. Note: This option will work when the "Pricing Model" is set to "Multiple Role".', 'whols' ),
                    'class'       => 'whols_pro'
                ),

                // enable auto approve
                array(
                    'id'       => 'enable_auto_approve_customer_registration',
                    'type'     => 'checkbox',
                    'title'    => esc_html__( 'Enable Auto Approve', 'whols'),
                    'label'    => esc_html__( 'Automatically approve new user registration.', 'whols'  ),
                    'class'       => 'whols_pro whols_enable_auto_approve_customer_registration'
                ),

                // successful message
                array(
                    'id'       => 'registration_successful_message_for_auto_approve',
                    'type'     => 'textarea',
                    'title'    => esc_html__( 'Successful Registration Message', 'whols'),
                    'after'    => esc_html__( 'If "Auto Approve" is enabled. Then this message will show into the customer registration page, after a successful wholesaler registration. HTML is allowed.', 'whols'  ),
                    'dependency' => array(
                        'enable_auto_approve_customer_registration', '==', '1'
                    )
                ),

                // successful message
                array(
                    'id'       => 'registration_successful_message_for_manual_approve',
                    'type'     => 'textarea',
                    'title'    => esc_html__( 'Registration Successful Message', 'whols'),
                    'default'  => esc_html__( 'Thank you very much for completing the registration. Your account will be reviewed by us & approved manually. Please wait for a while.', 'whols' ),
                    'after'    => esc_html__( 'Insert a custom message for a successful registration. HTML tags are also allowed. When the "Auto Approve" option is disabled, this message will be shown on the customer registration page after a successful wholesaler registration.', 'whols'  ),
                    'dependency' => array(
                        'enable_auto_approve_customer_registration', '==', '0'
                    )
                ),

                // redirect page
                array(
                    'id'       => 'redirect_page_customer_registration',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Redirect Page URL (After Registration)', 'whols'),
                    'after'    => esc_html__( 'Insert a page URL where you want the users to be redirected after a successful registration. Leave empty if you don\'t want to redirect the users.', 'whols'  ),
                ),

                // redirect page after login
                array(
                    'id'       => 'redirect_page_customer_login',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Redirect Page URL (After Login)', 'whols'),
                    'after'    => esc_html__( 'Insert a page URL where you want the users to be redirected after a successful login. Leave empty for default redirection. Note: Make sure you have entered a page URL of the same domain.', 'whols'  ),
                ),
            )
        ) );

        // Guest Access Restriction Tab
        \CSF::createSection( $prefix, array(
            'title'  => esc_html__( 'Guest Access Restriction',  'whols' ),
            'fields' => array(

                // hide price for guest users
                array(
                    'id'       => 'hide_price_for_guest_users',
                    'type'     => 'switcher',
                    'title'    => esc_html__( 'Hide Price For Guest Users', 'whols'),
                    'text_on'  => esc_html__( 'Yes', 'whols' ),
                    'text_off' => esc_html__( 'No', 'whols' ),
                    'label'    => esc_html__( 'Enable this option to show the price only for those users who are logged in.'  , 'whols'  ),
                ),

                // login to see price label
                array(
                    'id'       => 'lgoin_to_see_price_label',
                    'type'  => 'text',
                    'title' => esc_html__( '"Login To See Price" Label', 'whols' ),
                    'after' => esc_html__( 'This label will be shown in the product listing/loop of your shop page & product details page.', 'whols'  ),
                    'dependency'  => array( 'hide_price_for_guest_users', '==', 'true' ),
                ),

                // enable website restiction for
                array(
                    'id'          => 'enable_website_restriction',
                    'title'       => esc_html__( 'Enable Website Restriction Type', 'whols'),
                    'type'        => 'radio',
                    'options'     => array(
                        ''                   => esc_html__('No Restriction', 'whols'),
                        'for_only_shop'      => esc_html__('For Only Shop', 'whols'),
                        'for_entire_wbesite' => esc_html__('For Entire Website', 'whols')
                    )
                ),

                // who can access shop
                array(
                    'id'          => 'who_can_access_shop',
                    'title'       => esc_html__( 'Who Can Access Shop', 'whols'),
                    'type'        => 'select',
                    'options'     => array(
                        'everyone'                          => esc_html__('Everyone', 'whols'),
                        'logedin_users'                     => esc_html__('Loged In Users', 'whols'),
                        'logedin_users_with_wholesale_role' => esc_html__('Loged In Users With Wholesale Role', 'whols')
                    ),
                    'after'       => esc_html__( 'Define who can access the shop.'  , 'whols' ),
                    'dependency'  => array(
                        'enable_website_restriction', '==', 'for_only_shop'
                    ),
                    'class'       => 'whols_pro whols_who_can_access_shop'

                ),

                // who can access entire website
                array(
                    'id'          => 'who_can_access_entire_website',
                    'title'       => esc_html__( 'Who Can Access Entire Website', 'whols'),
                    'type'        => 'select',
                    'options'     => array(
                        'everyone'                          => esc_html__('Everyone', 'whols'),
                        'logedin_users'                     => esc_html__('Loged In Users', 'whols'),
                        'logedin_users_with_wholesale_role' => esc_html__('Loged In Users With Wholesale Role', 'whols')
                    ),
                    'after'       => esc_html__( 'Define who can access the entire website.'  , 'whols' ),
                    'dependency'  => array(
                        'enable_website_restriction', '==', 'for_entire_wbesite'
                    ),
                    'class'       => 'whols_pro whols_who_can_access_entire_website'
                ),

            )
        ) );

        // Design
        \CSF::createSection( $prefix, array(
            'id'     => 'design',
            'title'  => esc_html__( 'Design', 'whols' ),
            'fields' => array(
                // retailer_price_label
                array(
                    'id'         => 'retailer_price_label',
                    'type'       => 'fieldset',
                    'title'      => esc_html__('Retailer Price Label', 'whols'),
                    'fields'     => array(
                        array(
                            'id'         => 'retailer_price_label_color',
                            'type'       => 'color',
                            'title'      => esc_html__('Color', 'whols'),
                            'output'     => '.whols_retailer_price .whols_label_left'
                        ),
                        array(
                            'id'         => 'retailer_price_label_font_size',
                            'type'       => 'number',
                            'title'      => esc_html__('Font size', 'whols'),
                            'unit'       => 'px',
                            'output'     => '.whols_retailer_price .whols_label_left',
                            'output_mode' => 'font-size'
                        ),
                        array(
                            'id'         => 'retailer_price_label_line_height',
                            'type'       => 'number',
                            'title'      => esc_html__('Line Height', 'whols'),
                            'unit'       => 'px',
                            'output'     => '.whols_retailer_price .whols_label_left',
                            'output_mode' => 'line-height'
                        ),
                        array(
                            'id'         => 'retailer_price_label_font_weight',
                            'type'       => 'number',
                            'title'      => esc_html__('Font Weight', 'whols'),
                            'unit'       => ' ',
                            'output'     => '.whols_loop_custom_price .whols_label .whols_label_left',
                            'output_mode' => 'font-weight',
                            'desc'        => esc_html__('Default: 700', 'whols')
                        ),
                    )
                ),

                // retailer_price_label
                array(
                    'id'         => 'retailer_price',
                    'type'       => 'fieldset',
                    'title'      => esc_html__('Retailer Price', 'whols'),
                    'fields'     => array(
                        array(
                            'id'         => 'retailer_price_color',
                            'type'       => 'color',
                            'title'      => esc_html__('Color', 'whols'),
                            'output'     => '.whols_retailer_price del'
                        ),
                        array(
                            'id'         => 'retailer_price_font_size',
                            'type'       => 'number',
                            'title'      => esc_html__('Font size', 'whols'),
                            'unit'       => 'px',
                            'output'     => '.whols_retailer_price del',
                            'output_mode' => 'font-size'
                        ),
                        array(
                            'id'         => 'retailer_price_line_height',
                            'type'       => 'number',
                            'title'      => esc_html__('Line Height', 'whols'),
                            'unit'       => 'px',
                            'output'     => '.whols_retailer_price del',
                            'output_mode' => 'line-height'
                        ),
                        array(
                            'id'         => 'retailer_price_font_weight',
                            'type'       => 'number',
                            'title'      => esc_html__('Font Weight', 'whols'),
                            'unit'       => ' ',
                            'output'     => '.whols_retailer_price del',
                            'output_mode' => 'font-weight',
                            'desc'        => esc_html__('Default: 400', 'whols')
                        ),
                    )
                ),

                // retailer_price_margin
                array(
                    'id'          => 'retailer_price_margin',
                    'type'        => 'spacing',
                    'title'       => esc_html__('Retialer Price Area Margin', 'whols'),
                    'output'      => '.whols_retailer_price',
                    'output_mode' => 'margin',
                    'top_icon'    => '',
                    'right_icon'  => '',
                    'bottom_icon' => '',
                    'left_icon'   => '',
                ),

                // wholesaler_price_label
                array(
                    'id'         => 'wholesaler_price_label',
                    'type'       => 'fieldset',
                    'title'      => esc_html__('Wholesaler Price Label', 'whols'),
                    'fields'     => array(
                        array(
                            'id'         => 'wholesaler_price_label_color',
                            'type'       => 'color',
                            'title'      => esc_html__('Color', 'whols'),
                            'output'     => '.whols_wholesaler_price .whols_label_left'
                        ),
                        array(
                            'id'         => 'wholesaler_price_label_font_size',
                            'type'       => 'number',
                            'title'      => esc_html__('Font size', 'whols'),
                            'unit'       => 'px',
                            'output'     => '.whols_wholesaler_price .whols_label_left',
                            'output_mode' => 'font-size'
                        ),
                        array(
                            'id'         => 'wholesaler_price_label_line_height',
                            'type'       => 'number',
                            'title'      => esc_html__('Line Height', 'whols'),
                            'unit'       => 'px',
                            'output'     => '.whols_wholesaler_price .whols_label_left',
                            'output_mode' => 'line-height'
                        ),
                        array(
                            'id'         => 'wholesaler_price_label_font_weight',
                            'type'       => 'number',
                            'title'      => esc_html__('Font Weight', 'whols'),
                            'unit'       => ' ',
                            'output'     => '.whols_loop_custom_price .whols_label .whols_label_left',
                            'output_mode' => 'font-weight',
                            'desc'        => esc_html__('Default: 700', 'whols')
                        ),
                    )
                ),

                // wholesaler_price
                array(
                    'id'         => 'wholesaler_price',
                    'type'       => 'fieldset',
                    'title'      => esc_html__('Wholesaler Price', 'whols'),
                    'fields'     => array(
                        array(
                            'id'         => 'wholesaler_price_color',
                            'type'       => 'color',
                            'title'      => esc_html__('Color', 'whols'),
                            'output'     => '.products .product .price .whols_wholesaler_price .whols_label_right, .products .product .price .whols_wholesaler_price .whols_label_right *'
                        ),
                        array(
                            'id'         => 'wholesaler_price_font_size',
                            'type'       => 'number',
                            'title'      => esc_html__('Font size', 'whols'),
                            'unit'       => 'px',
                            'output'     => '.products .product .price .whols_wholesaler_price .whols_label_right, .products .product .price .whols_wholesaler_price .whols_label_right *',
                            'output_mode' => 'font-size'
                        ),
                        array(
                            'id'         => 'wholesaler_price_line_height',
                            'type'       => 'number',
                            'title'      => esc_html__('Line Height', 'whols'),
                            'unit'       => 'px',
                            'output'     => '.products .product .price .whols_wholesaler_price .whols_label_right, .products .product .price .whols_wholesaler_price .whols_label_right *',
                            'output_mode' => 'line-height'
                        ),
                        array(
                            'id'         => 'wholesaler_price_font_weight',
                            'type'       => 'number',
                            'title'      => esc_html__('Font Weight', 'whols'),
                            'unit'       => ' ',
                            'output'     => '.products .product .price .whols_wholesaler_price .whols_label_right, .products .product .price .whols_wholesaler_price .whols_label_right *',
                            'output_mode' => 'font-weight',
                            'desc'        => esc_html__('Default: 400', 'whols')
                        ),
                    )
                ),

                // wholesaler_price_margin
                array(
                    'id'          => 'wholesaler_price_margin',
                    'type'        => 'spacing',
                    'title'       => esc_html__('Wholesaler Price Area Margin', 'whols'),
                    'output'      => '.whols_wholesaler_price',
                    'output_mode' => 'margin',
                    'top_icon'    => '',
                    'right_icon'  => '',
                    'bottom_icon' => '',
                    'left_icon'   => '',
                ),

                // wholesaler_price_label
                array(
                    'id'         => 'save_amount_label',
                    'type'       => 'fieldset',
                    'title'      => esc_html__('Save Amount Label', 'whols'),
                    'fields'     => array(
                        array(
                            'id'         => 'save_amount_label_color',
                            'type'       => 'color',
                            'title'      => esc_html__('Color', 'whols'),
                            'output'     => '.whols_save_amount .whols_label_left'
                        ),
                        array(
                            'id'         => 'save_amount_label_font_size',
                            'type'       => 'number',
                            'title'      => esc_html__('Font size', 'whols'),
                            'unit'       => 'px',
                            'output'     => '.whols_save_amount .whols_label_left',
                            'output_mode' => 'font-size'
                        ),
                        array(
                            'id'         => 'save_amount_label_line_height',
                            'type'       => 'number',
                            'title'      => esc_html__('Line Height', 'whols'),
                            'unit'       => 'px',
                            'output'     => '.whols_save_amount .whols_label_left',
                            'output_mode' => 'line-height'
                        ),
                        array(
                            'id'         => 'save_amount_label_font_weight',
                            'type'       => 'number',
                            'title'      => esc_html__('Font Weight', 'whols'),
                            'unit'       => ' ',
                            'output'     => '.whols_save_amount .whols_label .whols_label_left',
                            'output_mode' => 'font-weight',
                            'desc'        => esc_html__('Default: 700', 'whols')
                        ),
                    )
                ),

                // save_amount_price
                array(
                    'id'         => 'save_amount_price',
                    'type'       => 'fieldset',
                    'title'      => esc_html__('Save Amount Price', 'whols'),
                    'fields'     => array(
                        array(
                            'id'         => 'save_amount_price_color',
                            'type'       => 'color',
                            'title'      => esc_html__('Color', 'whols'),
                            'output'     => '.whols_save_amount .whols_label_right'
                        ),
                        array(
                            'id'         => 'save_amount_price_font_size',
                            'type'       => 'number',
                            'title'      => esc_html__('Font size', 'whols'),
                            'unit'       => 'px',
                            'output'     => '.whols_save_amount .whols_label_right',
                            'output_mode' => 'font-size'
                        ),
                        array(
                            'id'         => 'save_amount_price_line_height',
                            'type'       => 'number',
                            'title'      => esc_html__('Line Height', 'whols'),
                            'unit'       => 'px',
                            'output'     => '.whols_save_amount .whols_label_right',
                            'output_mode' => 'line-height'
                        ),
                        array(
                            'id'         => 'save_amount_price_font_weight',
                            'type'       => 'number',
                            'title'      => esc_html__('Font Weight', 'whols'),
                            'unit'       => ' ',
                            'output'     => '.whols_save_amount .whols_label_right',
                            'output_mode' => 'font-weight',
                            'desc'        => esc_html__('Default: 400', 'whols')
                        ),
                    )
                ),

                // save_amount_margin
                array(
                    'id'          => 'save_amount_margin',
                    'type'        => 'spacing',
                    'title'       => esc_html__('Wholesaler Save Amount Margin', 'whols'),
                    'output'      => '.whols_save_amount',
                    'output_mode' => 'margin',
                    'top_icon'    => '',
                    'right_icon'  => '',
                    'bottom_icon' => '',
                    'left_icon'   => '',
                ),

                // minimum_quantity_notice
                array(
                    'id'         => 'minimum_quantity_notice',
                    'type'       => 'fieldset',
                    'title'      => esc_html__('Minimum Quantity Notice', 'whols'),
                    'fields'     => array(
                        array(
                            'id'         => 'retailer_price_color',
                            'type'       => 'color',
                            'title'      => esc_html__('Color', 'whols'),
                            'output'     => '.whols_minimum_quantity_notice'
                        ),
                        array(
                            'id'         => 'retailer_price_font_size',
                            'type'       => 'number',
                            'title'      => esc_html__('Font size', 'whols'),
                            'unit'       => 'px',
                            'output'     => '.whols_minimum_quantity_notice',
                            'output_mode' => 'font-size'
                        ),
                        array(
                            'id'         => 'retailer_price_line_height',
                            'type'       => 'number',
                            'title'      => esc_html__('Line Height', 'whols'),
                            'unit'       => 'px',
                            'output'     => '.whols_minimum_quantity_notice',
                            'output_mode' => 'line-height'
                        ),
                        array(
                            'id'         => 'retailer_price_font_weight',
                            'type'       => 'number',
                            'title'      => esc_html__('Font Weight', 'whols'),
                            'unit'       => ' ',
                            'output'     => '.whols_minimum_quantity_notice',
                            'output_mode' => 'font-weight',
                            'desc'        => esc_html__('Default: 400', 'whols')
                        ),
                    )
                ),
            )
        ));

        // Email Notification
        \CSF::createSection( $prefix, array(
            'title'  => esc_html__( 'Email Notification',  'whols' ),
            'fields' => array(
                // Heading
                array(
                  'type'    => 'heading',
                  'content' => esc_html__('Wholesaler Request Notification', 'whols'),
                ),
                // enable_registration_notification_for_admin
                array(
                  'id'         => 'enable_registration_notification_for_admin',
                  'type'       => 'checkbox',
                  'title'      => esc_html__( 'Wholesaler Request Notification', 'whols' ),
                  'label'      => esc_html__( 'Enable', 'whols' ),
                  'desc'       => esc_html__( 'If Enabled, The site admin will get an email about the new wholesaler registration request.' , 'whols' ),
                ),
                // email_subject
                array(
                    'id'       => 'registration_notification_subject_for_admin',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Email Subject', 'whols'),
                    'dependency' => array(
                        'enable_registration_notification_for_admin', '==', '1'
                    )
                ),
                // message
                array(
                    'id'       => 'registration_notification_message_for_admin',
                    'type'     => 'wp_editor',
                    'title'    => esc_html__( 'Successful Registration Message', 'whols'),
                    'desc'     => esc_html__( 'Use these  {name}, {email}, {date}, {time} placeholder tags to get dynamic content.', 'whols'  ),
                    'dependency' => array(
                        'enable_registration_notification_for_admin', '==', '1'
                    )
                ),
                // Heading
                array(
                  'type'    => 'heading',
                  'content' => esc_html__('Wholesaler Registration Notification', 'whols'),
                ),
                // enable_registration_notification_for_user
                array(
                  'id'         => 'enable_registration_notification_for_user',
                  'type'       => 'checkbox',
                  'title'      => esc_html__( 'Wholesaler Registration Notification', 'whols' ),
                  'label'      => esc_html__( 'Enable', 'whols' ),
                  'desc'       => esc_html__( 'If Enabled, The registered wholesale customer will get an email about the registration.' , 'whols' ),
                ),
                // email_subject
                array(
                    'id'       => 'registration_notification_subject_for_user',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Email Subject', 'whols'),
                    'dependency' => array(
                        'enable_registration_notification_for_user', '==', '1'
                    )
                ),
                // message
                array(
                    'id'       => 'registration_notification_message_for_user',
                    'type'     => 'wp_editor',
                    'title'    => esc_html__( 'Successful Registration Message', 'whols'),
                    'desc'     => esc_html__( 'Use these  {name}, {email}, {date}, {time} placeholder tags to get dynamic content.', 'whols'  ),
                    'dependency' => array(
                        'enable_registration_notification_for_user', '==', '1'
                    )
                ),
                // Heading
                array(
                  'type'    => 'heading',
                  'content' => esc_html__('Approved Notification', 'whols'),
                ),
                // enable_approved_notification
                array(
                  'id'         => 'enable_approved_notification',
                  'type'       => 'checkbox',
                  'title'      => esc_html__( 'Enable Approved Notification', 'whols' ),
                  'label'      => esc_html__( 'Enable', 'whols' ),
                  'desc'       => esc_html__( 'If Enabled, The registered wholesale customer will get an email if the wholesaler request is approved.' , 'whols' ),
                  'class'      => 'whols_pro'
                ),
                // Heading
                array(
                  'type'    => 'heading',
                  'content' => esc_html__('Rejection Notification', 'whols'),
                ),
                // enable_rejection_notification
                array(
                  'id'         => 'enable_rejection_notification',
                  'type'       => 'checkbox',
                  'title'      => esc_html__( 'Enable Rejection Notification', 'whols' ),
                  'label'      => esc_html__( 'Enable', 'whols' ),
                  'desc'       => esc_html__( 'If Enabled, The registered wholesale customer will get an email if the wholesaler request is rejected.' , 'whols' ),
                  'class'      => 'whols_pro'
                ),
            )
        ));

        // Others Options Tab
        \CSF::createSection( $prefix, array(
            'title'  => esc_html__( 'Others Settings',  'whols' ),
            'fields' => array(
                // exclude_tax_for_wholesale_customers
                array(
                    'id'         => 'exclude_tax_for_wholesale_customers',
                    'type'       => 'checkbox',
                    'title'      => esc_html__( 'Exclude Tax for Wholesale Customers', 'whols'),
                    'label'      => esc_html__( 'Yes', 'whols'  ),
                ),

                // disable coupon for wholesale customers
                array(
                    'id'         => 'disable_coupon_for_wholesale_customers',
                    'type'       => 'checkbox',
                    'title'      => esc_html__( 'Disable Coupons For Wholesale Customers', 'whols'),
                    'label'      => esc_html__( 'Yes (This option can be overridden for each role individually.)', 'whols'  ),
                ),

                // disable specific payment gateway for wholesale customers
                array(
                    'id'          => 'disable_specific_payment_gateway_for_wholesale_customers',
                    'title'       => esc_html__( 'Disable Payment Gateway For Wholesale Customers', 'whols'),
                    'type'        => 'select',
                    'options'     => whols_get_payment_gateways(),
                    'placeholder' => esc_html__( 'Select Gateways' ),
                    'chosen'      => true,
                    'multiple'    => true,
                    'after'       => esc_html__( '(Theis option can be overridden for each role individually.)', 'whols'  ),
                    'class'       => 'whols_pro whols_disable_gateway'
                ),

                // enable free shipping for wholsale customers
                array(
                    'id'         => 'allow_free_shipping_for_wholesale_customers',
                    'type'       => 'checkbox',
                    'title'      => esc_html__( 'Allow Free Shipping For Wholesale Customers', 'whols'),
                    'label'      => esc_html__( '(This option can be overridden for role individually.) Note: Free Shipping will not work unless you have enabled & configured free shipping from the "WooCommerce > Settings > Shipping Zones"'  , 'whols' ),
                ),
            )
        ) );

        // Import/Export Tab
        \CSF::createSection( $prefix, array(
            'title'  => esc_html__( 'Import & Export',  'whols' ),
            'fields' => array(

                // backup
                array(
                    'id'    => 'backup',
                    'title' => esc_html__('Import / Export Settings', 'whols'),
                    'type'  => 'backup',
                ),

            )
        ) );    
    }

}