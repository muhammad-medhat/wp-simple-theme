<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


/*
 * =========================================================
 * PIZZA SIZE LABELS
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
 *
 * This uses the category order saved by the plugin.
 */

$categories = function_exists(
    'rm_get_ordered_menu_categories'
)
    ? rm_get_ordered_menu_categories()
    : get_terms(
        array(
            'taxonomy'   => RM_MENU_CATEGORY_TAX,
            'hide_empty' => true,
        )
    );


if ( is_wp_error( $categories ) ) {
    $categories = array();
}

?>

<main class="bilingual-menu">

    <?php foreach ( $categories as $category ) : ?>

    <?php

        /*
         * Category header.
         */
        get_template_part(
            'designs/bilingual/parts/category-header',
            null,
            array(
                'category' => $category,
            )
        );


        /*
         * Get items belonging to this category.
         */
        $items = new WP_Query(
            array(
                'post_type'      => RM_MENU_ITEM_CPT,
                'posts_per_page' => -1,
                'post_status'    => 'publish',

                'tax_query' => array(
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

        ?>

    <?php if ( $items->have_posts() ) : ?>

    <div class="bilingual-category-items">

        <?php while ( $items->have_posts() ) : ?>

        <?php $items->the_post(); ?>

        <?php

                    $item_data =
                        rm_get_menu_item_data(
                            get_the_ID()
                        );

                    /*
                     * Add size labels.
                     */
                    $item_data['sm_ar'] = $sm_ar;
                    $item_data['sm_en'] = $sm_en;

                    $item_data['md_ar'] = $md_ar;
                    $item_data['md_en'] = $md_en;

                    $item_data['lg_ar'] = $lg_ar;
                    $item_data['lg_en'] = $lg_en;

                    ?>

        <?php
                    get_template_part(
                        'designs/bilingual/parts/product',
                        null,
                        $item_data
                    );
                    ?>

        <?php endwhile; ?>

    </div>

    <?php endif; ?>

    <?php wp_reset_postdata(); ?>

    <?php endforeach; ?>

</main>