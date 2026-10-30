<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 *  =================================
 *   CATEGORY HEADER
 *  =================================
 */

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


<header class="classic-category__heading">
    <span class="classic-category__icon" aria-hidden="true">
        <?php
        $icon_fa = get_field('fa_icon', RM_MENU_CATEGORY_TAX . '_' . $term_id);
        if ( $icon_fa ) {            echo '<span class="fas '
                . esc_attr( $icon_fa )
                . '" aria-hidden="true"></span>';
            
        } else {
            echo "◉";
        }
        ?>
    </span>


    <h2 class="classic-category__title">
        <?php if ( $name_ar ) : ?>
        <span class="category-name-ar">
            <?php
                echo wp_kses_post(
                    rm_replace_c21_icon( $name_ar, 'white' )
                );
                ?>
        </span>
        <?php endif; ?>

        <?php if ( $name_en ) : ?>
        <span class="category-name-en">
            <?php
                echo wp_kses_post(
                    rm_replace_c21_icon( $name_en, 'white' )
                );
                ?>
        </span>
        <?php endif; ?>
    </h2>
</header>
<?php if ( $desc_ar || $desc_en ) : ?>
<div class="classic-category__description">
    <?php if ( $desc_ar ) : ?>
    <p class="category-description-ar">
        <?php
                echo wp_kses_post(
                    rm_replace_c21_icon( $desc_ar, 'brown' )
                );
                ?>
    </p>
    <?php endif; ?>

    <?php if ( $desc_en ) : ?>
    <p class="category-description-en">
        <?php
                echo wp_kses_post(
                    rm_replace_c21_icon( $desc_en, 'brown' )
                );
                ?>
    </p>
    <?php endif; ?>
</div>
<?php endif; ?>
<?php if ( $image_url ) : ?>
<div class="classic-category__image"
    style="background-image: url('<?php echo esc_url( $image_url ); ?>');background-size:cover;">
    <div class="img-o"></div>
    <img src="<?php echo RESTAURANT_MENU_DIR_URI?>/assets/img/c21-white.png"
        alt="<?php echo esc_attr( $name_en ?: $name_ar ?: $category->name ); ?>" loading="lazy">
</div>
<?php endif; ?>