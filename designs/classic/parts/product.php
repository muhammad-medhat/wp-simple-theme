<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$item_data = $args['item_data'] ?? array();
$compact_class = isset( $item_data['item_compact'] ) &&(bool) $item_data['item_compact'] === true ? 'item--compact' : '';
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
    $badges = $args['badges'] ?? array();
    $variations = $args['variations'];
?>

<article class="item <?php echo $has_pizza_prices ? 'item--sizes' : ''; ?> 
    <?php echo $has_variation && !empty($variations) ? 'has-variation' : ''; ?>">


    <?php if(isset($badges)&&!empty($badges)): ?>
    <!-- Product  BADGE -->
    <?php get_template_part('designs/'.RM_DESIGN.'/parts/product-badges', null, ['badges'=> $badges]) ?>
    <?php endif; ?>

    <!-- Product Content -->
    <div class="item__content">
        <div class="item__heading">
            <h3 class="item__name">
                <span class="menu-name-ar">
                    <?php echo wp_kses_post( rm_replace_c21_icon($name_ar) ?: get_the_title() );?>
                </span>
                <span class="menu-name-en">
                    <?php echo wp_kses_post(rm_replace_c21_icon($name_en )?: get_the_title() ); ?>
                </span>
            </h3>

            <!-- NORMAL PRODUCT PRICE -->
            <?php if (  ! $has_pizza_prices && $price !== '' && $price !== null&&!$has_variation ) : ?>
            <span class="menu-item__dots"></span>
            <span class="item__price">
                <?php echo esc_html( $price ); ?>
            </span>
            <?php endif; ?>

        </div>

        <!-- PRODUCT DESCRIPTION -->
        <?php if ($description_ar || $description_en) : ?>
        <div class="item__description">
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

        <!-- variations -->
        <?php if ( $has_variation ) : ?>

        <div class="item__variations <?php echo $compact_class; ?>">

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

            <div class="menu-item-variation ">

                <span class="variation-description ">

                    <?php if ( ! empty( $variation['desc_ar'] ) ) : ?>
                    <span class="menu-description-ar">
                        <?php echo wp_kses_post( rm_replace_c21_icon( $variation['desc_ar']) ); ?>
                    </span>
                    <?php endif; ?>

                    <?php if ( ! empty( $variation['desc_en'] ) ) : ?>
                    <span class="menu-description-en">
                        <?php echo wp_kses_post( rm_replace_c21_icon( $variation['desc_en']) ); ?>
                    </span>
                    <?php endif; ?>

                </span>
                <?php if(isset( $item_data['item_compact'] ) &&(bool) $item_data['item_compact'] === true) : ?>
                <span class="menu-item__dots"></span>
                <?php endif; ?>
                <?php if (
                isset( $variation['price'] ) &&
                $variation['price'] !== ''
            ) : ?>

                <span class="item__price">
                    <?php echo esc_html( $variation['price'] ); ?>
                </span>

                <?php endif; ?>

            </div>

            <?php endforeach; ?>

        </div>
        <!-- End Variation Logic-->
        <?php endif; ?>
        <!-- 
            PIZZA SIZE PRICES
             -->

</article>