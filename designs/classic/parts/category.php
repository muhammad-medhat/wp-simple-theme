<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$category = $args['category'] ?? null;

if ( ! $category ) {
    return;
}
$is_compact = (bool) get_field( 'is_compact', RM_MENU_CATEGORY_TAX . '_' . $category->term_id );
$compact_class = $is_compact ? 'category--compact' : '';


$term_id = $category->term_id;
$term_key = RM_MENU_CATEGORY_TAX . '_' . $term_id;

$name_ar = get_field( 'name_ar', $term_key );
$name_en = get_field( 'name_en', $term_key );
$desc_ar = get_field( 'desc_ar', $term_key );
$desc_en = get_field( 'desc_en', $term_key );
$category_image = get_field( 'category_image', $term_key );

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
<!-- category header -->

<?php get_template_part( 'designs/'.RM_DESIGN."/parts/category-header",'', [
    'category' => $category, 
    'is_compact' => $is_compact
    ]); ?>

<!-- category items -->
<?php get_template_part( 'designs/'.RM_DESIGN."/parts/category-items",'', [
            'category' => $category, 
            'is_compact' => $is_compact
        ]); ?>