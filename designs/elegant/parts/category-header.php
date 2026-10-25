<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$category = $args['category'] ?? null;

if ( ! $category ) {
    return;
}

$term_id = $category->term_id;

$name_ar = get_field('name_ar',RM_MENU_CATEGORY_TAX . '_' . $term_id);
$name_en = get_field('name_en',RM_MENU_CATEGORY_TAX . '_' . $term_id);
$desc_ar = get_field('desc_ar',RM_MENU_CATEGORY_TAX . '_' . $term_id);
$desc_en = get_field('desc_en',RM_MENU_CATEGORY_TAX . '_' . $term_id);
$category_image = get_field('category_image',RM_MENU_CATEGORY_TAX . '_' . $term_id);
$image_url = '';

if ( is_array( $category_image ) ) {
    $image_url = $category_image['url'] ?? '';
} elseif ( is_numeric( $category_image ) ) {
    $image_url = wp_get_attachment_image_url(
        (int) $category_image,
        'full'
    );
} elseif ( is_string( $category_image ) ) {
    $image_url = $category_image;
}
?>

<header class="category-banner" <?php if ( $image_url ) : ?>
    style="--category-image: url('<?php echo esc_url( $image_url ); ?>')" <?php endif; ?>>
    <div class="category-banner__overlay">
        <h2 class="category-banner__title">
            <?php if ( $name_ar ) : ?>
            <span class="category-name-ar">
                <?php echo wp_kses_post( rm_replace_c21_icon( $name_ar, "white" ) ); ?>
            </span>
            <?php endif; ?>

            <?php if ( $name_en ) : ?>
            <span class="category-name-en">
                <?php echo wp_kses_post( rm_replace_c21_icon( $name_en, "white" ) ); ?>
            </span>
            <?php endif; ?>
        </h2>

        <?php if ( $desc_ar || $desc_en ) : ?>
        <div class="category-banner__description">
            <?php if ( $desc_ar ) : ?>
            <p class="category-description-ar">
                <?php echo wp_kses_post( rm_replace_c21_icon( $desc_ar, "white" ) ); ?>
            </p>
            <?php endif; ?>

            <?php if ( $desc_en ) : ?>
            <p class="category-description-en">
                <?php echo wp_kses_post( rm_replace_c21_icon( $desc_en, "white" ) ); ?>
            </p>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</header>