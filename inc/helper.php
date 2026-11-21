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
            'glyph' => "\u{F06D}",
            'color' => '#d97706',
        ),

        'recommended' => array(
            'ar'   => 'موصى به',
            'en'   => 'Recommended',
            'icon' => 'fa-solid fa-star',
            'glyph' => "\u{F005}",
            'color' => '#b7791f',
        ),

        'new' => array(
            'ar'   => 'جديد',
            'en'   => 'New',
            'icon' => 'fa-solid fa-bolt',
            'glyph' => "\u{F0E7}",
            'color' => '#15803d',
        ),

        'spicy' => array(
            'ar'   => 'حار',
            'en'   => 'Spicy',
            'icon' => 'fa-solid fa-pepper-hot',
            'glyph' => "\u{F816}",
            'color' => '#dc2626',
        ),

        'vegetarian' => array(
            'ar'   => 'نباتي',
            'en'   => 'Vegetarian',
            'icon' => 'fa-solid fa-leaf',
            'glyph' => "\u{F06C}",
            'color' => '#16a34a',
        ),

    );
}

/**
 * Build the attributes for the item name's badge pseudo-element.
 */
function rm_item_name_badge_attributes( $badges ) {
    $definitions = rm_get_badge_labels();
    $selected = array();

    foreach ( (array) $badges as $badge ) {
        $key = is_array( $badge ) ? ( $badge['value'] ?? '' ) : $badge;
        if ( is_string( $key ) && isset( $definitions[ $key ] ) ) {
            $selected[ $key ] = $definitions[ $key ];
        }
    }

    if ( ! $selected ) {
        return '';
    }
    $colors = array_column( $selected, 'color' );
    $color  = sanitize_hex_color( $colors[0] ?? '' ) ?: '#c7822b';

    return sprintf(
        ' data-item-badges="%s" data-item-badges-ar="%s" data-item-badges-en="%s" style="--item-badge-color: %s"',
        esc_attr( implode( ' ', array_column( $selected, 'glyph' ) ) ),
        esc_attr( implode( '، ', array_column( $selected, 'ar' ) ) ),
        esc_attr( implode( ', ', array_column( $selected, 'en' ) ) ),
        esc_attr( implode( ', ', array_column( $selected, 'color' ) ) ),
        "$color " 
    );
}

/**
 * replace <c21> text with  img
 */

function rm_replace_c21_icon( $value, $img="gold" ) {

    if ( ! is_string( $value ) || strpos( $value, '<c21>' ) === false ) {
        return $value;
    }
    $logo_url = RESTAURANT_MENU_DIR_URI . "/assets/img/c21-$img.png";

    $logo = sprintf(
        '<img src="%s" class="rm-menu-inline-logo" alt="Club21">',
        esc_url( $logo_url )
    );

    return str_replace( '<c21>', $logo, $value );
}