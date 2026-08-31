<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$category = $args['category'] ?? null;

if ( ! $category ) {
    return;
}


/*
 * Category translations
 */
$name_ar = get_field( 'name_ar', RM_MENU_CATEGORY_TAX . '_' . $category->term_id);
$desc_ar = get_field( 'desc_ar', RM_MENU_CATEGORY_TAX . '_' . $category->term_id);
$name_en = get_field( 'name_en', RM_MENU_CATEGORY_TAX . '_' . $category->term_id);
$desc_en = get_field( 'desc_en', RM_MENU_CATEGORY_TAX . '_' . $category->term_id);

    
/*
 * Fallback to taxonomy name
 */
// $name_ar = $name_ar ?: $category->name;
// $desc_ar = $desc_ar ?: $category->description;
// $name_en = $name_en ?: $category->name;
// $desc_en = $desc_en ?: $category->description;

?>

<section id="category-<?php echo esc_attr( $category->term_id ); ?>" class="menu-category"
    data-category-id="<?php echo esc_attr( $category->term_id ); ?>">

    <div class="menu-category__header">

        <h2 class="menu-category__title">

            <span class="category-name-ar">
                <?php echo esc_html( $name_ar ); ?>
            </span>

            <span class="category-name-en">
                <?php echo esc_html( $name_en ); ?>
            </span>

        </h2>


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


    <div class="menu-category__items">

        <?php

        $items = new WP_Query(
            array(
                'post_type'      => RM_MENU_ITEM_CPT,
                'posts_per_page' => -1,
                'post_status'    => 'publish',

                'tax_query'      => array(
                    array(
                        'taxonomy' => RM_MENU_CATEGORY_TAX,
                        'field'    => 'term_id',
                        'terms'    => $category->term_id,
                    ),
                ),

                'orderby' => 'menu_order',
                'order'   => 'ASC',
            )
        );

        if ( $items->have_posts() ) :

            while ( $items->have_posts() ) :

                $items->the_post();

                get_template_part(
                    'template-parts/menu/item',
                    null,
                    array(
                        'item_id' => get_the_ID(),
                    )
                );

            endwhile;

            wp_reset_postdata();

        else :

            ?>

        <p class="menu-empty">
            <?php esc_html_e(
                    'No items available.',
                    'restaurant-menu'
                ); ?>
        </p>

        <?php

        endif;

        ?>

    </div>

</section>