<?php 
/**
 * Customizer options
 
 * Restaurant Menu Customizer
*/
define('WP_TITLE_SECTION', 'title_tagline');
define('RM_DESIGN_SECTION', 'rm_menu_design');
define('RM_SETTINGS_SECTION', 'rm_menu_settings');
define('RM_SIZE_SECTION', 'rm_menu_sizes');

function rm_menu_customize_register( $wp_customize ) {

    /*
    * rm_menu_settings Section
    */
    $wp_customize->add_section( RM_SETTINGS_SECTION, array(
        'title' => __( 'Restaurant Menu', 'restaurant-menu' ),
        'description' => __( 'Customize the restaurant QR menu.', 'restaurant-menu' ),
        'priority' => 30,
        )
    );


    /*
    * rm_menu_design Design  setting
    * - Modern
    * - Elegant
    * - Dark
    */
    $wp_customize->add_setting(RM_DESIGN_SECTION, array(      
            'default' => 'modern',
            'sanitize_callback' => 'rm_menu_sanitize_design',
        )
    );


    /*
    * Design selector
    */
    $wp_customize->add_control(RM_DESIGN_SECTION, array(
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
//Settings to add on the title_tagline section - (Site Identity) Section

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
                // 'bilingual' => __( 'Arabic & English', 'restaurant-menu' ),
                'bi' => __( 'Arabic & English', 'restaurant-menu' ),
                'ar'        => __( 'Arabic Only', 'restaurant-menu' ),
                'en'        => __( 'English Only', 'restaurant-menu' ),
            ),
        )
    );
    /**
 * Pizza size labels
 */
$wp_customize->add_section(
    RM_SIZE_SECTION,
    array(
        'title'    => __( 'Multiple Size Labels', 'restaurant-menu' ),
        'priority' => 35,
    )
);

$size_fields = array(
    'sm_ar' => 'Small – Arabic',
    'sm_en' => 'Small – English',
    'md_ar' => 'Medium – Arabic',
    'md_en' => 'Medium – English',
    'lg_ar' => 'Large – Arabic',
    'lg_en' => 'Large – English',
);

foreach ( $size_fields as $field => $label ) {

    $wp_customize->add_setting(
        'rm_size_' . $field,
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'rm_size_' . $field,
        array(
            'label'   => __( $label, 'restaurant-menu' ),
            'section' => RM_SIZE_SECTION,
            'type'    => 'text',
        )
    );
}
}
    add_action( 'customize_register', 'rm_menu_customize_register');