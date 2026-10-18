<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


/*
 * =========================================================
 * CATEGORIES
 * =========================================================
 */

$categories = $args['categories'] ?? array();
$rm_category_icon = rm_get_category_icon_options();

?>

<main class="professional-menu__content">
    <?php if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) : ?>

    <?php foreach ( $categories as $category ) : ?>

    <?php
                $items = new WP_Query(
                    array(
                        'post_type'      => RM_MENU_ITEM_CPT,
                        'posts_per_page' => -1,
                        'post_status'    => 'publish',
                        'orderby'        => 'menu_order',
                        'tax_query'      => array(
                            array(
                                'taxonomy' => RM_MENU_CATEGORY_TAX,
                                'field'    => 'term_id',
                                'terms'    => $category->term_id,
                            ),
                        ),
                    )
                );
                ?>

    <section id="<?php echo esc_attr( 'menu-category-' . $category->term_id ); ?>" class="professional-category">
        <?php
                    get_template_part(
                        'designs/'.RM_DESIGN.'/parts/category-header',
                        '',
                        array( 'category' => $category )
                    );
                    ?>

        <?php if ( $items->have_posts() ) : ?>
        <div class="professional-product-grid">

            <?php while ( $items->have_posts() ) : ?>
            <?php
                                $items->the_post();

                                $item_id   = get_the_ID();
                                $item_data = rm_get_menu_item_data( $item_id );

                                get_template_part(
                                    'designs/'.RM_DESIGN.'/parts/product',
                                    '',
                                    array(
                                        'item_id'          => $item_data['item_id'] ?? $item_id,
                                        'name_ar'          => $item_data['name_ar'] ?? '',
                                        'name_en'          => $item_data['name_en'] ?? '',
                                        'description_ar'   => $item_data['description_ar'] ?? '',
                                        'description_en'   => $item_data['description_en'] ?? '',
                                        'price'            => $item_data['price'] ?? '',
                                        'price_md'         => $item_data['price_md'] ?? '',
                                        'price_lg'         => $item_data['price_lg'] ?? '',
                                        'has_pizza_prices' => $item_data['has_pizza_prices'] ?? false,
                                        'image'            => $item_data['image'] ?? '',
                                        'has_variation'    => $item_data['has_variation'] ?? false,
                                        'variations'       => $item_data['variations'] ?? array(),
                                        'badges'           => $item_data['badges'] ?? array(),
                                    )
                                );
                                ?>
            <?php endwhile; ?>

        </div>
        <?php else : ?>
        <p class="professional-menu__empty">
            <?php esc_html_e( 'No items available in this category.', 'restaurant-menu' ); ?>
        </p>
        <?php endif; ?>

        <?php wp_reset_postdata(); ?>
    </section>

    <?php endforeach; ?>

    <?php else : ?>
    <p class="professional-menu__empty">
        <?php esc_html_e( 'No menu categories available.', 'restaurant-menu' ); ?>
    </p>
    <?php endif; ?>
</main>