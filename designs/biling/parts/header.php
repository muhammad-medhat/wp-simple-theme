<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$restaurant_name_ar = get_theme_mod(
    'rm_restaurant_name_ar',
    ''
);

$restaurant_name_en = get_theme_mod(
    'rm_restaurant_name_en',
    ''
);

$restaurant_description_ar = get_theme_mod(
    'rm_restaurant_description_ar',
    ''
);

$restaurant_description_en = get_theme_mod(
    'rm_restaurant_description_en',
    ''
);

$logo_url = get_theme_mod(
    'custom_logo'
);

$logo_image = '';

if ( $logo_url ) {

    $logo_image = wp_get_attachment_image_url(
        $logo_url,
        'full'
    );
}

if ( ! $logo_image ) {

    $logo_image =
        get_template_directory_uri()
        . '/assets/images/text-logo-sm.png';
}

?>

<header class="bilingual-header">

    <div class="bilingual-header__logo">

        <img src="<?php echo esc_url( $logo_image ); ?>" alt="<?php echo esc_attr(
                $restaurant_name_en
                ?: $restaurant_name_ar
                ?: 'Club21'
            ); ?>">

    </div>


    <?php if (
        $restaurant_name_ar ||
        $restaurant_name_en
    ) : ?>

    <div class="bilingual-header__names">

        <?php if ( $restaurant_name_en ) : ?>

        <h1 class="bilingual-header__name-en">

            <?php
                    echo esc_html(
                        $restaurant_name_en
                    );
                    ?>

        </h1>

        <?php endif; ?>


        <?php if ( $restaurant_name_ar ) : ?>

        <h2 class="bilingual-header__name-ar">

            <?php
                    echo esc_html(
                        $restaurant_name_ar
                    );
                    ?>

        </h2>

        <?php endif; ?>

    </div>

    <?php endif; ?>


    <?php if (
        $restaurant_description_en ||
        $restaurant_description_ar
    ) : ?>

    <div class="bilingual-header__description">

        <?php if ( $restaurant_description_en ) : ?>

        <p class="bilingual-header__description-en">

            <?php
                    echo wp_kses_post(
                        rm_replace_c21_icon(
                            $restaurant_description_en
                        )
                    );
                    ?>

        </p>

        <?php endif; ?>


        <?php if ( $restaurant_description_ar ) : ?>

        <p class="bilingual-header__description-ar">

            <?php
                    echo wp_kses_post(
                        rm_replace_c21_icon(
                            $restaurant_description_ar
                        )
                    );
                    ?>

        </p>

        <?php endif; ?>

    </div>

    <?php endif; ?>

</header>