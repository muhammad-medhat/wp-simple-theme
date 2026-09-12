<?php 

/*
 * =========================================================
 * PIZZA SIZE SETTINGS
 * These values come from the ACF Options Page.
 * =========================================================
 */

$md_ar = get_field( 'md_ar', 'option' );
$md_en = get_field( 'md_en', 'option' );

$lg_ar = get_field( 'lg_ar', 'option' );
$lg_en = get_field( 'lg_en', 'option' );
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
);;?>

<main class="elegant-menu__content">
    <?php if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) : ?>
    <?php foreach ( $categories as $category ) : ?>
    <?php
                /*
                * -------------------------------------------------
                * CATEGORY FIELDS
                * -------------------------------------------------
                */
                $category_name_ar = get_field( 'name_ar', RM_MENU_CATEGORY_TAX . '_' . $category->term_id );
                $category_name_en = get_field( 'name_en', RM_MENU_CATEGORY_TAX . '_' . $category->term_id );
                $category_desc_ar = get_field('desc_ar', RM_MENU_CATEGORY_TAX . '_' . $category->term_id);
                $category_desc_en = get_field('desc_en', RM_MENU_CATEGORY_TAX . '_' . $category->term_id);
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
                                'terms'    => $category->term_id,
                            ),
                        ),
                        'orderby' => 'menu_order',
                        'order'   => 'ASC',
                    )
                );
                ?>
    <section id="<?php echo esc_attr( 'menu-category-' . $category->term_id ); ?>" class="elegant-category">
        <!-- =================================
                    CATEGORY HEADER
                    ================================= -->
        <header class="elegant-category__header">
            <h2 class="elegant-category__title">
                <span class="category-name-ar font-ar fw-700">
                    <?php
                                echo esc_html(
                                    $category_name_ar ?: $category->name
                                );
                                ?>
                </span>
                <span class="category-name-en font-en fw-700">
                    <?php
                                echo esc_html(
                                    $category_name_en ?: $category->name
                                );
                                ?>
                </span>
            </h2>
            <?php
                        if (
                            $category_desc_ar ||
                            $category_desc_en
                        ) :
                        ?>
            <div class="elegant-category__description">
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
            <div class="elegant-category__ornament">
                <span>──── ୨୧ ────</span>
                <!-- <span>✦✦✦</span> -->
            </div>
        </header>
        <!-- =================================
                CATEGORY ITEMS
                ================================= -->
        <div class="elegant-category__items">
            <?php if ( $items->have_posts() ) : ?>
            <?php while ( $items->have_posts() ) : ?>
            <?php
                        $items->the_post();
                        $item_id = get_the_ID();
                        // Item fields.
                        $name_ar = get_field('name_ar', $item_id);
                        $name_en = get_field('name_en', $item_id);
                        $description_ar = get_field('desc_ar',$item_id);
                        $description_en = get_field('desc_en',$item_id);
                        // Normal product price.                         
                        $price = get_field('price',$item_id);
                        //Pizza prices.
                        $price_md = get_field('price_md', $item_id);
                        $price_lg = get_field('price_lg', $item_id);
                        /*
                        * Determine whether this
                        * is a size-based product.
                        *
                        * In your current system,
                        * two prices mean Medium + Large.
                        */

                       $has_pizza_prices =
                           (
                               $price_md !== '' &&
                               $price_md !== null
                           ) ||
                           (
                               $price_lg !== '' &&
                               $price_lg !== null
                           );

                        //Product image.
                        $image = get_the_post_thumbnail_url($item_id,'medium');
                        ?>
            <!-- =================================
                PRODUCT
                ================================= -->
            <!-- <article class="elegant-item"> -->
            <article class="elegant-item <?php echo $has_pizza_prices ? 'elegant-item--sizes' : ''; ?>">
                <!-- Product Image -->
                <?php if ( $image ) : ?>
                <div class="elegant-item__image">
                    <img src="<?php echo esc_url( $image ); ?>"
                        alt="<?php echo esc_attr( $name_en ?: $name_ar ?: get_the_title() ); ?>" loading="lazy">
                </div>
                <?php endif; ?>
                <!-- Product Content -->
                <div class="elegant-item__content">
                    <div class="elegant-item__heading">
                        <h3 class="elegant-item__name">
                            <span class="menu-name-ar">
                                <?php echo esc_html( $name_ar ?: get_the_title() );?>
                            </span>
                            <span class="menu-name-en">
                                <?php echo esc_html($name_en ?: get_the_title() ); ?>
                            </span>
                        </h3>
                        <!-- =================================
                            NORMAL PRODUCT PRICE
                            ================================= -->

                        <?php if (  ! $has_pizza_prices && $price !== '' && $price !== null ) : ?>
                        <span class="elegant-item__price">
                            <?php echo esc_html( $price ); ?>
                        </span>
                        <?php endif; ?>
                    </div>
                    <!-- =================================
                        PRODUCT DESCRIPTION
                        ================================= -->
                    <?php
                            if ($description_ar || $description_en) : ?>
                    <div class="elegant-item__description">
                        <?php if ( $description_ar ) : ?>
                        <p class="menu-description-ar">
                            <?php echo esc_html($description_ar);?>
                        </p>
                        <?php endif; ?>
                        <?php if ( $description_en ) : ?>
                        <p class="menu-description-en">
                            <?php echo esc_html($description_en);?>
                        </p>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    <!-- =================================
                        PIZZA SIZE PRICES
                        ================================= -->

                    <?php if ($has_pizza_prices) : ?>

                    <div class="elegant-item__sizes">
                        <!-- Medium -->
                        <?php if ($price_md !== '' && $price_md !== null) : ?>
                        <div class="elegant-item__size">
                            <span class="elegant-item__size-name">
                                <span class="size-name-ar">
                                    <?php echo esc_html($md_ar ?: 'وسط'); ?>
                                </span>
                                <span class="size-name-en">
                                    <?php echo esc_html( $md_en ?: 'Medium'    ); ?>
                                </span>
                            </span>

                            <span class="elegant-item__size-price">
                                <?php echo esc_html($price_md);?>
                            </span>
                        </div>
                        <!-- elegant-item__size->
                            <?php endif; ?>
                            <!-- Large -->
                        <?php if ($price_lg !== '' && $price_lg !== null) : ?>
                        <div class="elegant-item__size">
                            <span class="elegant-item__size-name">
                                <span class="size-name-ar">
                                    <?php echo esc_html($lg_ar ?: 'كبير'); ?>
                                </span>
                                <span class="size-name-en">
                                    <?php echo esc_html( $lg_en ?: 'Large'    ); ?>
                                </span>
                            </span>
                            <span class="elegant-item__size-price">
                                <?php echo esc_html($price_lg);?>
                            </span>
                        </div>

                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </article>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
            <?php else : ?>
            <div class="menu-empty">
                <?php
                                esc_html_e(
                                    'No items available in this category.',
                                    'restaurant-menu'
                                );
                                ?>
            </div>
            <?php endif; ?>
        </div>
        <a href="#top" class="move-top"><i class="fa-regular fa-circle-up"></i></a>

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