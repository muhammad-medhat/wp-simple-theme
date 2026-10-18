<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
define('RM_DESIGN', 'professional');


$categories = rm_get_ordered_menu_categories();
?>

<div class="menu-design--professional">
    <?php get_template_part( 'designs/' . RM_DESIGN . '/parts/header' ); ?>
    <!-- =========================================
    CATEGORY NAVIGATION
    ========================================= -->
    <?php get_template_part( 'designs/'.RM_DESIGN."/parts/category-nav",'', array('categories' => $categories) );?>
    <?php get_template_part( 'designs/' . RM_DESIGN . '/parts/main-cont', '', ['categories'=>$categories] ); ?>

</div>