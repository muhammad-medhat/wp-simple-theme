<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


/*
 * =========================================================
 * PIZZA SIZE SETTINGS
 * =========================================================
 */

$sm_ar = get_theme_mod(
    'rm_size_sm_ar',
    'صغير'
);

$sm_en = get_theme_mod(
    'rm_size_sm_en',
    'Small'
);

$md_ar = get_theme_mod(
    'rm_size_md_ar',
    'وسط'
);

$md_en = get_theme_mod(
    'rm_size_md_en',
    'Medium'
);

$lg_ar = get_theme_mod(
    'rm_size_lg_ar',
    'كبير'
);

$lg_en = get_theme_mod(
    'rm_size_lg_en',
    'Large'
);


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
                             * -------------------------------------------------
                             * BASIC ITEM DATA
                             * -------------------------------------------------
                             */

                            $name_ar = get_field(
                                'name_ar',
                                $item_id
                            );

                            $name_en = get_field(
                                'name_en',
                                $item_id
                            );

                            $description_ar = get_field(
                                'desc_ar',
                                $item_id
                            );

                            $description_en = get_field(
                                'desc_en',
                                $item_id
                            );

                            $price = get_field(
                                'price',
                                $item_id
                            );


                            /*
                             * -------------------------------------------------
                             * PIZZA PRICES
                             * -------------------------------------------------
                             */

                            $price_md = get_field(
                                'price_md',
                                $item_id
                            );

                            $price_lg = get_field(
                                'price_lg',
                                $item_id
                            );

                            $has_pizza_prices =
                                (
                                    $price_md !== ''
                                    &&
                                    $price_md !== null
                                )
                                ||
                                (
                                    $price_lg !== ''
                                    &&
                                    $price_lg !== null
                                );


                            /*
                             * -------------------------------------------------
                             * IMAGE
                             * -------------------------------------------------
                             */

                            $image = get_the_post_thumbnail_url(
                                $item_id,
                                'medium'
                            );

                            if ( ! $image ) {

                                $image = get_field(
                                    'item_image',
                                    $item_id
                                );

                            }


                            /*
                             * -------------------------------------------------
                             * VARIATIONS
                             * -------------------------------------------------
                             */

                            $has_variation = get_field(
                                'has_variation',
                                $item_id
                            );

                            $variations = array();

                            if ( $has_variation ) {

                                $var1_desc_ar = get_field(
                                    'var1_desc_ar',
                                    $item_id
                                );

                                $var1_desc_en = get_field(
                                    'var1_desc_en',
                                    $item_id
                                );

                                $var1_price = get_field(
                                    'var1_price',
                                    $item_id
                                );


                                $var2_desc_ar = get_field(
                                    'var2_desc_ar',
                                    $item_id
                                );

                                $var2_desc_en = get_field(
                                    'var2_desc_en',
                                    $item_id
                                );

                                $var2_price = get_field(
                                    'var2_price',
                                    $item_id
                                );


                                if (
                                    $var1_desc_ar
                                    ||
                                    $var1_desc_en
                                    ||
                                    $var1_price !== ''
                                ) {

                                    $variations[] = array(
                                        'desc_ar' => $var1_desc_ar,
                                        'desc_en' => $var1_desc_en,
                                        'price'   => $var1_price,
                                    );

                                }


                                if (
                                    $var2_desc_ar
                                    ||
                                    $var2_desc_en
                                    ||
                                    $var2_price !== ''
                                ) {

                                    $variations[] = array(
                                        'desc_ar' => $var2_desc_ar,
                                        'desc_en' => $var2_desc_en,
                                        'price'   => $var2_price,
                                    );

                                }

                            }

                            ?>


            <?php

                            get_template_part(
                                'designs/' . RM_DESIGN . '/parts/product',
                                '',
                                array(
                                    'item_id'          => $item_id,

                                    'name_ar'          => $name_ar,
                                    'name_en'          => $name_en,

                                    'description_ar'  => $description_ar,
                                    'description_en'  => $description_en,

                                    'price'            => $price,

                                    'price_md'         => $price_md,
                                    'price_lg'         => $price_lg,

                                    'has_pizza_prices' => $has_pizza_prices,

                                    'image'            => $image,

                                    'has_variation'    => $has_variation,
                                    'variations'       => $variations,

                                    'sm_ar'             => $sm_ar,
                                    'sm_en'             => $sm_en,

                                    'md_ar'             => $md_ar,
                                    'md_en'             => $md_en,

                                    'lg_ar'             => $lg_ar,
                                    'lg_en'             => $lg_en,
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


        <a href="#top" class="move-top" aria-label="<?php esc_attr_e( 'Back to top', 'restaurant-menu' ); ?>">
            ↑
        </a>


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