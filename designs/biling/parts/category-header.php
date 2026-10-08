<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$category = $args['category'] ?? null;

if ( ! $category ) {
    return;
}

$category_id = $category->term_id;

$name_ar = get_field(
    'name_ar',
    'term_' . $category_id
);

$name_en = get_field(
    'name_en',
    'term_' . $category_id
);

$description_ar = get_field(
    'desc_ar',
    'term_' . $category_id
);

$description_en = get_field(
    'desc_en',
    'term_' . $category_id
);

?>

<header class="bilingual-category-header" id="menu-category-<?php echo esc_attr( $category_id ); ?>">

    <div class="bilingual-category-header__title">

        <?php if ( $name_en ) : ?>

        <span class="bilingual-category-header__en">
            <?php echo esc_html( $name_en ); ?>
        </span>

        <?php else : ?>

        <span class="bilingual-category-header__en">
            <?php echo esc_html( $category->name ); ?>
        </span>

        <?php endif; ?>


        <span class="bilingual-category-header__separator">
            |
        </span>


        <?php if ( $name_ar ) : ?>

        <span class="bilingual-category-header__ar">
            <?php echo esc_html( $name_ar ); ?>
        </span>

        <?php endif; ?>

    </div>


    <?php if (
        $description_en ||
        $description_ar
    ) : ?>

    <div class="bilingual-category-header__description">

        <?php if ( $description_en ) : ?>

        <p class="bilingual-category-header__description-en">

            <?php
                    echo wp_kses_post(
                        rm_replace_c21_icon(
                            $description_en
                        )
                    );
                    ?>

        </p>

        <?php endif; ?>


        <?php if ( $description_ar ) : ?>

        <p class="bilingual-category-header__description-ar">

            <?php
                    echo wp_kses_post(
                        rm_replace_c21_icon(
                            $description_ar
                        )
                    );
                    ?>

        </p>

        <?php endif; ?>

    </div>

    <?php endif; ?>

</header>