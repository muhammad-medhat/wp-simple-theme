<?php 
/*
* Restaurant information.
*/
$restaurant_name_ar = get_theme_mod('rm_restaurant_name_ar', get_bloginfo( 'name' ));
$restaurant_name_en = get_theme_mod('rm_restaurant_name_en', get_bloginfo( 'name' ));
$restaurant_description_ar = get_theme_mod('rm_restaurant_description_ar', get_bloginfo( 'description' ));
$restaurant_description_en = get_theme_mod('rm_restaurant_description_en', get_bloginfo( 'description' ));

$lang_mode = get_theme_mod('rm_menu_language_mode', 'bi');
/*
 * Restaurant logo.
 */
$has_logo = has_custom_logo();?>
<header class="elegant-header" name="#header">
    <div class="elegant-header__inner">
        <?php if ( $has_logo ) : ?>
        <div class="elegant-header__logo">
            <?php the_custom_logo(); ?>
        </div>
        <?php else : ?>
        <div class="elegant-header__logo-placeholder">
            <span>✦✦✦</span>
        </div>
        <?php endif; ?>
        <div class="elegant-header__ornament">
            <span>✦✦✦</span>
        </div>
        <!-- ================================= -->
        <!-- Restaurant Name -->
        <!-- ================================= -->
        <?php if ( $restaurant_name_ar||$restaurant_name_en ) : ?>
        <h1 class="elegant-header__name">
            <?php if ( $lang_mode === 'bi' ) :  //show both names?>
            <span class="restaurant-name-ar ">
                <?php echo esc_html( $restaurant_name_ar ); ?>
            </span>
            <span class="restaurant-name-en">
                <?php echo esc_html( $restaurant_name_en ); ?>
            </span>
            <?php elseif ( $lang_mode === 'en' ) : ?>
            <span class="restaurant-name-en show">
                <?php echo esc_html( $restaurant_name_en ); ?>
            </span>
            <?php elseif ( $lang_mode === 'ar' ) : ?>
            <span class="restaurant-name-ar show">
                <?php echo esc_html( $restaurant_name_ar ); ?>
            </span>
            <?php endif; ?>
        </h1>
        <?php endif; ?>
        <!-- ================================= -->
        <!-- Restaurant Description -->
        <!-- ================================= -->
        <?php if ( $restaurant_description_ar||$restaurant_description_en ) : ?>
        <div class="elegant-header__description">
            <?php if ( $lang_mode === 'bi' ) :  //show both descriptions?>
            <p class="restaurant-description-ar">
                <?php echo esc_html( $restaurant_description_ar ); ?>
            </p>
            <p class="restaurant-description-en">
                <?php echo esc_html( $restaurant_description_en ); ?>
            </p>
            <?php elseif ( $lang_mode === 'en' ) : ?>
            <p class="restaurant-description-en show">
                <?php echo esc_html( $restaurant_description_en ); ?>
            </p>
            <?php elseif ( $lang_mode === 'ar' ) : ?>
            <p class="restaurant-description-ar show">
                <?php echo esc_html( $restaurant_description_ar ); ?>
            </p>
            <?php endif?>
        </div>
        <?php endif; ?>
        <!-- Language Switcher -->
        <?php get_template_part( 'designs/'.RM_DESIGN.'/parts/lang-switch' );?>


    </div>
</header>