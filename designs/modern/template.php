<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'RM_DESIGN', 'modern' );

?>

<div class="menu-design--modern modern-menu" id="top">

    <?php get_template_part('designs/' . RM_DESIGN . '/parts/header');?>

    <?php get_template_part('designs/' . RM_DESIGN . '/parts/category-nav');?>

    <?php get_template_part('designs/' . RM_DESIGN . '/parts/main-cont'); ?>

</div>