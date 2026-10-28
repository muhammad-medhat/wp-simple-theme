<?php 
/**
 * category items
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
$category   = $args['category'] ?? null;
$is_compact = $args['is_compact'] ?? false;

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
                'terms'    => $category ? $category->term_id : 0,       
            ),
        ),
        'orderby'        => 'menu_order',   
        'order'          => 'ASC',
    )
);
?>

<!-- product CATEGORY ITEMS-->
<div class="category__items">
    <?php if ( $items->have_posts() ) : 
            while ( $items->have_posts() ) : 
                $items->the_post();
                $item_id   = get_the_ID();
                $item_data = rm_get_menu_item_data( $item_id );
                
                get_template_part(
                    'designs/' . RM_DESIGN . '/parts/product',
                    '',
                    ['item_data' => $item_data,'is_compact' => $is_compact]
                );
                ?>
    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>

    <?php else : ?>

    <div class="menu-empty">
        <?php esc_html_e( 'No items available in this category.', 'restaurant-menu' ); ?>
    </div>

    <?php endif; ?>

</div>