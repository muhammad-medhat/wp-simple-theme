<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
 $restaurant_name=get_bloginfo( "name");
 $restaurant_desc=get_bloginfo( "description");
$restaurant_name_ar = 'مطعمنا';
$restaurant_name_en = 'Our Restaurant';

?>

<header class="restaurant-header">

    <div class="container">

        <div class="restaurant-header__inner">

            <div class="restaurant-header__logo">

                <?php if ( has_custom_logo() ) : ?>

                <?php the_custom_logo(); ?>

                <?php else : ?>

                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="restaurant-header__logo-placeholder"
                    aria-label="<?php echo esc_attr( $restaurant_name ); ?>">
                    <span>
                        <?php
                            echo esc_html(
                                mb_substr(
                                    $restaurant_name,
                                    0,
                                    1
                                )
                            );
                            ?>
                    </span>
                </a>

                <?php endif; ?>

            </div>


            <div class="restaurant-header__info">

                <!-- Restaurant identity -->

                <div class="restaurant-header__identity">

                    <h1 class="restaurant-header__name">

                        <span class="restaurant-name-ar restaurant-name-en">
                            <?php echo esc_html( $restaurant_name ); ?>
                        </span>

                    </h1>


                    <?php if ( $restaurant_desc ) : ?>

                    <div class="restaurant-header__description">

                        <?php if ( $restaurant_desc ) : ?>

                        <p class="restaurant-description-ar">
                            <?php
                    echo esc_html(
                        $restaurant_desc
                    );
                    ?>
                        </p>

                        <?php endif; ?>




                    </div>

                    <?php endif; ?>

                </div>

            </div>


            <div class="restaurant-header__language">

                <button type="button" class="language-switcher" id="language-switcher"
                    aria-label="<?php esc_attr_e( 'Change language', 'restaurant-menu' ); ?>">

                    <span class="language-switcher__option" data-language="ar">
                        عربي
                    </span>

                    <span class="language-switcher__option" data-language="en">
                        EN
                    </span>

                    <span class="language-switcher__indicator" aria-hidden="true"></span>

                </button>

            </div>

        </div>

    </div>

</header>