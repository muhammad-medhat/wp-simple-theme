<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


    $category=$args['category'];
    $cat_options=$args['rm_category_icon'];

    $category_name_ar = get_field( 'name_ar', RM_MENU_CATEGORY_TAX . '_' . $category->term_id );
    $category_name_en = get_field( 'name_en', RM_MENU_CATEGORY_TAX . '_' . $category->term_id );
    $category_desc_ar = get_field('desc_ar', RM_MENU_CATEGORY_TAX . '_' . $category->term_id);
    $category_desc_en = get_field('desc_en', RM_MENU_CATEGORY_TAX . '_' . $category->term_id);

    $category_icon = get_term_meta($category->term_id, 'rm_category_icon',  true);
    $base_url = trailingslashit( RM_URL ) . 'assets/img/category-icons/';

?>

<header class="category__header">
    <h2 class="category__title">
        <?php if ( $category_icon&& isset($cat_options['file']) && !empty($cat_options['file']) ) {
            $img=$cat_options['file']; ?>
        <img src="<?php echo esc_url( $base_url . '/'.$img ); ?>"
            alt="<?php echo esc_attr( $category_name_en ?: $category->name ); ?>" class="category__icon" loading="lazy">
        <?php } //endif?>
        <span class="category-name-ar font-ar fw-700">
            <?php //echo esc_html($category_name_ar ?: $category->name);?>
            <?php echo wp_kses_post( rm_replace_c21_icon($category_name_ar) ?: get_the_title() );?>
        </span>
        <span class="category-name-en font-en fw-700">
            <?php //echo esc_html($category_name_en ?: $category->name);?>
            <?php echo wp_kses_post( rm_replace_c21_icon($category_name_en) ?: get_the_title() );?>
        </span>
    </h2>
    <?php if ($category_desc_ar || $category_desc_en ) : ?>
    <div class="category__description">
        <?php if ( $category_desc_ar ) : ?>
        <p class="category-description-ar">
            <?php echo esc_html($category_desc_ar );?>
        </p>
        <?php endif; ?>
        <?php if ( $category_desc_en ) : ?>
        <p class="category-description-en">
            <?php echo esc_html($category_desc_en );?>
        </p>
        <?php endif; ?>
    </div>
    <?php endif; ?>
    <div class="category__ornament">
        <span>──── ୨୧ ────</span>
        <!-- <span>✦✦✦</span> -->
    </div>
</header>