<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/*
 * Temporary restaurant data.
 *
 * Later these values can come from:
 * ACF Options Page / Theme Settings.
 */

$restaurant_name = get_bloginfo( 'name' );
$desc= get_bloginfo( 'description' );
// $restaurant_name_en = 'Our Restaurant';

$logo_url = get_template_directory_uri() . '/assets/images/logo.png';

$is_arabic = is_rtl();
?>

<header class="restaurant-header">

    <div class="container">

        <div class="restaurant-header__inner">

            <!-- Logo -->
            <div class="restaurant-header__logo">

                <?php if ( has_custom_logo() ) : ?>

                <?php the_custom_logo(); ?>

                <?php else : ?>

                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="restaurant-header__logo-placeholder"
                    aria-label="<?php echo esc_attr( $restaurant_name_en ); ?>">

                    <span>
                        <?php echo esc_html( mb_substr( $restaurant_name_en, 0, 1 ) ); ?>
                    </span>

                </a>

                <?php endif; ?>

            </div>


            <!-- Restaurant Information -->
            <div class="restaurant-header__info">

                <h1 class="restaurant-header__name">

                    <span class="restaurant-name-ar">
                        <?php echo esc_html( $restaurant_name ); ?>
                    </span>
                    <!-- 
                        <span class="restaurant-name-en">
                            </span> -->

                </h1>
                <h2 class="restaurant-tagline">
                    <?php echo esc_html( $desc ); ?>
                </h2>

            </div>


            <!-- Language Switcher -->
            <?php get_template_part( 'template-parts/header/language-switcher' ); ?>




        </div>

    </div>

</header>