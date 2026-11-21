<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<!doctype html>
<html <?php language_attributes(); ?>>

<head>

    <meta charset="<?php bloginfo( 'charset' ); ?>">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
    <div class="print-logo">
        <?php echo get_custom_logo(); ?>
    </div>

    <?php wp_body_open(); ?>