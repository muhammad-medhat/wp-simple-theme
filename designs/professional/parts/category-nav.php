<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/*
* Get menu categories.
*/
$categories =$args['categories'] ?? rm_get_ordered_menu_categories();
$icon_options = rm_get_category_icon_options();
$icons_enabled = (bool)get_theme_mod('rm_enable_category_icons', true);
?>
<?php if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) : ?>
<nav class="category-navigation">
    <div class="category-navigation__inner">

        <?php if ( has_custom_logo() ) : ?>
        <div id="nav-logo" class="category-navigation__logo">
            <?php the_custom_logo();?>
        </div>
        <?php endif; ?>
        <div class="category-navigation__scroll">
            <?php foreach ( $categories as $index => $category ) : ?>
            <?php
                    $category_name_ar = get_field('name_ar', RM_MENU_CATEGORY_TAX . '_' . $category->term_id );
                    $category_name_en = get_field('name_en', RM_MENU_CATEGORY_TAX . '_' . $category->term_id );
                    $category_id = 'menu-category-' . $category->term_id;
                    $category_icon = $icons_enabled?get_term_meta(
                        $category->term_id,
                        'rm_category_icon',
                        true
                    ):'';
                    ?>
            <a href="#<?php echo esc_attr( $category_id ); ?>"
                class="category-link <?php echo 0 === $index ? 'active' : ''; ?>"
                data-category-id="<?php echo esc_attr( $category->term_id );?>"
                data-category-target=" <?php echo esc_attr( $category_id ); ?>">
                <?php 
                if (
                    isset( $icon_options[ $category_icon ] ) &&
                    ! empty( $icon_options[ $category_icon ]['file'] )
                ) {
                    $icon_url = RM_URL
                        . 'assets/images/category-icons/'
                        . $icon_options[ $category_icon ]['file'];
                    ?>
                <img class="rm-category-icon" src="<?php echo  $icon_url ; ?>" alt="" loading="lazy">
                <?php } //endif?>
                <span class="category-name-ar">
                    <?php //echo esc_html($category_name_ar ?: $category->name);?>
                    <?php echo wp_kses_post( rm_replace_c21_icon($category_name_ar) ?: $category->name );?>
                </span>
                <span class="category-name-en">
                    <?php echo wp_kses_post( rm_replace_c21_icon($category_name_en) ?: $category->name );?>
                </span>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</nav>
<?php endif; ?>