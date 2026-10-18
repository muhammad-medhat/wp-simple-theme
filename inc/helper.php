<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Get all restaurant menu badge definitions.
 *
 * @return array
 */
function rm_get_badge_labels() {

    return array(

        'popular' => array(
            'ar'   => 'الأكثر طلباً',
            'en'   => 'Popular',
            'icon' => 'fa-solid fa-fire',
        ),

        'recommended' => array(
            'ar'   => 'موصى به',
            'en'   => 'Recommended',
            'icon' => 'fa-solid fa-star',
        ),

        'new' => array(
            'ar'   => 'جديد',
            'en'   => 'New',
            'icon' => 'fa-solid fa-bolt',
        ),

        'spicy' => array(
            'ar'   => 'حار',
            'en'   => 'Spicy',
            'icon' => 'fa-solid fa-pepper-hot',
        ),

        'vegetarian' => array(
            'ar'   => 'نباتي',
            'en'   => 'Vegetarian',
            'icon' => 'fa-solid fa-leaf',
        ),

    );
}
/**
 * replace <c21> text with  img
 */

function rm_replace_c21_icon( $value, $img="gold" ) {

    if ( ! is_string( $value ) || strpos( $value, '<c21>' ) === false ) {
        return $value;
    }
// if($img=="white"){echo"<h2>WWWWWWWWWWWWWWWWWWWWWWWW</h2>";}
    $logo_url = RESTAURANT_MENU_DIR_URI . "/assets/img/c21-$img.png";

    $logo = sprintf(
        '<img src="%s" class="rm-menu-inline-logo" alt="Club21">',
        esc_url( $logo_url )
    );

    return str_replace( '<c21>', $logo, $value );
}