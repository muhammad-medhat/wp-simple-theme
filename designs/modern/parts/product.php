<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


$item_id = $args['item_id'] ?? 0;

$name_ar = $args['name_ar'] ?? '';
$name_en = $args['name_en'] ?? '';

$description_ar = $args['description_ar'] ?? '';
$description_en = $args['description_en'] ?? '';

$price = $args['price'] ?? '';

$price_md = $args['price_md'] ?? '';
$price_lg = $args['price_lg'] ?? '';

$has_pizza_prices = ! empty(
    $args['has_pizza_prices']
);

$image = $args['image'] ?? '';

$has_variation = ! empty(
    $args['has_variation']
);

$variations = $args['variations'] ?? array();


$sm_ar = $args['sm_ar'] ?? 'صغير';
$sm_en = $args['sm_en'] ?? 'Small';

$md_ar = $args['md_ar'] ?? 'وسط';
$md_en = $args['md_en'] ?? 'Medium';

$lg_ar = $args['lg_ar'] ?? 'كبير';
$lg_en = $args['lg_en'] ?? 'Large';

?>

<article class="menu-item-card <?php echo $has_pizza_prices ? 'menu-item-card--sizes' : ''; ?>">

    <?php if ( $image ) : ?>

    <div class="menu-item-card__image">

        <img src="<?php echo esc_url( $image ); ?>"
            alt="<?php echo esc_attr( $name_en ?: $name_ar ?: get_the_title() ); ?>" loading="lazy">

    </div>

    <?php endif; ?>


    <div class="menu-item-card__content">


        <!-- =========================================
             NAME + NORMAL PRICE
        ========================================== -->

        <div class="menu-item-card__top">

            <h3 class="menu-item-card__name">

                <span class="menu-name-ar">

                    <?php
                    echo wp_kses_post(
                        rm_replace_c21_icon(
                            $name_ar ?: get_the_title()
                        )
                    );
                    ?>

                </span>

                <span class="menu-name-en">

                    <?php
                    echo wp_kses_post(
                        rm_replace_c21_icon(
                            $name_en ?: get_the_title()
                        )
                    );
                    ?>

                </span>

            </h3>


            <?php if (
                ! $has_pizza_prices
                &&
                ! $has_variation
                &&
                $price !== ''
                &&
                $price !== null
            ) : ?>

            <span class="menu-item-card__price">

                <?php echo esc_html( $price ); ?>

            </span>

            <?php endif; ?>

        </div>


        <!-- =========================================
             NORMAL DESCRIPTION
        ========================================== -->

        <?php if (
            ! $has_variation
            &&
            ( $description_ar || $description_en )
        ) : ?>

        <div class="menu-item-card__description">

            <?php if ( $description_ar ) : ?>

            <p class="menu-description-ar">

                <?php
                        echo wp_kses_post(
                            rm_replace_c21_icon(
                                $description_ar
                            )
                        );
                        ?>

            </p>

            <?php endif; ?>


            <?php if ( $description_en ) : ?>

            <p class="menu-description-en">

                <?php
                        echo wp_kses_post(
                            rm_replace_c21_icon(
                                $description_en
                            )
                        );
                        ?>

            </p>

            <?php endif; ?>

        </div>

        <?php endif; ?>


        <!-- =========================================
             VARIATIONS
        ========================================== -->

        <?php if (
            $has_variation
            &&
            ! empty( $variations )
        ) : ?>

        <div class="menu-item-card__variations">

            <?php foreach ( $variations as $variation ) : ?>

            <?php

                    $variation_desc_ar =
                        $variation['desc_ar'] ?? '';

                    $variation_desc_en =
                        $variation['desc_en'] ?? '';

                    $variation_price =
                        $variation['price'] ?? '';

                    ?>

            <?php if (
                        $variation_desc_ar
                        ||
                        $variation_desc_en
                        ||
                        $variation_price !== ''
                    ) : ?>

            <div class="menu-item-variation">

                <span class="variation-description">

                    <span class="menu-description-ar">

                        <?php
                                    echo wp_kses_post(
                                        rm_replace_c21_icon(
                                            $variation_desc_ar
                                        )
                                    );
                                    ?>

                    </span>

                    <span class="menu-description-en">

                        <?php
                                    echo wp_kses_post(
                                        rm_replace_c21_icon(
                                            $variation_desc_en
                                        )
                                    );
                                    ?>

                    </span>

                </span>


                <?php if (
                                $variation_price !== ''
                                &&
                                $variation_price !== null
                            ) : ?>

                <span class="variation-price">

                    <?php
                                    echo esc_html(
                                        $variation_price
                                    );
                                    ?>

                </span>

                <?php endif; ?>

            </div>

            <?php endif; ?>

            <?php endforeach; ?>

        </div>

        <?php endif; ?>


        <!-- =========================================
             PIZZA SIZES
        ========================================== -->

        <?php if ( $has_pizza_prices ) : ?>

        <div class="menu-item-card__sizes">


            <?php if (
                    $price_md !== ''
                    &&
                    $price_md !== null
                ) : ?>

            <div class="menu-size">

                <span class="menu-size__name">

                    <span class="menu-size__name-ar">
                        <?php echo esc_html( $md_ar ); ?>
                    </span>

                    <span class="menu-size__name-en">
                        <?php echo esc_html( $md_en ); ?>
                    </span>

                </span>

                <span class="menu-size__price">

                    <?php echo esc_html( $price_md ); ?>

                </span>

            </div>

            <?php endif; ?>


            <?php if (
                    $price_lg !== ''
                    &&
                    $price_lg !== null
                ) : ?>

            <div class="menu-size">

                <span class="menu-size__name">

                    <span class="menu-size__name-ar">
                        <?php echo esc_html( $lg_ar ); ?>
                    </span>

                    <span class="menu-size__name-en">
                        <?php echo esc_html( $lg_en ); ?>
                    </span>

                </span>

                <span class="menu-size__price">

                    <?php echo esc_html( $price_lg ); ?>

                </span>

            </div>

            <?php endif; ?>


        </div>

        <?php endif; ?>

    </div>

</article>