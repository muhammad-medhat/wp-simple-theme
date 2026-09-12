<?php
/**
 * Elegant Restaurant Menu Design
 *
 * @package Restaurant_Menu
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
define('RM_DESIGN', 'elegant');

/****************************************************** */

?>
<div class="menu-design--elegant elegant-menu">
    <!-- =========================================
         RESTAURANT HEADER
         ========================================= -->
    <?php get_template_part( 'designs/'.RM_DESIGN."/parts/header");?>

    <!-- =========================================
    CATEGORY NAVIGATION
    ========================================= -->
    <?php get_template_part( 'designs/'.RM_DESIGN."/parts/category-nav");?>

    <!-- =========================================
    MENU CONTENT
    ========================================= -->
    <?php get_template_part( 'designs/'.RM_DESIGN."/parts/main-cont");?>

</div>