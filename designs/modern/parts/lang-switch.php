<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

?>

<div class="language-switcher" id="language-switcher" role="group"
    aria-label="<?php esc_attr_e( 'Language', 'restaurant-menu' ); ?>">

    <button type="button" class="language-switcher__option" data-language="ar"
        aria-label="<?php esc_attr_e( 'Arabic', 'restaurant-menu' ); ?>">
        العربية
    </button>

    <button type="button" class="language-switcher__option" data-language="en"
        aria-label="<?php esc_attr_e( 'English', 'restaurant-menu' ); ?>">
        EN
    </button>

    <span class="language-switcher__indicator" aria-hidden="true"></span>

</div>