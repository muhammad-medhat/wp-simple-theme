<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


/*
 * =========================================================
 * CATEGORIES
 * =========================================================
 */

$categories = rm_get_ordered_menu_categories();
// $rm_category_icon = rm_get_category_icon_options();
$rm_category_icon = "";

?>

<main class="menu__content">
    <?php if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) : ?>
    <?php foreach ( $categories as $category ) : 
        $is_compact = (bool) get_field( 'is_compact', RM_MENU_CATEGORY_TAX . '_' . $category->term_id );
        $compact_class = $is_compact ? 'category--compact' : '';
    ?>
    <section id="<?php echo esc_attr( 'menu-category-' . $category->term_id ); ?>"
        class="menu-category category <?php echo esc_attr( $compact_class ); ?>">
        <!-- category -->
        <?php get_template_part( 'designs/'.RM_DESIGN."/parts/category",'', [
            'category' => $category, 
            'rm_category_icon' => $rm_category_icon,
            'is_compact' => $is_compact
        ]); ?>
        <!-- /category -->

        <a href="#top" class="move-top p-2 m-2"><i class="fa-regular fa-circle-up"></i></a>
        <!-- <span class="text-center d-block">──────── ୨୧ ୨୧ ────────</span> -->

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