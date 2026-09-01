<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
define('RESTAURANT_MENU_DIR', get_template_directory());
define('RESTAURANT_MENU_DIR_URI', get_template_directory_uri());

/**
 * Theme setup
 */
function restaurant_menu_setup() {

    add_theme_support( 'title-tag' );

    add_theme_support( 'post-thumbnails' );

    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );
    /*
     * Enable WordPress Custom Logo
     */
    add_theme_support( 'custom-logo', array(
        'height'      => 200,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ) );
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'restaurant-menu' ),
    ) );
}
add_action( 'after_setup_theme', 'restaurant_menu_setup' );


/**
 * Load theme assets
 */
function restaurant_menu_assets() {

    /*
     * Bootstrap CSS
     */
    wp_enqueue_style(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css',
        array(),
        '5.3.8'
    );

    /*
     * Theme stylesheet
     */
    wp_enqueue_style(
        'restaurant-menu-style',
        get_stylesheet_uri(),
        array( 'bootstrap' ),
        wp_get_theme()->get( 'Version' )
    );

    /*
     * common menu CSS
     */
    wp_enqueue_style(
        'restaurant-menu-custom',
        RESTAURANT_MENU_DIR_URI . '/assets/css/menu.css',
        array( 'bootstrap' ),
        wp_get_theme()->get( 'Version' )
    );
    /*
     * Bootstrap JavaScript
     */
    wp_enqueue_script(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js',
        array(),
        '5.3.8',
        true
    );

    /*
     * Custom menu JavaScript
     */
    wp_enqueue_script(
        'restaurant-menu-js',
        RESTAURANT_MENU_DIR_URI . '/assets/js/menu.js',
        array( 'bootstrap' ),
        wp_get_theme()->get( 'Version' ),
        true
    );
}
add_action( 'wp_enqueue_scripts', 'restaurant_menu_assets' );



require_once RESTAURANT_MENU_DIR . '/inc/fn-md.php';
require_once RESTAURANT_MENU_DIR . '/inc/fn.php';