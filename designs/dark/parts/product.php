<?php

$item_id          = $args['item_id'];

$name_ar          = $args['name_ar'];
$name_en          = $args['name_en'];

$description_ar   = $args['description_ar'];
$description_en   = $args['description_en'];

$price            = $args['price'];

$price_md         = $args['price_md'];
$price_lg         = $args['price_lg'];

$image            = $args['image'];

$has_pizza_prices = $args['has_pizza_prices'];

$has_variation    = $args['has_variation'];

$variations       = $args['variations'];

$badges = $args['badges'] ?? array();
$img="white1";




?>

<article class="item <?php echo $has_pizza_prices ? 'item--sizes' : ''; ?>">
    <?php if(isset($badges)&&!empty($badges)): ?>
    <!-- Product  BADGE -->
    <?php get_template_part('designs/'.RM_DESIGN.'/parts/product-badges', null, ['badges'=> $badges]) ?>
    <?php endif; ?>

    <?php if ( $image ) : ?>

    <div class="item__image">

        <img src="<?php echo esc_url( $image ); ?>"
            alt="<?php echo esc_attr( $name_en ?: $name_ar ?: get_the_title() ); ?>" loading="lazy">

    </div>

    <?php endif; ?>


    <div class="item__content">

        <div class="item__heading">

            <h3 class="item__name">

                <span class="menu-name-ar">
                    <?php
                    echo wp_kses_post(
                        rm_replace_c21_icon(
                            $name_ar ?: get_the_title(), $img
                        )
                    );
                    ?>
                </span>

                <span class="menu-name-en">
                    <?php
                    echo wp_kses_post(
                        rm_replace_c21_icon(
                            $name_en ?: get_the_title(), $img
                        )
                    );
                    ?>
                </span>

            </h3>


            <?php if (
                ! $has_pizza_prices &&
                $price !== '' &&
                $price !== null &&
                ! $has_variation
            ) : ?>

            <span class="item__price">
                <?php echo esc_html( $price ); ?>
            </span>

            <?php endif; ?>

        </div>


        <?php if ( $description_ar || $description_en ) : ?>

        <div class="item__description">

            <?php if ( $description_ar ) : ?>

            <p class="menu-description-ar">
                <?php
                        echo wp_kses_post(
                            rm_replace_c21_icon( $description_ar, $img)
                        );
                        ?>
            </p>

            <?php endif; ?>


            <?php if ( $description_en ) : ?>

            <p class="menu-description-en">
                <?php
                        echo wp_kses_post(
                            rm_replace_c21_icon( $description_en, $img )
                        );
                        ?>
            </p>

            <?php endif; ?>

        </div>

        <?php endif; ?>


        <?php if ( $has_variation ) : ?>

        <div class="item__variations">

            <?php foreach ( $variations as $variation ) : ?>

            <?php

                    $has_variation_data =
                        ! empty( $variation['desc_ar'] )
                        ||
                        ! empty( $variation['desc_en'] )
                        ||
                        (
                            isset( $variation['price'] )
                            &&
                            $variation['price'] !== ''
                        );

                    if ( ! $has_variation_data ) {
                        continue;
                    }

                    ?>

            <div class="item__variation">

                <span class="variation-description">

                    <?php if ( ! empty( $variation['desc_ar'] ) ) : ?>

                    <span class="variation-desc-ar">
                        <?php
                                    echo wp_kses_post(
                                        rm_replace_c21_icon(
                                            $variation['desc_ar'], $img
                                        )
                                    );
                                    ?>
                    </span>

                    <?php endif; ?>


                    <?php if ( ! empty( $variation['desc_en'] ) ) : ?>

                    <span class="variation-desc-en">
                        <?php
                                    echo wp_kses_post(
                                        rm_replace_c21_icon(
                                            $variation['desc_en'], $img
                                        )
                                    );
                                    ?>
                    </span>

                    <?php endif; ?>

                </span>


                <?php if (
                            isset( $variation['price'] )
                            &&
                            $variation['price'] !== ''
                        ) : ?>

                <span class="item__variation-price">
                    <?php
                                echo esc_html(
                                    $variation['price']
                                );
                                ?>
                </span>

                <?php endif; ?>

            </div>

            <?php endforeach; ?>

        </div>

        <?php endif; ?>


        <?php if ( $has_pizza_prices ) : ?>

        <div class="item__sizes">

            <?php if ( $price_md !== '' && $price_md !== null ) : ?>

            <div class="item__size">

                <span class="item__size-name">

                    <span class="size-name-ar">
                        <?php
                                echo esc_html(
                                    $md_ar ?: 'وسط'
                                );
                                ?>
                    </span>

                    <span class="size-name-en">
                        <?php
                                echo esc_html(
                                    $md_en ?: 'Medium'
                                );
                                ?>
                    </span>

                </span>


                <span class="item__size-price">
                    <?php echo esc_html( $price_md ); ?>
                </span>

            </div>

            <?php endif; ?>


            <?php if ( $price_lg !== '' && $price_lg !== null ) : ?>

            <div class="item__size">

                <span class="item__size-name">

                    <span class="size-name-ar">
                        <?php
                                echo esc_html(
                                    $lg_ar ?: 'كبير'
                                );
                                ?>
                    </span>

                    <span class="size-name-en">
                        <?php
                                echo esc_html(
                                    $lg_en ?: 'Large'
                                );
                                ?>
                    </span>

                </span>


                <span class="item__size-price">
                    <?php echo esc_html( $price_lg ); ?>
                </span>

            </div>

            <?php endif; ?>

        </div>

        <?php endif; ?>

    </div>

</article>