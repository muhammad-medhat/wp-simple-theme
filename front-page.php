<?php get_header(); 
    $design = get_theme_mod(
        'rm_menu_design',
        'modern'
    );
?>

<div class="menu-design menu-design--<?php echo esc_attr( $design ); ?>"
    data-menu-design="<?php echo esc_attr( $design ); ?>"></div>
<?php

/*
* Category navigation
*/
get_template_part(
    'template-parts/menu/category-nav'
    );


/*
 * Get categories
 */
$categories = get_terms(
    array(
        'taxonomy'   => RM_MENU_CATEGORY_TAX,
        'hide_empty' => true,
        'orderby'    => 'term_order',
        'order'      => 'ASC',
    )
    );
    
    ?>

<main class="menu-design__content">


    <?php if ( ! is_wp_error( $categories ) && $categories ) : ?>

    <?php foreach ( $categories as $category ) : ?>

    <?php
                get_template_part(
                    'template-parts/menu/category',
                    null,
                    array(
                        'category' => $category,
                    )
                );
                ?>

    <?php endforeach; ?>

    <?php else : ?>

    <div class="menu-empty">

        <p>
            <?php esc_html_e(
                        'No menu categories available.',
                        'restaurant-menu'
                        ); ?>
        </p>

    </div>

    <?php endif; ?>


</main>
</div>

<?php get_footer(); ?>