<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Customizer options
 
 * Restaurant Menu Customizer
*/
define('WP_TITLE_SECTION', 'title_tagline');
define('RM_MENU_SECTION', 'rm_menu_design');
// define('RM_SETTINGS_SECTION', 'rm_menu_settings');
define('RM_SETTINGS_SECTION', 'rm_restaurant_menu');
define('RM_SIZE_SECTION', 'rm_menu_sizes');

function rm_menu_customize_register( $wp_customize ) {
    /* list of sections we used
    * active: boolean to indicate whether  create it or not
    */

        $sections_create=[
            WP_TITLE_SECTION    =>[
                "active"=>false, 
                "title"=>"Site Identity",
                "description"=>"Site Identity"],
            RM_MENU_SECTION     =>[
                "active"=>true, 
                "title"=>"", 
                "description"=>"Site Identity"],
            RM_SETTINGS_SECTION =>[
                "active"=>true, 
                "title"=>"Restaurant Menu", 
                "description"=>"Customize the restaurant QR menu."],
            RM_SIZE_SECTION     =>[
                "active"=>true, 
                "title"=>"Multiple Size Labels", 
                "description"=>"Customize the size labels for the restaurant menu."],
        ];
        //create sections in the sections_create array
        foreach($sections_create as $section_id=>$section_data){
            $is_active = $section_data['active'];
            if($is_active){
                $wp_customize->add_section( $section_id, array(
                    'title' => __( $section_data['title'], 'restaurant-menu' ),
                    'description' => __( $section_data['description'], 'restaurant-menu' ),
                    'priority' => 30,
                    )
                );
            }
        }
        /*
         * Settings to add on the site identity section
        */
        $site_identity_section=array(
            "rm_restaurant_name_ar"=>array(
                "default"=>"",
                "sanitize_callback"=>"sanitize_text_field",
                "control"=>array(
                    'type'        => 'text',
                    'label'       => __('Restaurant Name (Arabic)', 'restaurant-menu'),
                    'section'     => WP_TITLE_SECTION,
                    'description' => __('', 'restaurant-menu'),
                )
            ),"rm_restaurant_name_en"=>array(
                "default"=>"",
                "sanitize_callback"=>"sanitize_text_field",
                "control"=>array(
                    'type'        => 'text',
                    'label'       => __('Restaurant Name (English)', 'restaurant-menu'),
                    'section'     => WP_TITLE_SECTION,
                    'description' => __('Enter the restaurant name in English.', 'restaurant-menu'),
                )
            ),
            "rm_restaurant_description_ar"=>array(
                "default"=>"",
                "sanitize_callback"=>"sanitize_textarea_field",
                "control"=>array(
                    'type'        => 'textarea',
                    'label'       => __('Restaurant Description (Arabic)', 'restaurant-menu'),
                    'section'     => WP_TITLE_SECTION,
                    'description' => __(''),
                )
            ),"rm_restaurant_description_en"=>array(
                "default"=>"",
                "sanitize_callback"=>"sanitize_textarea_field",
                "control"=>array(
                    'type'        => 'textarea',
                    'label'       => __('Restaurant Description (English)', 'restaurant-menu'),
                    'section'     => WP_TITLE_SECTION,
                    'description' => __('', 'restaurant-menu'),
                )
            ),
        );
        foreach ($site_identity_section as $setting_id => $setting_data) {
            $wp_customize->add_setting($setting_id, [
                'default'           => $setting_data['default'],
                'sanitize_callback' => $setting_data['sanitize_callback'],
            ]);     
            $wp_customize->add_control($setting_id, [
                'type'        => $setting_data['control']['type'],
                'label'       => $setting_data['control']['label'],
                'section'     => $setting_data['control']['section'],
                'description' => $setting_data['control']['description'],
            ]);
        }
        /**************************************************** */


        /*
        * rm_menu_design Design  setting
        */
        $menu_design_setting=array(
            "rm_menu_design"=>array(
                'default'           => 'classic',
                'sanitize_callback' => 'rm_menu_sanitize_design',
                "control"=>array(
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
                )
            )
        );

        $lang_set=array(
            "rm_menu_language_mode"=>array(
                'default'           => 'bilingual',
                'sanitize_callback' => 'sanitize_key',
                "control"=>array(
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
            )
        );

        /**
     * Pizza size labels
     */

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
    $badges_settings=array(
        "rm_enable_badges"=>array(
            "default"=>true,
            "sanitize_callback"=>function ( $value ) {
                return (bool) $value;
            },
            "control"=>array(
                'type'        => 'checkbox',
                'label'       => __('Enable Menu Badges', 'restaurant-menu'),
                'section'     => RM_SETTINGS_SECTION,
                'description' => __('', 'restaurant-menu'),
            )
        )
    );

    /*
    * =========================================================
    * CATEGORY ICONS
    * =========================================================
    */
    $category_icons_settings=array(
        "rm_enable_category_icons"=>array(
            "default"=>true,
            "sanitize_callback"=>function ( $value ) {
                return (bool) $value;
            },
            "control"=>array(
                'type'        => 'checkbox',
                'label'       => __('Enable Category Icons', 'restaurant-menu'),
                'section'     => RM_SETTINGS_SECTION,
                'description' => __('', 'restaurant-menu'),
            )
        )
    );  
    

        // enable Demo
        $enable_demo_settings=array(
            "rm_demo"=>array(
                "default"=>false,
                "sanitize_callback"=>function ( $value ) {
                    return (bool) $value;
                },
                "control"=>array(
                    'type'        => 'checkbox',
                    'label'       => __('Enable Demo', 'restaurant-menu'),
                    'section'     => RM_SETTINGS_SECTION,
                    'description' => __('', 'restaurant-menu'),
                )
            )
        );


        foreach(array_merge($menu_design_setting, $lang_set, $enable_demo_settings, $category_icons_settings, $badges_settings) as $setting_id => $setting_data) {
            $wp_customize->add_setting($setting_id, [
                'default'           => $setting_data['default'],
                'sanitize_callback' => $setting_data['sanitize_callback'],
            ]);     
            $wp_customize->add_control($setting_id, [
                'type'        => $setting_data['control']['type'],
                'label'       => $setting_data['control']['label'],
                'section'     => $setting_data['control']['section'],
                'description' => $setting_data['control']['description']??'',
                'choices' => $setting_data['control']['choices']??[],
            ]);
        }

        /**
         * Social Share
         */
        $og_settings=array(
            "club21_og_base_url"=>array(
                "default"=>"",
                "sanitize_callback"=>"club21_sanitize_og_base_url",
                "control"=>array(
                    'type'        => 'url',
                    'label'       => __('Open Graph Base URL', 'club21'),
                    'section'     => RM_SETTINGS_SECTION,
                    'description' => __('Enter the public menu base URL, including https:// and any folder path. This sets the base for the shared page URL (og:url). Leave blank to use the WordPress Site Address.', 'club21'),                    )
                ),
            "club21_og_description"=>array(
                "default"=>"",
                "sanitize_callback"=>"sanitize_textarea_field",
                "control"=>array(
                    'type'        => 'textarea',
                    'label'       => __('Open Graph Description', 'club21'),
                    'section'     => RM_SETTINGS_SECTION,
                    'description' => __('Enter a brief description of your restaurant menu for social sharing.', 'club21'),                    )
                ),
                "club21_og_image"=>array(
                    "default"=>"",
                    "sanitize_callback"=>"absint",
                    "transport"=>"refresh",
                    "control"=>array(
                        'type'        => 'media',
                        'label'       => __('Open Graph Image', 'club21'),
                        'section'     => RM_SETTINGS_SECTION,
                        'description' => __('Choose the image displayed when sharing your menu. Recommended size: 1200 × 630 pixels.', 'club21'),                    )
                ),
            );
        
            foreach ($og_settings as $setting_id => $setting_data) {
                $wp_customize->add_setting($setting_id, [
                    'default'           => $setting_data['default'],
                    'sanitize_callback' => $setting_data['sanitize_callback'],
                ]);
                if (isset($setting_data['control'])&& $setting_data['control']['type'] === 'media') {
                    $wp_customize->add_control(
                        new WP_Customize_Media_Control(
                            $wp_customize,
                            $setting_id . '_control',
                            [
                                'label'       => $setting_data['control']['label'],
                                'section'     => $setting_data['control']['section'],
                                'settings'    => $setting_id,
                                'mime_type'   => 'image',
                                'description' => $setting_data['control']['description'],
                            ]
                        )
                    );
                } else {    
                    $wp_customize->add_control($setting_id, [
                        'type'        => $setting_data['control']['type'],
                        'label'       => $setting_data['control']['label'],
                        'section'     => $setting_data['control']['section'],
                        'description' => $setting_data['control']['description'],
                    ]);
                }
            }

        }
        
        add_action( 'customize_register', 'rm_menu_customize_register');



/**
 * Accept an empty value or an absolute HTTP(S) base URL.
 */
function club21_sanitize_og_base_url( $value ) {
    if ( is_string( $value ) ) {
        $value = trim( $value );

        if ( '' === $value ) {
            return '';
        }

        $url = esc_url_raw( $value, array( 'http', 'https' ) );
        $parts = wp_parse_url( $url );

        if ( preg_match( '#^https?://#i', $value ) && ! empty( $parts['host'] ) &&
            ! isset( $parts['user'] ) && ! isset( $parts['pass'] ) &&
            ! isset( $parts['query'] ) && ! isset( $parts['fragment'] ) ) {
            return untrailingslashit( $url );
        }
    }

    return new WP_Error(
        'invalid_og_base_url',
        __( 'Enter a full URL starting with http:// or https://, without credentials, a query string, or a fragment.', 'club21' )
    );
}

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
    $description = get_theme_mod( "club21_og_description", $description );
    $home_url = home_url( '/' );
    $base_url = get_theme_mod( 'club21_og_base_url' ) ?: $home_url;
    $home_path = untrailingslashit( (string) wp_parse_url( $home_url, PHP_URL_PATH ) );
    $request_uri = wp_unslash( $_SERVER['REQUEST_URI'] ?? '/' );
    $request_parts = explode( '?', $request_uri, 2 );
    $request_path = $request_parts[0];

    // The public base already includes the menu's base path.
    if ( $home_path && ( $request_path === $home_path || strpos( $request_path, $home_path . '/' ) === 0 ) ) {
        $request_path = substr( $request_path, strlen( $home_path ) );
    }

    $page_url = trailingslashit( $base_url ) . ltrim( $request_path, '/' );
    if ( isset( $request_parts[1] ) ) {
        $page_url .= '?' . $request_parts[1];
    }

    ?>
<!-- Open Graph -->
<meta property="og:type" content="website">
<meta property="og:title" content="<?php echo esc_attr($title); ?>">
<meta property="og:description" content="<?php echo esc_attr($description); ?>">
<meta property="og:url" content="<?php echo esc_url($page_url); ?>">
<meta property="og:image" content="<?php echo esc_url($base_url . $image_url); ?>">
<meta property="og:image:secure_url" content="<?php echo esc_url($base_url . $image_url); ?>">
<meta property="og:image:type" content="image/jpeg">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo esc_attr($title); ?>">
<meta name="twitter:description" content="<?php echo esc_attr($description); ?>">
<meta name="twitter:image" content="<?php echo esc_url($base_url . $image_url); ?>">
<?php
}
add_action('wp_head', 'club21_output_social_meta_tags', 5);