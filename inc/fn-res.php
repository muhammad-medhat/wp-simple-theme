<?php 

// function rm_replace_menu_icons( $text ) {

//     $icon = '<img src="' . RESTAURANT_MENU_DIR_URI . '/assets/img/text-logo-sm.png" alt="c21 Icon" class="menu-icon">';

//     return str_replace(
//         '<c21>',
//         $icon,
//         $text
//     );
// }
// add_filter( 'the_content', 'rm_replace_menu_icons', 10, 1 );



// add_filter( 'acf/format_value', 'rm_replace_c21_icon', 10, 1 );
function rm_replace_c21_icon( $value ) {

    if ( ! is_string( $value ) || strpos( $value, '<c21>' ) === false ) {
        return $value;
    }

    $logo_url = RESTAURANT_MENU_DIR_URI . '/assets/img/text-logo-sm.png';

    $logo = sprintf(
        '<img src="%s" class="rm-menu-inline-logo" alt="Club21">',
        esc_url( $logo_url )
    );

    return str_replace( '<c21>', $logo, $value );
}