<?php

/**
 * Dark Luxury Restaurant Menu Design
 *
 * @package Restaurant_Menu
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'RM_DESIGN', 'dark' );
?>

<div class="menu-design--dark dark-menu" id="top">

    <?php get_template_part('designs/' . RM_DESIGN . '/parts/header');?>

    <?php get_template_part('designs/' . RM_DESIGN . '/parts/category-nav');?>

    <?php get_template_part('designs/' . RM_DESIGN . '/parts/main-cont');?>

</div>