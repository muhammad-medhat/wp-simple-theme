<?php
/**
* Restaurant Menu Customizer
*/
function rm_menu_customize_register( $wp_customize ) {

    /*
    * Section
    */
    $wp_customize->add_section( 'rm_menu_design', array(
        'title' => __( 'Restaurant Menu', 'restaurant-menu' ),
        'description' => __( 'Customize the restaurant QR menu.', 'restaurant-menu' ),
        'priority' => 30,
        )
    );


    /*
    * Design setting
    */
    $wp_customize->add_setting('rm_menu_design', array(      
        'default' => 'modern',
        'sanitize_callback' => 'rm_menu_sanitize_design',
        )
    );


    /*
    * Design selector
    */
    $wp_customize->add_control('rm_menu_design', array(
        'type' => 'select',
        'section' => 'rm_menu_design',
        'label' => __( 'Menu Design', 'restaurant-menu' ),
        'description' => __( 'Choose the visual design of your restaurant menu.', 'restaurant-menu' ),

        'choices' => array(
            'modern' => __( 'Modern', 'restaurant-menu' ),
            'elegant' => __( 'Elegant', 'restaurant-menu' ),
            'dark' => __( 'Dark', 'restaurant-menu' ),
        ),
    ));
}

add_action( 'customize_register', 'rm_menu_customize_register');


/**
* Sanitize menu design
*/
function rm_menu_sanitize_design( $value ) {

    $allowed_designs = array(
        'modern',
        'elegant',
        'dark',
    );

    if ( ! in_array( $value, $allowed_designs, true ) ) {
        return 'modern';
    }

    return $value;
}

/**
 * Load selected menu design
 */
function rm_menu_load_design_assets() {

    if ( ! is_front_page() ) {
        return;
    }

    $design = get_theme_mod(
        'rm_menu_design',
        'modern'
    );


    $allowed_designs = array(
        'modern',
        'elegant',
        'dark',
    );


    if ( ! in_array( $design, $allowed_designs, true ) ) {
        $design = 'modern';
    }

    // css for the selected style


    wp_enqueue_style(
        "rm-menu-design-$design",
        RESTAURANT_MENU_DIR_URI ."/designs/$design/style.css",
        array( 'restaurant-menu-custom' ),
        wp_get_theme()->get( 'Version' )
    );
}

add_action('wp_enqueue_scripts', 'rm_menu_load_design_assets', 20);