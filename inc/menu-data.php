<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


/**
 * =========================================================
 * GET MENU ITEM DATA
 * =========================================================
 *
 * Centralizes all ACF/data retrieval for menu items.
 *
 * IMPORTANT:
 * The returned structure intentionally matches the
 * existing arguments used by the design product templates.
 *
 * @param int|WP_Post $post Post ID or WP_Post object.
 * @return array
 */
function rm_get_menu_item_data( $post = null ) {

    $post = get_post( $post );

    if ( ! $post ) {
        return array();
    }

    $item_id = $post->ID;


    /*
     * =========================================================
     * BASIC ITEM DATA
     * =========================================================
     */

     $name_ar = get_field('name_ar',$item_id);
     $name_en = get_field('name_en',$item_id);
     $description_ar = get_field('desc_ar',$item_id);
     $description_en = get_field('desc_en',$item_id);
     $price = get_field('price',$item_id);


    /*
     * =========================================================
     * PIZZA PRICES
     * =========================================================
     */

     $price_md = get_field('price_md',$item_id);

     $price_lg = get_field('price_lg',$item_id);


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
     * =========================================================
     * IMAGE
     * =========================================================
     *
     * Keep the same logic as the existing main-cont.php:
     *
     * 1. Featured image
     * 2. ACF item_image fallback
     *
     */

    $image = get_the_post_thumbnail_url(
        $item_id,
        'medium'
    );

    if ( ! $image ) {

         $image = get_field('item_image',$item_id);
    }


    /*
     * =========================================================
     * VARIATIONS
     * =========================================================
     */

     $has_variation = get_field('has_variation',$item_id);

    $variations = array();

    if ( $has_variation ) {

        /*
         * Variation 1
         */

         $var1_desc_ar = get_field('var1_desc_ar',$item_id);

         $var1_desc_en = get_field('var1_desc_en',$item_id);

         $var1_price = get_field('var1_price',$item_id);


        /*
         * Variation 2
         */

         $var2_desc_ar = get_field('var2_desc_ar',$item_id);

         $var2_desc_en = get_field('var2_desc_en',$item_id);

         $var2_price = get_field('var2_price',$item_id);


        /*
         * Add variation 1
         */

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


        /*
         * Add variation 2
         */

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


    /*
     * =========================================================
     * RETURN NORMALIZED DATA
     * =========================================================
     */

    return array(

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

        'has_variation' => $has_variation,
        'variations' => $variations,
    );
}