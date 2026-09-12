<?php 
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
);?>
<?php if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) : ?>
<nav class="elegant-category-navigation">
    <div class="elegant-category-navigation__inner">

        <?php if ( has_custom_logo() ) : ?>
        <div class="elegant-category-navigation__logo">
            <?php the_custom_logo();?>
        </div>
        <?php endif; ?>
        <div class="elegant-category-navigation__scroll">
            <?php foreach ( $categories as $index => $category ) : ?>
            <?php
                    $category_name_ar = get_field('name_ar', RM_MENU_CATEGORY_TAX . '_' . $category->term_id );
                    $category_name_en = get_field('name_en', RM_MENU_CATEGORY_TAX . '_' . $category->term_id );
                    $category_id = 'menu-category-' . $category->term_id;
                    ?>
            <a href="#<?php echo esc_attr( $category_id ); ?>"
                class="category-link <?php echo 0 === $index ? 'active' : ''; ?>"
                data-category-target="<?php echo esc_attr( $category_id ); ?>">
                <span class="category-name-ar">
                    <?php echo esc_html($category_name_ar ?: $category->name);?>
                </span>
                <span class="category-name-en">
                    <?php echo esc_html($category_name_en ?: $category->name);?>
                </span>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</nav>
<?php endif; ?>