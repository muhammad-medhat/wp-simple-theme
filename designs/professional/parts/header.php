<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$name_ar = get_theme_mod('rm_restaurant_name_ar', get_bloginfo( 'name' ));
$name_en = get_theme_mod('rm_restaurant_name_en', get_bloginfo( 'name' ));
$description_ar = get_theme_mod('rm_restaurant_description_ar', get_bloginfo( 'description' ));
$description_en = get_theme_mod('rm_restaurant_description_en', get_bloginfo( 'description' ));

?>

<header class="professional-header" id="top">
    <div class="professional-header__brand">
        <?php if ( has_custom_logo() ) : ?>
        <div class="professional-header__logo">
            <?php the_custom_logo(); ?>
        </div>
        <?php endif; ?>

        <div class="professional-header__text">
            <h1 class="professional-header__name">
                <span class="restaurant-name-ar"><?php echo esc_html( $name_ar ); ?></span>
                <span class="restaurant-name-en"><?php echo esc_html( $name_en ); ?></span>
            </h1>

            <?php if ( $description_ar || $description_en ) : ?>
            <div class="professional-header__description">
                <?php if ( $description_ar ) : ?>
                <p class="restaurant-description-ar">
                    <?php echo esc_html( $description_ar ); ?>
                </p>
                <?php endif; ?>

                <?php if ( $description_en ) : ?>
                <p class="restaurant-description-en">
                    <?php echo esc_html( $description_en ); ?>
                </p>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="professional-language-switcher" id="language-switcher">
        <button type="button" class="language-switcher__option" data-language="ar"
            aria-label="<?php esc_attr_e( 'Arabic', 'restaurant-menu' ); ?>">
            عربي
        </button>

        <button type="button" class="language-switcher__option" data-language="en"
            aria-label="<?php esc_attr_e( 'English', 'restaurant-menu' ); ?>">
            EN
        </button>
    </div>
</header>

<!-- hidden language switcher -->
<div class="professional-mobile-language" id="professional-mobile-language">
    <button type="button" class="professional-mobile-language__toggle" aria-expanded="false"
        aria-controls="professional-mobile-language-options" aria-label="Change menu language">
        ع / EN
    </button>

    <div class="professional-mobile-language__options" id="professional-mobile-language-options" hidden>
        <button type="button" class="language-switcher__option" data-language="ar">عربي</button>

        <button type="button" class="language-switcher__option" data-language="en">English</button>
    </div>
</div>