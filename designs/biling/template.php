<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'RM_DESIGN', 'biling' );

get_template_part('designs/' . RM_DESIGN . '/parts/header');


get_template_part('designs/' . RM_DESIGN . '/parts/main-cont');