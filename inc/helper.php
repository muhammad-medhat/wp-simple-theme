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