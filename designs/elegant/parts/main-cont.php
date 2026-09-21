<?php 

/*
 * =========================================================
 * PIZZA SIZE SETTINGS
 * These values come from the ACF Options Page.
 * =========================================================
 */

$sm_ar = get_theme_mod( 'rm_size_sm_ar', 'صغير' );
$sm_en = get_theme_mod( 'rm_size_sm_en', 'Small' );

$md_ar = get_theme_mod( 'rm_size_md_ar', 'وسط' );
$md_en = get_theme_mod( 'rm_size_md_en', 'Medium' );

$lg_ar = get_theme_mod( 'rm_size_lg_ar', 'كبير' );
$lg_en = get_theme_mod( 'rm_size_lg_en', 'Large' );

/*
 * Get menu categories.
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

<main class="elegant-menu__content">
    <?php if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) : ?>
    <?php foreach ( $categories as $category ) : ?>
    <?php

    $is_compact = (bool) get_field( 'is_compact', RM_MENU_CATEGORY_TAX . '_' . $category->term_id );
        /*
            * -------------------------------------------------
            * QUERY MENU ITEMS
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
        $compact_class = $is_compact ? 'elegant-category--compact' : '';
        ?>
    <section id="<?php echo esc_attr( 'menu-category-' . $category->term_id ); ?>"
        class="menu-category elegant-category <?php echo esc_attr( $compact_class ); ?>">
        <!-- =================================
            CATEGORY HEADER
            ================================= -->
        <?php get_template_part( 'designs/'.RM_DESIGN."/parts/category-header",'', array('category' => $category) );?>

        <!-- =================================
            CATEGORY ITEMS
            ================================= -->
        <div class="elegant-category__items">
            <?php if ( $items->have_posts() ) : ?>
            <?php while ( $items->have_posts() ) : ?>
            <?php
                        $items->the_post();
                        $item_id = get_the_ID();
                        // Item fields.
                        $name_ar = get_field('name_ar', $item_id);
                        $name_en = get_field('name_en', $item_id);
                        $description_ar = get_field('desc_ar',$item_id);
                        $description_en = get_field('desc_en',$item_id);
                        // Normal product price.                         
                        $price = get_field('price',$item_id);
                        //Pizza prices.
                        $price_md = get_field('price_md', $item_id);
                        $price_lg = get_field('price_lg', $item_id);
                        /*
                        * Determine whether this
                        * is a size-based product.
                        *
                        * In your current system,
                        * two prices mean Medium + Large.
                        */

                       $has_pizza_prices =
                           (
                               $price_md !== '' &&
                               $price_md !== null
                           ) ||
                           (
                               $price_lg !== '' &&
                               $price_lg !== null
                           );

                        //Product image.
                        $image = get_the_post_thumbnail_url($item_id,'medium');
                        !isset($image) ? $image = get_field('item_image', $item_id) : $image = $image;
                        $has_variation=get_field('has_variation', $item_id);
                        //non pizza variations
                        $var1_desc_ar = get_field( 'var1_desc_ar', $item_id );
                        $var1_desc_en = get_field( 'var1_desc_en', $item_id );
                        $var1_price   = get_field( 'var1_price', $item_id );

                        $var2_desc_ar = get_field( 'var2_desc_ar', $item_id );
                        $var2_desc_en = get_field( 'var2_desc_en', $item_id );
                        $var2_price   = get_field( 'var2_price', $item_id );
                        if($has_variation){
                            $variations = array(
                                array(
                                    'desc_ar' => $var1_desc_ar,
                                    'desc_en' => $var1_desc_en,
                                    'price'   => $var1_price,
                                    ),
                                    array(
                                        'desc_ar' => $var2_desc_ar,
                                        'desc_en' => $var2_desc_en,
                                        'price'   => $var2_price,
                                        ));
                            }
                        ?>
            <!-- =================================
                PRODUCT
                ================================= -->
            <?php get_template_part( 'designs/'.RM_DESIGN."/parts/product",
                '' ,
                array(
                    'item_id' => $item_id,
                    'name_ar' => $name_ar,
                    'name_en' => $name_en,
                    'description_ar' => $description_ar,
                    'description_en' => $description_en,
                    'price' => $price,
                    'price_md' => $price_md,
                    'price_lg' => $price_lg,
                    'has_pizza_prices' => $has_pizza_prices,
                    'image' => $image,
                    'has_variation'=>$has_variation,
                    'variations'=>isset($variations)?$variations:[], 
                    'sm_ar'=>$sm_ar,
                    'sm_en'=>$sm_en,        
                    'md_ar'=>$md_ar,
                    'md_en'=>$md_en,
                    'lg_ar'=>$lg_ar,
                    'lg_en'=>$lg_en,
                ) );?>
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
        <a href="#top" class="move-top"><i class="fa-regular fa-circle-up"></i></a>
        <span class="text-center d-block">──────── ୨୧ ୨୧ ────────</span>

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