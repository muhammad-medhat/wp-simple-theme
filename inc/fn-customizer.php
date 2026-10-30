<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Customizer options
 
 * Restaurant Menu Customizer
*/
define('WP_TITLE_SECTION', 'title_tagline');
define('RM_DESIGN_SECTION', 'rm_menu_design');
define('RM_SETTINGS_SECTION', 'rm_menu_settings');
define('RM_SIZE_SECTION', 'rm_menu_sizes');

function rm_menu_customize_register( $wp_customize ) {

        /*
        * rm_menu_settings Section
        */
        $wp_customize->add_section( RM_SETTINGS_SECTION, array(
            'title' => __( 'Restaurant Menu', 'restaurant-menu' ),
            'description' => __( 'Customize the restaurant QR menu.', 'restaurant-menu' ),
            'priority' => 30,
            )
        );


        /*
        * rm_menu_design Design  setting
        * - Modern
        * - Elegant
        * - Dark
        */
        $wp_customize->add_setting(RM_DESIGN_SECTION, array(      
                'default' => 'modern',
                'sanitize_callback' => 'rm_menu_sanitize_design',
            )
        );


        /*
        * Design selector
        */
        $wp_customize->add_control(RM_DESIGN_SECTION, array(
            'type' => 'select',
            'section' => RM_SETTINGS_SECTION,
            'label' => __( 'Menu Design', 'restaurant-menu' ),
            'description' => __( 'Choose the visual design of your restaurant menu.', 'restaurant-menu' ),
            'choices' => array(
                'modern' => __( 'Modern', 'restaurant-menu' ),
                'elegant' => __( 'Elegant', 'restaurant-menu' ),
                'dark' => __( 'Dark', 'restaurant-menu' ),
                'biling' => __( 'Bilingual', 'restaurant-menu' ),
                'professional' => __( 'Professional', 'restaurant-menu' ),
                'classic' => __( 'Classic', 'restaurant-menu' ),
            ),
        ));
        //Settings to add on the title_tagline section - (Site Identity) Section

        /* ================================
        * Restaurant Name - Arabic
        * ================================ */

        $wp_customize->add_setting(
            'rm_restaurant_name_ar',
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
                )
        );

        $wp_customize->add_control(
            'rm_restaurant_name_ar',
            array(
                'label'   => __( 'Restaurant Name (Arabic)', 'restaurant-menu' ),
                'section' => WP_TITLE_SECTION,
                'type'    => 'text',
            )
        );


        /* ================================
        * Restaurant Name - English
        * ================================ */

        $wp_customize->add_setting(
            'rm_restaurant_name_en',
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
            'rm_restaurant_name_en',
            array(
                'label'   => __( 'Restaurant Name (English)', 'restaurant-menu' ),
                'section' => WP_TITLE_SECTION,
                'type'    => 'text',
            )
        );


        /* ================================
        * Restaurant Description - Arabic
        * ================================ */

        $wp_customize->add_setting(
            'rm_restaurant_description_ar',
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_textarea_field',
            )
        );

        $wp_customize->add_control(
            'rm_restaurant_description_ar',
            array(
                'label'   => __( 'Restaurant Description (Arabic)', 'restaurant-menu' ),
                'section' => WP_TITLE_SECTION,
                'type'    => 'textarea',
            )
        );


        /* ================================
        * Restaurant Description - English
        * ================================ */

        $wp_customize->add_setting(
            'rm_restaurant_description_en',
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_textarea_field',
            )
        );

        $wp_customize->add_control(
            'rm_restaurant_description_en',
            array(
                'label'   => __( 'Restaurant Description (English)', 'restaurant-menu' ),
                'section' => WP_TITLE_SECTION,
                'type'    => 'textarea',
            )
        );
        /* =========================================
        * Content Language
        * ========================================= */

        $wp_customize->add_setting(
            'rm_menu_language_mode',
            array(
                'default'           => 'bilingual',
                'sanitize_callback' => 'sanitize_key',
            )
        );

        $wp_customize->add_control(
            'rm_menu_language_mode',
            array(
                'label'   => __( 'Content Language', 'restaurant-menu' ),
                'section' => RM_SETTINGS_SECTION,
                'type'    => 'select',
                'choices' => array(
                    // 'bilingual' => __( 'Arabic & English', 'restaurant-menu' ),
                    'bi' => __( 'Arabic & English', 'restaurant-menu' ),
                    'ar'        => __( 'Arabic Only', 'restaurant-menu' ),
                    'en'        => __( 'English Only', 'restaurant-menu' ),
                ),
            )
        );
        /**
     * Pizza size labels
     */
    $wp_customize->add_section(
        RM_SIZE_SECTION,
        array(
            'title'    => __( 'Multiple Size Labels', 'restaurant-menu' ),
            'priority' => 35,
        )
    );

    $size_fields = array(
        'sm_ar' => 'Small – Arabic',
        'sm_en' => 'Small – English',
        'md_ar' => 'Medium – Arabic',
        'md_en' => 'Medium – English',
        'lg_ar' => 'Large – Arabic',
        'lg_en' => 'Large – English',
    );

    foreach ( $size_fields as $field => $label ) {

        $wp_customize->add_setting(
            'rm_size_' . $field,
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
            'rm_size_' . $field,
            array(
                'label'   => __( $label, 'restaurant-menu' ),
                'section' => RM_SIZE_SECTION,
                'type'    => 'text',
            )
        );
    }
    /*
    * =========================================================
    * BADGES
    * =========================================================
    */

    $wp_customize->add_setting(
        'rm_enable_badges',
        array(
            'default'           => true,
            'sanitize_callback' => function ( $value ) {
                return (bool) $value;
            },
        )
    );

    $wp_customize->add_control(
        'rm_enable_badges',
        array(
            'label'   => __( 'Enable Menu Badges', 'restaurant-menu' ),
            'section' => RM_SETTINGS_SECTION,
            'type'    => 'checkbox',
        )
    );
    /*
    * =========================================================
    * CATEGORY ICONS
    * =========================================================
    */
    
        $wp_customize->add_setting(
            'rm_enable_category_icons',
            array(
                'default'           => true,
                'sanitize_callback' => function ( $value ) {
                    return (bool) $value;
                },
            )
        );
        
        $wp_customize->add_control(
            'rm_enable_category_icons',
            array(
                'label'   => __( 'Enable Category_icons', 'restaurant-menu' ),
                'section' => RM_SETTINGS_SECTION,
                'type'    => 'checkbox',
            )
        );
        // enable Demo
        $wp_customize->add_setting(
            'rm_demo',
            array(
                'default'           => false,
                'sanitize_callback' => function ( $value ) {
                    return (bool) $value;
                },
            )
        );
        
        $wp_customize->add_control(
            'rm_demo',
            array(
                'label'   => __( 'Enable Demo', 'restaurant-menu' ),
                'section' => RM_SETTINGS_SECTION,
                'type'    => 'checkbox',
            )
        );
        /**
         * Social Share
         */
        
            // $wp_customize->add_section('club21_social_sharing', [
            //     'title'       => __('Social Sharing Image', 'club21'),
            //     'priority'    => 160,
            //     'description' => __('Choose the image displayed when sharing your menu.', 'club21'),
            // ]);
        
            $wp_customize->add_setting('club21_og_image', [
                'default'           => '',
                'sanitize_callback' => 'absint',
                'transport'         => 'refresh',
            ]);
        
            $wp_customize->add_control(
                new WP_Customize_Media_Control(
                    $wp_customize,
                    'club21_og_image_control',
                    [
                        'label'       => __('Open Graph Image', 'club21'),
                        'section'     => RM_SETTINGS_SECTION,
                        'settings'    => 'club21_og_image',
                        'mime_type'   => 'image',
                        'description' => __('Recommended size: 1200 × 630 pixels.', 'club21'),
                    ]
                )
            );
        }
        
        add_action( 'customize_register', 'rm_menu_customize_register');



/**
 * Output Open Graph and Twitter metadata.
 */
function club21_output_social_meta_tags() {

    $image_id = get_theme_mod('club21_og_image');

    if (!$image_id) {
        return;
    }

    $image_url = wp_get_attachment_image_url($image_id, 'full');

    if (!$image_url) {
        return;
    }

    $title = wp_get_document_title();
    $description = get_bloginfo('description');
    $page_url = home_url(add_query_arg([], $_SERVER['REQUEST_URI'] ?? '/'));

    ?>
<!-- Open Graph -->
<meta property="og:type" content="website">
<meta property="og:title" content="<?php echo esc_attr($title); ?>">
<meta property="og:description" content="<?php echo esc_attr($description); ?>">
<meta property="og:url" content="<?php echo esc_url($page_url); ?>">
<meta property="og:image" content="<?php echo esc_url($image_url); ?>">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo esc_attr($title); ?>">
<meta name="twitter:description" content="<?php echo esc_attr($description); ?>">
<meta name="twitter:image" content="<?php echo esc_url($image_url); ?>">
<?php
}
add_action('wp_head', 'club21_output_social_meta_tags', 5);