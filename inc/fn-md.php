<?php
/**
 * functions to be included in my sites 
 */

//classic
add_filter('use_widgets_block_editor', '__return_false');
add_filter('use_block_editor_for_post', '__return_false');


// fetcher image
add_filter('manage_posts_columns', 'md_add_featured_image_column');
add_action('manage_posts_custom_column', 'md_show_featured_image_column', 10, 2);

// Add a new column to the posts admin table
function md_add_featured_image_column($columns)
{
    $columns = array_slice($columns, 0, 1, true)
        + array('featured_image' => __('Featured Image', 'md'))
        + array_slice($columns, 1, count($columns) - 1, true);
    return $columns;
}
// Populate the new column with the featured image
function md_show_featured_image_column($column_name, $post_id)
{
    if ($column_name === 'featured_image') {
        $post_thumbnail = get_the_post_thumbnail($post_id, array(50, 50)); // Set thumbnail size
        if ($post_thumbnail) {
            echo $post_thumbnail;
        } else {
            echo '—'; // Placeholder if no image
        }
    }
}
/************ price column *********************************** */
// 1. Add the custom column header to the Posts list table
function md_price_column( $columns ) {
    $columns['price_column'] = 'Price'; 
    return $columns;
}
add_filter( 'manage_'.RM_MENU_ITEM_CPT.'_posts_columns', 'md_price_column' );


// 2. Populate the rows of the custom column with the custom field data
function md_populate_price_column( $column, $post_id ) {
    // Check if we are currently filling our specific column
    if ( $column === 'price_column' ) {
        // Retrieve the custom field value for this specific post
        $price_value = get_post_meta( $post_id, 'price', true );
        
        // If the field isn't empty, display it. Otherwise, show a dash.
        if ( ! empty( $price_value ) ) {
            echo esc_html( $price_value );
        } else {
            echo '—';
        }
    }
}
add_action( "manage_" .RM_MENU_ITEM_CPT ."_posts_custom_column", 'md_populate_price_column', 10, 2 );