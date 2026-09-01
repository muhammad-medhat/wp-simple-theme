<?php
<<<<<<< HEAD
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
=======

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


>>>>>>> e198f225a25b6f75da3673e16fff75b34d475906
/*
 * ================================================
 * RESTAURANT INFORMATION
 * ================================================
 */
<<<<<<< HEAD
$restaurant_name = get_bloginfo( 'name' );
$restaurant_description = get_bloginfo(
    'description'
);
=======

$restaurant_name = get_bloginfo( 'name' );

$restaurant_description = get_bloginfo(
    'description'
);


>>>>>>> e198f225a25b6f75da3673e16fff75b34d475906
/*
 * ================================================
 * LOGO
 * ================================================
 */
<<<<<<< HEAD
$has_logo = has_custom_logo();
=======

$has_logo = has_custom_logo();


>>>>>>> e198f225a25b6f75da3673e16fff75b34d475906
/*
 * ================================================
 * CATEGORIES
 * ================================================
 */
<<<<<<< HEAD
=======

>>>>>>> e198f225a25b6f75da3673e16fff75b34d475906
$categories = get_terms(
    array(
        'taxonomy'   => RM_MENU_CATEGORY_TAX,
        'hide_empty' => true,
        'orderby'    => 'term_order',
        'order'      => 'ASC',
    )
);
<<<<<<< HEAD
?>
<!-- =================================================
     MODERN HEADER
================================================= -->
<header class="restaurant-header">
    <div class="restaurant-header__inner container">
        <!-- Logo -->
        <div class="restaurant-header__logo">
            <?php if ( $has_logo ) : ?>
            <?php the_custom_logo(); ?>
            <?php else : ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="restaurant-header__logo-placeholder"
                aria-label="<?php echo esc_attr( $restaurant_name ); ?>">
=======

?>

<!-- =================================================
     MODERN HEADER
================================================= -->

<header class="restaurant-header">

    <div class="restaurant-header__inner container">

        <!-- Logo -->

        <div class="restaurant-header__logo">

            <?php if ( $has_logo ) : ?>

            <?php the_custom_logo(); ?>

            <?php else : ?>

            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="restaurant-header__logo-placeholder"
                aria-label="<?php echo esc_attr( $restaurant_name ); ?>">

>>>>>>> e198f225a25b6f75da3673e16fff75b34d475906
                <?php
                    echo esc_html(
                        mb_substr(
                            $restaurant_name,
                            0,
                            1
                        )
                    );
                    ?>
<<<<<<< HEAD
            </a>
            <?php endif; ?>
        </div>
        <!-- Restaurant information -->
        <div class="restaurant-header__identity">
            <h1 class="restaurant-header__name">
                <?php echo esc_html( $restaurant_name ); ?>
            </h1>
            <?php if ( $restaurant_description ) : ?>
            <p class="restaurant-header__description">
=======

            </a>

            <?php endif; ?>

        </div>


        <!-- Restaurant information -->

        <div class="restaurant-header__identity">

            <h1 class="restaurant-header__name">

                <?php echo esc_html( $restaurant_name ); ?>

            </h1>


            <?php if ( $restaurant_description ) : ?>

            <p class="restaurant-header__description">

>>>>>>> e198f225a25b6f75da3673e16fff75b34d475906
                <?php
                    echo esc_html(
                        $restaurant_description
                    );
                    ?>
<<<<<<< HEAD
            </p>
            <?php endif; ?>
        </div>
        <!-- Language -->
        <div class="restaurant-header__language">
=======

            </p>

            <?php endif; ?>

        </div>


        <!-- Language -->

        <div class="restaurant-header__language">

>>>>>>> e198f225a25b6f75da3673e16fff75b34d475906
            <button type="button" class="language-switcher" id="language-switcher" aria-label="<?php esc_attr_e(
                    'Change language',
                    'restaurant-menu'
                ); ?>">
<<<<<<< HEAD
                <span class="language-switcher__option" data-language="ar">
                    عربي
                </span>
                <span class="language-switcher__option" data-language="en">
                    EN
                </span>
                <span class="language-switcher__indicator" aria-hidden="true"></span>
            </button>
        </div>
    </div>
</header>
<!-- =================================================
     CATEGORY NAVIGATION
================================================= -->
<?php if ( ! is_wp_error( $categories ) && $categories ) : ?>
=======

                <span class="language-switcher__option" data-language="ar">
                    عربي
                </span>

                <span class="language-switcher__option" data-language="en">
                    EN
                </span>

                <span class="language-switcher__indicator" aria-hidden="true"></span>

            </button>

        </div>

    </div>

</header>


<!-- =================================================
     CATEGORY NAVIGATION
================================================= -->

<?php if ( ! is_wp_error( $categories ) && $categories ) : ?>

>>>>>>> e198f225a25b6f75da3673e16fff75b34d475906
<nav class="category-navigation" aria-label="<?php esc_attr_e(
            'Menu categories',
            'restaurant-menu'
        ); ?>">
<<<<<<< HEAD
    <div class="category-navigation__scroll container">
        <?php foreach ( $categories as $index => $category ) : ?>
        <?php
                $category_id = 'menu-category-' . $category->term_id;
=======

    <div class="category-navigation__scroll container">

        <?php foreach ( $categories as $index => $category ) : ?>

        <?php

                $category_id = 'menu-category-' . $category->term_id;

>>>>>>> e198f225a25b6f75da3673e16fff75b34d475906
                $category_name_ar = get_field(
                    'name_ar',
                    RM_MENU_CATEGORY_TAX . '_' . $category->term_id
                );
<<<<<<< HEAD
=======

>>>>>>> e198f225a25b6f75da3673e16fff75b34d475906
                $category_name_en = get_field(
                    'name_en',
                    RM_MENU_CATEGORY_TAX . '_' . $category->term_id
                );
<<<<<<< HEAD
                ?>
        <a href="#<?php echo esc_attr( $category_id ); ?>"
            class="category-link<?php echo 0 === $index ? ' active' : ''; ?>"
            data-category-target="<?php echo esc_attr( $category_id ); ?>">
=======

                ?>

        <a href="#<?php echo esc_attr( $category_id ); ?>"
            class="category-link<?php echo 0 === $index ? ' active' : ''; ?>"
            data-category-target="<?php echo esc_attr( $category_id ); ?>">

>>>>>>> e198f225a25b6f75da3673e16fff75b34d475906
            <span class="category-name-ar">
                <?php
                        echo esc_html(
                            $category_name_ar ?: $category->name
                        );
                        ?>
            </span>
<<<<<<< HEAD
=======

>>>>>>> e198f225a25b6f75da3673e16fff75b34d475906
            <span class="category-name-en">
                <?php
                        echo esc_html(
                            $category_name_en ?: $category->name
                        );
                        ?>
            </span>
<<<<<<< HEAD
        </a>
        <?php endforeach; ?>
    </div>
</nav>
<?php endif; ?>
<!-- =================================================
     MENU CONTENT
================================================= -->
<main class="menu-design__content">
    <?php if ( ! is_wp_error( $categories ) && $categories ) : ?>
    <?php foreach ( $categories as $category ) : ?>
    <?php
            $category_id = 'menu-category-' . $category->term_id;
=======

        </a>

        <?php endforeach; ?>

    </div>

</nav>

<?php endif; ?>


<!-- =================================================
     MENU CONTENT
================================================= -->

<main class="menu-design__content">

    <?php if ( ! is_wp_error( $categories ) && $categories ) : ?>

    <?php foreach ( $categories as $category ) : ?>

    <?php

            $category_id = 'menu-category-' . $category->term_id;


>>>>>>> e198f225a25b6f75da3673e16fff75b34d475906
            $category_name_ar = get_field(
                'name_ar',
                RM_MENU_CATEGORY_TAX . '_' . $category->term_id
            );
<<<<<<< HEAD
=======

>>>>>>> e198f225a25b6f75da3673e16fff75b34d475906
            $category_name_en = get_field(
                'name_en',
                RM_MENU_CATEGORY_TAX . '_' . $category->term_id
            );
<<<<<<< HEAD
            /*
             * Get menu items
             */
=======


            /*
             * Get menu items
             */

>>>>>>> e198f225a25b6f75da3673e16fff75b34d475906
            $items = new WP_Query(
                array(
                    'post_type'      => RM_MENU_ITEM_CPT,
                    'posts_per_page' => -1,
                    'post_status'    => 'publish',
<<<<<<< HEAD
=======

>>>>>>> e198f225a25b6f75da3673e16fff75b34d475906
                    'tax_query'      => array(
                        array(
                            'taxonomy' => RM_MENU_CATEGORY_TAX,
                            'field'    => 'term_id',
                            'terms'    => $category->term_id,
                        ),
                    ),
<<<<<<< HEAD
=======

>>>>>>> e198f225a25b6f75da3673e16fff75b34d475906
                    'orderby' => 'menu_order',
                    'order'   => 'ASC',
                )
            );
<<<<<<< HEAD
            ?>
    <section id="<?php echo esc_attr( $category_id ); ?>" class="menu-category">
        <!-- Category heading -->
        <header class="menu-category__header">
            <h2 class="menu-category__title">
                <span class="category-name-ar">
                    <?php echo esc_html($category_name_ar ?: $category->name); ?>
                </span>
                <span class="category-name-en">
                    <?php echo esc_html($category_name_en ?: $category->name); ?>
                </span>
            </h2>
        </header>
        <!-- Items -->
        <?php if ( $items->have_posts() ) : ?>
        <div class="menu-category__items">
            <?php while ( $items->have_posts() ) : ?>
            <?php $items->the_post(); ?>
            <?php
                $item_id = get_the_ID();
                $name_ar = get_field(
                    'name_ar',
                    $item_id
                );
                $name_en = get_field(
                    'name_en',
                    $item_id
                );
                $description_ar = get_field(
                    'desc_ar',
                    $item_id
                );
                $description_en = get_field(
                    'desc_en',
                    $item_id
                );
                $price = get_field(
                    'price',
                    $item_id
                );
                $image = get_the_post_thumbnail_url(
                    $item_id,
                    'medium'
                );
                ?>
            <article class="menu-item-card">
                <?php if ( $image ) : ?>
                <div class="menu-item-card__image">
                    <img src="<?php echo esc_url( $image ); ?>"
                        alt="<?php echo esc_attr( $name_en ?: get_the_title() ); ?>" loading="lazy">
                </div>
                <?php endif; ?>
                <div class="menu-item-card__content">
                    <div class="menu-item-card__top">
                        <h3 class="menu-item-card__name">
                            <span class="menu-name-ar">
                                <?php echo esc_html($name_ar ?: get_the_title()  ); ?>
                            </span>
                            <span class="menu-name-en">
                                <?php echo esc_html($name_en ?: get_the_title()  ); ?>
                            </span>
                        </h3>
                        <?php if ( $price !== '' && $price !== null ) : ?>
                        <span class="menu-item-card__price">
                            <?php echo esc_html( $price );?>
                        </span>
                        <?php endif; ?>
                    </div>
                    <?php if ( $description_ar || $description_en ) : ?>
                    <div class="menu-item-card__description">
                        <?php if ( $description_ar ) : ?>
                        <span class="menu-description-ar">
                            <?php echo esc_html($description_ar ); ?>

                        </span>
                        <?php endif; ?>
                        <?php if ( $description_en ) : ?>
                        <span class="menu-description-en">
                            <?php echo esc_html($description_en  ); ?>

                        </span>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </article>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
    </section>
    <?php endforeach; ?>
    <?php else : ?>
    <div class="menu-empty">
=======

            ?>

    <section id="<?php echo esc_attr( $category_id ); ?>" class="menu-category">

        <!-- Category heading -->

        <header class="menu-category__header">

            <h2 class="menu-category__title">

                <span class="category-name-ar">

                    <?php
                            echo esc_html(
                                $category_name_ar ?: $category->name
                            );
                            ?>

                </span>

                <span class="category-name-en">

                    <?php
                            echo esc_html(
                                $category_name_en ?: $category->name
                            );
                            ?>

                </span>

            </h2>

        </header>


        <!-- Items -->

        <?php if ( $items->have_posts() ) : ?>

        <div class="menu-category__items">

            <?php while ( $items->have_posts() ) : ?>

            <?php $items->the_post(); ?>

            <?php

                            $item_id = get_the_ID();


                            $name_ar = get_field(
                                'name_ar',
                                $item_id
                            );

                            $name_en = get_field(
                                'name_en',
                                $item_id
                            );


                            $description_ar = get_field(
                                'desc_ar',
                                $item_id
                            );

                            $description_en = get_field(
                                'desc_en',
                                $item_id
                            );


                            $price = get_field(
                                'price',
                                $item_id
                            );


                            $image = get_the_post_thumbnail_url(
                                $item_id,
                                'medium'
                            );

                            ?>

            <article class="menu-item-card">

                <?php if ( $image ) : ?>

                <div class="menu-item-card__image">

                    <img src="<?php echo esc_url( $image ); ?>"
                        alt="<?php echo esc_attr( $name_en ?: get_the_title() ); ?>" loading="lazy">

                </div>

                <?php endif; ?>


                <div class="menu-item-card__content">

                    <div class="menu-item-card__top">

                        <h3 class="menu-item-card__name">

                            <span class="menu-name-ar">

                                <?php
                                                echo esc_html(
                                                    $name_ar ?: get_the_title()
                                                );
                                                ?>

                            </span>

                            <span class="menu-name-en">

                                <?php
                                                echo esc_html(
                                                    $name_en ?: get_the_title()
                                                );
                                                ?>

                            </span>

                        </h3>


                        <?php if ( $price !== '' && $price !== null ) : ?>

                        <span class="menu-item-card__price">

                            <?php
                                                echo esc_html(
                                                    $price
                                                );
                                                ?>

                        </span>

                        <?php endif; ?>

                    </div>


                    <?php if ( $description_ar || $description_en ) : ?>

                    <div class="menu-item-card__description">

                        <?php if ( $description_ar ) : ?>

                        <span class="menu-description-ar">

                            <?php
                                                    echo esc_html(
                                                        $description_ar
                                                    );
                                                    ?>

                        </span>

                        <?php endif; ?>


                        <?php if ( $description_en ) : ?>

                        <span class="menu-description-en">

                            <?php
                                                    echo esc_html(
                                                        $description_en
                                                    );
                                                    ?>

                        </span>

                        <?php endif; ?>

                    </div>

                    <?php endif; ?>

                </div>

            </article>

            <?php endwhile; ?>

        </div>

        <?php endif; ?>


        <?php wp_reset_postdata(); ?>

    </section>

    <?php endforeach; ?>

    <?php else : ?>

    <div class="menu-empty">

>>>>>>> e198f225a25b6f75da3673e16fff75b34d475906
        <p>
            <?php esc_html_e(
                    'No menu categories available.',
                    'restaurant-menu'
                ); ?>
        </p>
<<<<<<< HEAD
    </div>
    <?php endif; ?>
=======

    </div>

    <?php endif; ?>

>>>>>>> e198f225a25b6f75da3673e16fff75b34d475906
</main>