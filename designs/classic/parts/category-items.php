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
        
if ( $is_compact ) : ?>

<!-- COMPACT CATEGORY ITEMS -->
<div class="category__items">

    <?php if ( $items->have_posts() ) : ?>

    <?php while ( $items->have_posts() ) : $items->the_post(); 
                $item_id = get_the_ID();
                $name_ar = get_field( 'name_ar', $item_id );
                $name_en = get_field( 'name_en', $item_id );
                $price   = get_field( 'price', $item_id );
                ?>

    <article class="item">
        <!-- product content -->
        <div class="item__content">
            <div class="item__heading">
                <div class="item__name">
                    <?php if ( $name_en ) : ?>
                    <span class="menu-name-en">
                        <?php echo wp_kses_post( rm_replace_c21_icon( $name_en ) ); ?>
                    </span>
                    <?php endif; ?>

                    <?php if ( $name_ar ) : ?>
                    <span class="menu-name-ar">
                        <?php echo wp_kses_post( rm_replace_c21_icon( $name_ar ) ); ?>
                    </span>
                    <?php endif; ?>
                </div>
                <?php if ( $price !== '' && $price !== null ) : ?>
                <span class="menu-item__dots"></span>
                <span class="menu-item__price">
                    <?php echo esc_html( $price ); ?>
                </span>
                <?php endif; ?>
            </div><!-- item heading -->
        </div><!-- product content -->

    </article>

    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>

    <?php else : ?>

    <div class="menu-empty">
        <?php esc_html_e( 'No items available in this category.', 'restaurant-menu' ); ?>
    </div>

    <?php endif; ?>

</div>

<?php else : ?>

<!-- NORMAL CATEGORY ITEMS-->
<div class="category__items">
    <?php if ( $items->have_posts() ) : 
            while ( $items->have_posts() ) : 
                $items->the_post();
                $item_id   = get_the_ID();
                $item_data = rm_get_menu_item_data( $item_id );
                
                get_template_part(
                    'designs/' . RM_DESIGN . '/parts/product',
                    '',
                    array(

                    'item_data' => $item_data,
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
    <?php wp_reset_postdata(); ?>

    <?php else : ?>

    <div class="menu-empty">
        <?php esc_html_e( 'No items available in this category.', 'restaurant-menu' ); ?>
    </div>

    <?php endif; ?>

</div>

<?php endif; ?>