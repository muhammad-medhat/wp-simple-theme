<?php

get_header();


$design = get_theme_mod(
    'rm_menu_design',
    'modern'
);


/*
 * Only allow registered designs.
 */
$allowed_designs = array(
    'modern',
    'elegant',
    'dark',
);


if ( ! in_array( $design, $allowed_designs, true ) ) {
    $design = 'modern';
}

?>

<div class="menu-design menu-design--<?php echo esc_attr( $design ); ?>"
    data-menu-design="<?php echo esc_attr( $design ); ?>">

    <?php

    get_template_part(
        'designs/' . $design . '/template'
    );

    ?>


</div>

<?php get_footer(); ?>