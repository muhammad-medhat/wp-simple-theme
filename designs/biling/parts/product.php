<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


/*
 * =========================================================
 * DATA
 * =========================================================
 */

$name_ar = $args['name_ar'] ?? '';
$name_en = $args['name_en'] ?? '';

$description_ar =
    $args['description_ar'] ?? '';

$description_en =
    $args['description_en'] ?? '';

$price = $args['price'] ?? '';

$price_md =
    $args['price_md'] ?? '';

$price_lg =
    $args['price_lg'] ?? '';

$has_pizza_prices =
    ! empty(
        $args['has_pizza_prices']
    );

$has_variation =
    ! empty(
        $args['has_variation']
    );

$variations =
    $args['variations'] ?? array();

$badges =
    $args['badges'] ?? array();


/*
 * Pizza size labels.
 */

$md_ar =
    $args['md_ar'] ?? 'وسط';

$md_en =
    $args['md_en'] ?? 'Medium';

$lg_ar =
    $args['lg_ar'] ?? 'كبير';

$lg_en =
    $args['lg_en'] ?? 'Large';


/*
 * Badge definitions.
 */

$badge_labels =
    function_exists( 'rm_get_badge_labels' )
        ? rm_get_badge_labels()
        : array();

?>

<article class="bilingual-item">

    <div class="bilingual-item__main">

        <div class="bilingual-item__names">

            <?php if ( $name_en ) : ?>

            <span class="bilingual-item__name-en">

                <?php
                    echo wp_kses_post(
                        rm_replace_c21_icon(
                            $name_en
                        )
                    );
                    ?>

            </span>

            <?php endif; ?>


            <?php if ( $name_ar ) : ?>

            <span class="bilingual-item__name-ar">

                <?php
                    echo wp_kses_post(
                        rm_replace_c21_icon(
                            $name_ar
                        )
                    );
                    ?>

            </span>

            <?php endif; ?>

        </div>


        <?php if ( ! empty( $badges ) ) : ?>

        <div class="bilingual-item__badges">

            <?php foreach ( $badges as $badge ) : ?>

            <?php
                    if (
                        ! isset(
                            $badge_labels[ $badge ]
                        )
                    ) {
                        continue;
                    }

                    $label =
                        $badge_labels[ $badge ];
                    ?>

            <span class="bilingual-item__badge bilingual-item__badge--<?php echo esc_attr( $badge ); ?>" title="<?php echo esc_attr(
                            $label['ar']
                            . ' / '
                            . $label['en']
                        ); ?>">

                <i class="<?php echo esc_attr(
                                $label['icon']
                            ); ?>" aria-hidden="true"></i>

                <span>
                    <?php
                            echo esc_html(
                                $label['en']
                            );
                            ?>
                </span>

                <span class="bilingual-item__badge-divider">
                    /
                </span>

                <span>
                    <?php
                            echo esc_html(
                                $label['ar']
                            );
                            ?>
                </span>

            </span>

            <?php endforeach; ?>

        </div>

        <?php endif; ?>

    </div>


    <?php if (
        ! $has_pizza_prices &&
        ! $has_variation &&
        $price !== '' &&
        $price !== null
    ) : ?>

    <div class="bilingual-item__price">

        <?php echo esc_html( $price ); ?>

    </div>

    <?php endif; ?>


    <?php if (
        ! $has_variation &&
        (
            $description_en ||
            $description_ar
        )
    ) : ?>

    <div class="bilingual-item__description">

        <?php if ( $description_en ) : ?>

        <p class="bilingual-item__description-en">

            <?php
                    echo wp_kses_post(
                        rm_replace_c21_icon(
                            $description_en
                        )
                    );
                    ?>

        </p>

        <?php endif; ?>


        <?php if ( $description_ar ) : ?>

        <p class="bilingual-item__description-ar">

            <?php
                    echo wp_kses_post(
                        rm_replace_c21_icon(
                            $description_ar
                        )
                    );
                    ?>

        </p>

        <?php endif; ?>

    </div>

    <?php endif; ?>


    <?php if (
        $has_variation &&
        ! empty( $variations )
    ) : ?>

    <div class="bilingual-item__variations">

        <?php foreach ( $variations as $variation ) : ?>

        <?php

                $variation_desc_ar =
                    $variation['desc_ar'] ?? '';

                $variation_desc_en =
                    $variation['desc_en'] ?? '';

                $variation_price =
                    $variation['price'] ?? '';

                ?>

        <div class="bilingual-variation">

            <div class="bilingual-variation__name">

                <?php if ( $variation_desc_en ) : ?>

                <span class="bilingual-variation__en">

                    <?php
                                echo wp_kses_post(
                                    rm_replace_c21_icon(
                                        $variation_desc_en
                                    )
                                );
                                ?>

                </span>

                <?php endif; ?>


                <?php if ( $variation_desc_ar ) : ?>

                <span class="bilingual-variation__ar">

                    <?php
                                echo wp_kses_post(
                                    rm_replace_c21_icon(
                                        $variation_desc_ar
                                    )
                                );
                                ?>

                </span>

                <?php endif; ?>

            </div>


            <?php if (
                        $variation_price !== '' &&
                        $variation_price !== null
                    ) : ?>

            <span class="bilingual-variation__price">

                <?php
                            echo esc_html(
                                $variation_price
                            );
                            ?>

            </span>

            <?php endif; ?>

        </div>

        <?php endforeach; ?>

    </div>

    <?php endif; ?>


    <?php if ( $has_pizza_prices ) : ?>

    <div class="bilingual-item__sizes">

        <?php if (
                $price_md !== '' &&
                $price_md !== null
            ) : ?>

        <div class="bilingual-size">

            <div class="bilingual-size__name">

                <span>
                    <?php
                            echo esc_html(
                                $md_en
                            );
                            ?>
                </span>

                <span class="bilingual-size__separator">
                    /
                </span>

                <span>
                    <?php
                            echo esc_html(
                                $md_ar
                            );
                            ?>
                </span>

            </div>

            <span class="bilingual-size__price">

                <?php
                        echo esc_html(
                            $price_md
                        );
                        ?>

            </span>

        </div>

        <?php endif; ?>


        <?php if (
                $price_lg !== '' &&
                $price_lg !== null
            ) : ?>

        <div class="bilingual-size">

            <div class="bilingual-size__name">

                <span>
                    <?php
                            echo esc_html(
                                $lg_en
                            );
                            ?>
                </span>

                <span class="bilingual-size__separator">
                    /
                </span>

                <span>
                    <?php
                            echo esc_html(
                                $lg_ar
                            );
                            ?>
                </span>

            </div>

            <span class="bilingual-size__price">

                <?php
                        echo esc_html(
                            $price_lg
                        );
                        ?>

            </span>

        </div>

        <?php endif; ?>

    </div>

    <?php endif; ?>

</article>