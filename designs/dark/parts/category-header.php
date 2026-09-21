<?php

$category = $args['category'];

$category_name_ar = get_field(
    'name_ar',
    RM_MENU_CATEGORY_TAX . '_' . $category->term_id
);

$category_name_en = get_field(
    'name_en',
    RM_MENU_CATEGORY_TAX . '_' . $category->term_id
);

$category_desc_ar = get_field(
    'desc_ar',
    RM_MENU_CATEGORY_TAX . '_' . $category->term_id
);

$category_desc_en = get_field(
    'desc_en',
    RM_MENU_CATEGORY_TAX . '_' . $category->term_id
);

?>

<header class="dark-category__header">

    <div class="dark-category__line"></div>

    <h2 class="dark-category__title">

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


    <?php if ( $category_desc_ar || $category_desc_en ) : ?>

    <div class="dark-category__description">

        <?php if ( $category_desc_ar ) : ?>

        <p class="category-description-ar">
            <?php echo esc_html( $category_desc_ar ); ?>
        </p>

        <?php endif; ?>


        <?php if ( $category_desc_en ) : ?>

        <p class="category-description-en">
            <?php echo esc_html( $category_desc_en ); ?>
        </p>

        <?php endif; ?>

    </div>

    <?php endif; ?>


    <div class="dark-category__ornament">
        <span>◆</span>
        <i></i>
        <span>◆</span>
        <i></i>
        <span>◆</span>
    </div>

</header>