<?php

$restaurant_name_ar = get_theme_mod(
    'rm_restaurant_name_ar',
    get_bloginfo( 'name' )
);

$restaurant_name_en = get_theme_mod(
    'rm_restaurant_name_en',
    get_bloginfo( 'name' )
);

$restaurant_description_ar = get_theme_mod(
    'rm_restaurant_description_ar',
    get_bloginfo( 'description' )
);

$restaurant_description_en = get_theme_mod(
    'rm_restaurant_description_en',
    get_bloginfo( 'description' )
);

$lang_mode = get_theme_mod(
    'rm_menu_language_mode',
    'bi'
);

$has_logo = has_custom_logo();
?>

<header class="dark-header" id="top">

    <div class="dark-header__inner">

        <?php if ( $has_logo ) : ?>

        <div class="dark-header__logo">
            <?php the_custom_logo(); ?>
        </div>

        <?php else : ?>

        <div class="dark-header__logo-placeholder">
            <span>✦</span>
        </div>

        <?php endif; ?>


        <div class="dark-header__ornament">
            <span>◆</span>
            <i></i>
            <span>◆</span>
        </div>


        <?php if ( $restaurant_name_ar || $restaurant_name_en ) : ?>

        <h1 class="dark-header__name">

            <?php if ( 'bi' === $lang_mode ) : ?>

            <span class="restaurant-name-ar">
                <?php echo esc_html( $restaurant_name_ar ); ?>
            </span>

            <span class="restaurant-name-en">
                <?php echo esc_html( $restaurant_name_en ); ?>
            </span>

            <?php elseif ( 'en' === $lang_mode ) : ?>

            <span class="restaurant-name-en show">
                <?php echo esc_html( $restaurant_name_en ); ?>
            </span>

            <?php elseif ( 'ar' === $lang_mode ) : ?>

            <span class="restaurant-name-ar show">
                <?php echo esc_html( $restaurant_name_ar ); ?>
            </span>

            <?php endif; ?>

        </h1>

        <?php endif; ?>


        <?php if ( $restaurant_description_ar || $restaurant_description_en ) : ?>

        <div class="dark-header__description">

            <?php if ( 'bi' === $lang_mode ) : ?>

            <p class="restaurant-description-ar">
                <?php echo esc_html( $restaurant_description_ar ); ?>
            </p>

            <p class="restaurant-description-en">
                <?php echo esc_html( $restaurant_description_en ); ?>
            </p>

            <?php elseif ( 'en' === $lang_mode ) : ?>

            <p class="restaurant-description-en show">
                <?php echo esc_html( $restaurant_description_en ); ?>
            </p>

            <?php elseif ( 'ar' === $lang_mode ) : ?>

            <p class="restaurant-description-ar show">
                <?php echo esc_html( $restaurant_description_ar ); ?>
            </p>

            <?php endif; ?>

        </div>

        <?php endif; ?>


        <?php
        get_template_part(
            'designs/' . RM_DESIGN . '/parts/lang-switch'
        );
        ?>

    </div>

</header>