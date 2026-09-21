<?php


        $item_id = $args['item_id' ];
        $name_ar = $args['name_ar' ];
        $name_en = $args['name_en' ];
        $description_ar = $args['description_ar' ];
        $description_en = $args['description_en' ];
        $price = $args['price' ];
        $price_md = $args['price_md' ];
        $price_lg = $args['price_lg' ];
        $image = $args['image' ];
        $has_pizza_prices = $args['has_pizza_prices' ];
        $has_variation = $args['has_variation'];
        $variations = $args['variations'];
        $sm_ar = $args['sm_ar'];
        $sm_en = $args['sm_en'];
        $md_ar = $args['md_ar'];
        $md_en = $args['md_en'];
        $lg_ar = $args['lg_ar'];
        $lg_en = $args['lg_en'];

?>

<article class="elegant-item <?php echo $has_pizza_prices ? 'elegant-item--sizes' : ''; ?>">
    <!-- Product Image -->
    <?php if ( $image ) : ?>
    <div class="elegant-item__image">
        <img src="<?php echo esc_url( $image ); ?>"
            alt="<?php echo esc_attr( $name_en ?: $name_ar ?: get_the_title() ); ?>" loading="lazy">
    </div>
    <?php endif; ?>
    <!-- Product Content -->
    <div class="elegant-item__content">
        <div class="elegant-item__heading">
            <h3 class="elegant-item__name">
                <span class="menu-name-ar">
                    <?php echo wp_kses_post( rm_replace_c21_icon($name_ar) ?: get_the_title() );?>
                </span>
                <span class="menu-name-en">
                    <?php echo wp_kses_post(rm_replace_c21_icon($name_en )?: get_the_title() ); ?>
                </span>
            </h3>
            <!-- =================================
                            NORMAL PRODUCT PRICE
                            ================================= -->

            <?php if (  ! $has_pizza_prices && $price !== '' && $price !== null&&!$has_variation ) : ?>
            <span class="elegant-item__price">
                <?php echo esc_html( $price ); ?>
            </span>
            <?php endif; ?>
        </div>
        <!-- =================================
                        PRODUCT DESCRIPTION
                        ================================= -->
        <?php if ($description_ar || $description_en) : ?>
        <div class="elegant-item__description">
            <?php if ( $description_ar ) : ?>
            <p class="menu-description-ar">
                <?php echo wp_kses_post( rm_replace_c21_icon($description_ar));?>
            </p>
            <?php endif; ?>
            <?php if ( $description_en ) : ?>
            <p class="menu-description-en">
                <?php echo wp_kses_post( rm_replace_c21_icon($description_en));?>
            </p>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        <!-- =================================
            variations
            ================================= -->
        <?php if ( $has_variation ) : ?>

        <div class="elegant-item__variations">

            <?php foreach ( $variations as $variation ) : ?>

            <?php
                // Skip only if this variation has absolutely no data.
                $has_variation_data =
                    ! empty( $variation['desc_ar'] ) ||
                    ! empty( $variation['desc_en'] ) ||
                    (
                        isset( $variation['price'] ) &&
                        $variation['price'] !== ''
                    );

                if ( ! $has_variation_data ) {
                    continue;
                }
            ?>

            <div class="menu-item-variation">

                <span class="variation-description">

                    <?php if ( ! empty( $variation['desc_ar'] ) ) : ?>
                    <span class="variation-desc-ar">
                        <?php echo wp_kses_post( rm_replace_c21_icon( $variation['desc_ar']) ); ?>
                    </span>
                    <?php endif; ?>

                    <?php if ( ! empty( $variation['desc_en'] ) ) : ?>
                    <span class="variation-desc-en">
                        <?php echo wp_kses_post( rm_replace_c21_icon( $variation['desc_en']) ); ?>
                    </span>
                    <?php endif; ?>

                </span>

                <?php if (
                isset( $variation['price'] ) &&
                $variation['price'] !== ''
            ) : ?>

                <span class="variation-price">
                    <?php echo esc_html( $variation['price'] ); ?>
                </span>

                <?php endif; ?>

            </div>

            <?php endforeach; ?>

        </div>
        <!-- End Variation Logic-->
        <?php endif; ?>
        <!-- =================================
            PIZZA SIZE PRICES
            ================================= -->

        <?php if ($has_pizza_prices) : ?>

        <div class="elegant-item__sizes">
            <!-- Medium -->
            <?php if ($price_md !== '' && $price_md !== null) : ?>
            <div class="elegant-item__size">
                <span class="elegant-item__size-name">
                    <span class="size-name-ar">
                        <?php echo esc_html($md_ar ?: 'وسط'); ?>
                    </span>
                    <span class="size-name-en">
                        <?php echo esc_html( $md_en ?: 'Medium'    ); ?>
                    </span>
                </span>

                <span class="elegant-item__size-price">
                    <?php echo esc_html($price_md);?>
                </span>
            </div>
            <!-- elegant-item__size->
                            <?php endif; ?>
                            <!-- Large -->
            <?php if ($price_lg !== '' && $price_lg !== null) : ?>
            <div class="elegant-item__size">
                <span class="elegant-item__size-name">
                    <span class="size-name-ar">
                        <?php echo esc_html($lg_ar ?: 'كبير'); ?>
                    </span>
                    <span class="size-name-en">
                        <?php echo esc_html( $lg_en ?: 'Large'    ); ?>
                    </span>
                </span>
                <span class="elegant-item__size-price">
                    <?php echo esc_html($price_lg);?>
                </span>
            </div>

            <?php endif; ?>
        </div>
        <?php endif; ?>

</article>