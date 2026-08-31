<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$item_id = $args['item_id'] ?? get_the_ID();

if ( ! $item_id ) {
    return;
}


/*
 * ACF fields
 */
$name_ar = get_field( 'name_ar', $item_id );
$name_en = get_field( 'name_en', $item_id );

$desc_ar = get_field( 'desc_ar', $item_id );
$desc_en = get_field( 'desc_en', $item_id );

$price = get_field( 'price', $item_id );

$item_key = get_field( 'item_key', $item_id );


/*
 * Featured image
 */
$image = get_the_post_thumbnail_url(
    $item_id,
    'medium'
);

?>

<article class="menu-item-card" data-item-key="<?php echo esc_attr( $item_key ); ?>">

    <?php if ( $image ) : ?>

    <div class="menu-item-card__image">

        <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $name_en ); ?>" loading="lazy">

    </div>

    <?php endif; ?>


    <div class="menu-item-card__content">

        <div class="menu-item-card__top">

            <h3 class="menu-item-card__name">

                <span class="menu-name-ar">
                    <?php echo esc_html( $name_ar ); ?>
                </span>

                <span class="menu-name-en">
                    <?php echo esc_html( $name_en ); ?>
                </span>

            </h3>


            <?php if ( '' !== $price && null !== $price ) : ?>

            <div class="menu-item-card__price">

                <?php echo esc_html( $price ); ?>

            </div>

            <?php endif; ?>

        </div>


        <?php if ( $desc_ar || $desc_en ) : ?>

        <div class="menu-item-card__description">

            <span class="menu-description-ar">
                <?php echo esc_html( $desc_ar ); ?>
            </span>

            <span class="menu-description-en">
                <?php echo esc_html( $desc_en ); ?>
            </span>

        </div>

        <?php endif; ?>

    </div>

</article>