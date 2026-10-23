<?php
/**
 * classic Restaurant Menu Design
 *
 * @package Restaurant_Menu
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
define('RM_DESIGN', 'classic');

/****************************************************** */

?>
<div class="menu-design--classic classic-menu">
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