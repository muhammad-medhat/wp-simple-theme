<?php 


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