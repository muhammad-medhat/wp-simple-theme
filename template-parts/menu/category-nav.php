<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/*
 * Get all menu categories.
 */
$categories = get_terms(
    array(
        'taxonomy'   => RM_MENU_CATEGORY_TAX,
        'hide_empty' => true,
        'orderby'    => 'term_order',
        'order'      => 'ASC',
    )
);

if ( is_wp_error( $categories ) || empty( $categories ) ) {
    return;
}

?>

<nav class="category-navigation" aria-label="<?php esc_attr_e( 'Menu Categories', 'restaurant-menu' ); ?>">

    <div class="container">

        <div class="category-navigation__scroll" id="category-navigation">

            <?php foreach ( $categories as $index => $category ) : ?>
            <?php
                $name_ar = get_field('name_ar',  RM_MENU_CATEGORY_TAX . '_' . $category->term_id);
                $name_en = get_field('name_en', RM_MENU_CATEGORY_TAX . '_' . $category->term_id);
            ?>

            <a href="#category-<?php echo esc_attr( $category->term_id ); ?>"
                class="category-link <?php echo 0 === $index ? 'active' : ''; ?>"
                data-category="<?php echo esc_attr( $category->term_id ); ?>">

                <span class="category-name category-name-ar">
                    <?php echo esc_html( $name_ar ); ?>
                </span>

                <span class="category-name category-name-en">
                    <?php echo esc_html( $name_en ); ?>
                </span>

            </a>

            <?php endforeach; ?>

        </div>

    </div>

</nav>