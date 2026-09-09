<?php 
/**
 * Customizer options
 
 * Restaurant Menu Customizer
*/
define('WP_TITLE_SECTION', 'title_tagline');
// define('RM_DESIGN_SECTION', 'rm_menu_design');
define('RM_SETTINGS_SECTION', 'rm_menu_settings');

function rm_menu_customize_register( $wp_customize ) {

    /*
    * Section
    */
    $wp_customize->add_section( RM_SETTINGS_SECTION, array(
        'title' => __( 'Restaurant Menu', 'restaurant-menu' ),
        'description' => __( 'Customize the restaurant QR menu.', 'restaurant-menu' ),
        'priority' => 30,
        )
    );


    /*
    * Design setting
    */
    $wp_customize->add_setting(RM_SETTINGS_SECTION, array(      
        'default' => 'modern',
        'sanitize_callback' => 'rm_menu_sanitize_design',
        )
    );


    /*
    * Design selector
    */
    $wp_customize->add_control(RM_SETTINGS_SECTION, array(
        'type' => 'select',
        'section' => RM_SETTINGS_SECTION,
        'label' => __( 'Menu Design', 'restaurant-menu' ),
        'description' => __( 'Choose the visual design of your restaurant menu.', 'restaurant-menu' ),

        'choices' => array(
        'modern' => __( 'Modern', 'restaurant-menu' ),
        'elegant' => __( 'Elegant', 'restaurant-menu' ),
        'dark' => __( 'Dark', 'restaurant-menu' ),
        ),
    ));


    /* ================================
    * Restaurant Name - Arabic
    * ================================ */

    $wp_customize->add_setting(
        'rm_restaurant_name_ar',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            )
    );

    $wp_customize->add_control(
        'rm_restaurant_name_ar',
        array(
            'label'   => __( 'Restaurant Name (Arabic)', 'restaurant-menu' ),
            // 'section' => 'rm_menu_settings',
            'section' => WP_TITLE_SECTION,
            'type'    => 'text',
        )
    );


    /* ================================
    * Restaurant Name - English
    * ================================ */

    $wp_customize->add_setting(
        'rm_restaurant_name_en',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'rm_restaurant_name_en',
        array(
            'label'   => __( 'Restaurant Name (English)', 'restaurant-menu' ),
            'section' => WP_TITLE_SECTION,
            'type'    => 'text',
        )
    );


    /* ================================
    * Restaurant Description - Arabic
    * ================================ */

    $wp_customize->add_setting(
        'rm_restaurant_description_ar',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_textarea_field',
        )
    );

    $wp_customize->add_control(
        'rm_restaurant_description_ar',
        array(
            'label'   => __( 'Restaurant Description (Arabic)', 'restaurant-menu' ),
            'section' => WP_TITLE_SECTION,
            'type'    => 'textarea',
        )
    );


    /* ================================
    * Restaurant Description - English
    * ================================ */

    $wp_customize->add_setting(
        'rm_restaurant_description_en',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_textarea_field',
        )
    );

    $wp_customize->add_control(
        'rm_restaurant_description_en',
        array(
            'label'   => __( 'Restaurant Description (English)', 'restaurant-menu' ),
            'section' => WP_TITLE_SECTION,
            'type'    => 'textarea',
        )
    );
    /* =========================================
    * Content Language
    * ========================================= */

    $wp_customize->add_setting(
        'rm_menu_language_mode',
        array(
            'default'           => 'bilingual',
            'sanitize_callback' => 'sanitize_key',
        )
    );

    $wp_customize->add_control(
        'rm_menu_language_mode',
        array(
            'label'   => __( 'Content Language', 'restaurant-menu' ),
            'section' => RM_SETTINGS_SECTION,
            'type'    => 'select',
            'choices' => array(
                'bilingual' => __( 'Arabic & English', 'restaurant-menu' ),
                'ar'        => __( 'Arabic Only', 'restaurant-menu' ),
                'en'        => __( 'English Only', 'restaurant-menu' ),
            ),
        )
    );
}
    add_action( 'customize_register', 'rm_menu_customize_register');