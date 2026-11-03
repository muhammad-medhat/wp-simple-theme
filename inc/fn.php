<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/**
* Sanitize menu design
*/
function rm_menu_sanitize_design( $value ) {

    $allowed_designs = array(
        'modern',
        'elegant',
        'dark','professional', 'classic'
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

    $design = get_theme_mod('rm_menu_design','modern');




    wp_enqueue_style(
        'rm-menu-design-' . $design,        
        RESTAURANT_MENU_DIR_URI ."/designs/$design/style.css",
        array( 'restaurant-menu-custom' ),
        wp_get_theme()->get( 'Version' ) ."--" . rand()
    );
}

add_action(
    'wp_enqueue_scripts',
    'rm_menu_load_design_assets',
    20
);
//load fontaewesome in admin
function rm_menu_load_fontawesome_admin() {
    wp_enqueue_style(
        'rm-menu-fontawesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css',
        array(),
        '6.4.2'
    );
}
add_action( 'admin_enqueue_scripts', 'rm_menu_load_fontawesome_admin' );
/*************************************************************** */
/*************************************************************** */
/*************************************************************** */

function c21_get_category_icon($term) {
    $iconsString = file_get_contents(RESTAURANT_MENU_DIR .'/assets/icons/categories.json');
    
    $icons = json_decode($iconsString,true);
    // var_dump($icons);

    // $filename = $icons[$term->slug] ?? null;
    $filename = array_find($icons, fn($item) => $item['slug']===$term->slug) ?? null;


    if (!$filename) {
        return '';
    }

    return get_theme_file_uri(
        'assets/icons/icons/' . $filename['slug'].'.svg'
    );
}