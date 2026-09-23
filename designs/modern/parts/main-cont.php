<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}



/*
 * =========================================================
 * CATEGORIES
 * =========================================================
 */

$categories = get_terms(
    array(
        'taxonomy'   => RM_MENU_CATEGORY_TAX,
        'hide_empty' => true,
        'orderby'    => 'term_order',
        'order'      => 'ASC',
    )
);

?>

<main class="menu-design__content">

    <?php if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) : ?>

    <?php foreach ( $categories as $category ) : ?>

    <?php

            /*
             * -------------------------------------------------
             * CATEGORY SETTINGS
             * -------------------------------------------------
             */

            $is_compact = (bool) get_field(
                'is_compact',
                RM_MENU_CATEGORY_TAX . '_' . $category->term_id
            );


            /*
             * -------------------------------------------------
             * ITEMS
             * -------------------------------------------------
             */

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


            $compact_class = $is_compact
                ? 'menu-category--compact'
                : '';

            ?>

    <section id="<?php echo esc_attr( 'menu-category-' . $category->term_id ); ?>"
        class="menu-category modern-category <?php echo esc_attr( $compact_class ); ?>">

        <?php

                get_template_part(
                    'designs/' . RM_DESIGN . '/parts/category-header',
                    '',
                    array(
                        'category' => $category,
                    )
                );

                ?>


        <div class="menu-category__items">

            <?php if ( $items->have_posts() ) : ?>

            <?php while ( $items->have_posts() ) : ?>

            <?php

                            $items->the_post();

                            $item_id = get_the_ID();


                            /*
                             * =================================================
                             * SHARED MENU DATA
                             * =================================================
                             *
                             * All ACF item data is now retrieved here.
                             */

                            $item_data = rm_get_menu_item_data(
                                $item_id
                            );


                            /*
                             * Keep the exact arguments expected by
                             * the existing product.php.
                             */

                            get_template_part(
                                'designs/' . RM_DESIGN . '/parts/product',
                                '',
                                array(

                                    'item_id' => $item_data['item_id'] ?? $item_id,

                                    'name_ar' => $item_data['name_ar'] ?? '',
                                    'name_en' => $item_data['name_en'] ?? '',

                                    'description_ar' =>
                                        $item_data['description_ar'] ?? '',

                                    'description_en' =>
                                        $item_data['description_en'] ?? '',

                                    'price' =>
                                        $item_data['price'] ?? '',

                                    'price_md' =>
                                        $item_data['price_md'] ?? '',

                                    'price_lg' =>
                                        $item_data['price_lg'] ?? '',

                                    'has_pizza_prices' =>
                                        $item_data['has_pizza_prices'] ?? false,

                                    'image' =>
                                        $item_data['image'] ?? '',

                                    'has_variation' =>
                                        $item_data['has_variation'] ?? false,

                                    'variations' =>
                                        $item_data['variations'] ?? array(),


               
                                )
                            );

                            ?>

            <?php endwhile; ?>

            <?php wp_reset_postdata(); ?>

            <?php else : ?>

            <div class="menu-empty">

                <?php
                            esc_html_e(
                                'No items available in this category.',
                                'restaurant-menu'
                            );
                            ?>

            </div>

            <?php endif; ?>

        </div>


        <a href="#top" class="move-top" aria-label="<?php esc_attr_e( 'Back to top', 'restaurant-menu' ); ?>">↑</a>
        <!-- <a href="#top" class="move-top"><i class="fa-regular fa-circle-up"></i></a> -->



    </section>

    <?php endforeach; ?>

    <?php else : ?>

    <div class="menu-empty">

        <?php
            esc_html_e(
                'No menu categories available.',
                'restaurant-menu'
            );
            ?>

    </div>

    <?php endif; ?>

</main>