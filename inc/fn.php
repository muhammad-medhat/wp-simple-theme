<?php
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


    wp_enqueue_style(
        'rm-menu-design-' . $design,        
        RESTAURANT_MENU_DIR_URI ."/designs/$design/style.css",
        array( 'restaurant-menu-custom' ),
        wp_get_theme()->get( 'Version' )
    );
    /*
    * Design-specific fonts
    */
//    wp_enqueue_style(
//        'rm-menu-fonts-' . $design,
//        RESTAURANT_MENU_DIR_URI . "/designs/$design/fonts.css",
//        array( 'rm-menu-design-' . $design ),
//        wp_get_theme()->get( 'Version' )
//    );
}

add_action(
    'wp_enqueue_scripts',
    'rm_menu_load_design_assets',
    20
);