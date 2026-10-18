<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$item_id        = $args['item_id'] ?? get_the_ID();
$name_ar        = $args['name_ar'] ?? '';
$name_en        = $args['name_en'] ?? '';
$description_ar = $args['description_ar'] ?? '';
$description_en = $args['description_en'] ?? '';
$price          = $args['price'] ?? '';
$image          = $args['image'] ?? '';
$has_pizza_prices = ! empty( $args['has_pizza_prices'] );
$has_variation  = ! empty( $args['has_variation'] );
$variations     = $args['variations'] ?? array();
$badges         = $args['badges'] ?? array();

$category_image = get_field(
    'category_image',
    RM_MENU_CATEGORY_TAX . '_' . $item_id
);

$image_url = is_string( $category_image )
    ? $category_image
    : ''; 
?>

<article class="professional-product <?php echo $has_variation && !empty($variations) ? 'has-variation' : ''; ?>">

    <?php if ( ! empty( $badges ) ) : ?>
    <div class="professional-product__badges">
        <?php
            get_template_part(
                'designs/'.RM_DESIGN.'/parts/product-badges',
                null,
                array( 'badges' => $badges )
            );
            ?>
    </div>
    <?php endif; ?>

    <div class="professional-product__image">
        <?php if ( $image ) : ?>
        <img src="<?php echo esc_url( $image ); ?>"
            alt="<?php echo esc_attr( $name_en ?: $name_ar ?: get_the_title() ); ?>" loading="lazy">
        <?php else : ?>
        <div class="professional-product__image-placeholder" aria-hidden="true">
            <span><?php esc_html_e( 'Club 21', 'restaurant-menu' ); ?></span>
        </div>
        <?php endif; ?>
    </div>

    <div class="professional-product__body">

        <div class="professional-product__heading">
            <h3 class="professional-product__name">
                <?php if ( $name_ar ) : ?>
                <span class="menu-name-ar">
                    <?php echo wp_kses_post( rm_replace_c21_icon( $name_ar ) ); ?>
                </span>
                <?php endif; ?>

                <?php if ( $name_en ) : ?>
                <span class="menu-name-en">
                    <?php echo wp_kses_post( rm_replace_c21_icon( $name_en ) ); ?>
                </span>
                <?php endif; ?>

                <?php if ( ! $name_ar && ! $name_en ) : ?>
                <?php echo esc_html( get_the_title( $item_id ) ); ?>
                <?php endif; ?>
            </h3>

            <?php
            // Display the regular price only.
            // No pizza size or pizza-specific pricing is added here.
            if (
                ! $has_pizza_prices &&
                $price !== '' &&
                $price !== null &&
                ! $has_variation
            ) :
            ?>
            <span class="professional-product__price">
                <?php echo esc_html( $price ); ?>
            </span>
            <?php endif; ?>
        </div>

        <?php if ( $description_ar || $description_en ) : ?>
        <div class="professional-product__description">
            <?php if ( $description_ar ) : ?>
            <p class="menu-description-ar">
                <?php echo wp_kses_post( rm_replace_c21_icon( $description_ar ) ); ?>
            </p>
            <?php endif; ?>

            <?php if ( $description_en ) : ?>
            <p class="menu-description-en">
                <?php echo wp_kses_post( rm_replace_c21_icon( $description_en ) ); ?>
            </p>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <?php if ( $has_variation && ! empty( $variations ) ) : ?>
        <div class="professional-product__variations">

            <?php foreach ( $variations as $variation ) : ?>
            <?php
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

            <div class="professional-product__variation">

                <div class="professional-product__description">
                    <?php if ( ! empty( $variation['desc_ar'] ) ) : ?>
                    <span class="menu-description-ar">
                        <?php echo wp_kses_post( rm_replace_c21_icon( $variation['desc_ar'] ) )?>
                    </span>
                    <?php endif; ?>

                    <?php if ( ! empty( $variation['desc_en'] ) ) : ?>
                    <span class="menu-description-en">
                        <?php echo wp_kses_post( rm_replace_c21_icon( $variation['desc_en'] ) )?>
                    </span>
                    <?php endif; ?>
                </div>

                <?php if (
                            isset( $variation['price'] ) &&
                            $variation['price'] !== ''
                        ) : ?>
                <span class="professional-product__price">
                    <?php echo esc_html( $variation['price'] ); ?>
                </span>
                <?php endif; ?>

            </div>
            <?php endforeach; ?>

        </div>
        <?php endif; ?>

    </div>
</article>