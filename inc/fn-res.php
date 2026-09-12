<?php 
// 1. Create the settings menu item in the dashboard
add_action('admin_menu', 'rm_global_menu');
function rm_global_menu() {
    add_submenu_page( 
        'edit.php?post_type=' .RM_MENU_ITEM_CPT, 
        'Global Settings', 'Global Config', 
        'manage_options', 'global-config', 
        'rm_pizza_sizes_page' );
}

// 2. Build the HTML form for the settings page

/**
 * Pizza Sizes Admin Page
 *
 * ACF Options fields:
 * sm_ar
 * sm_en
 * md_ar
 * md_en
 * lg_ar
 * lg_en
 */

function rm_pizza_sizes_page() {

    // Security
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'You do not have permission to access this page.' );
    }

    $message = '';

    /*
     * Save settings
     */
    if (isset( $_POST['rm_save_pizza_sizes'] ) && isset( $_POST['rm_pizza_sizes_nonce'] ) ) {

        if (
            ! wp_verify_nonce(
                sanitize_text_field(
                    wp_unslash( $_POST['rm_pizza_sizes_nonce'] )
                ),
                'rm_save_pizza_sizes'
            )
        ) {
            wp_die( 'Security check failed.' );
        }

        $fields = array(
            'sm_ar',
            'sm_en',
            'md_ar',
            'md_en',
            'lg_ar',
            'lg_en',
        );

        foreach ( $fields as $field ) {

            $value = isset( $_POST[ $field ] )
                ? sanitize_text_field(
                    wp_unslash( $_POST[ $field ] )
                )
                : '';

            if ( function_exists( 'update_field' ) ) {

                update_field(
                    $field,
                    $value,
                    'option'
                );
            }
        }

        $message = 'Pizza sizes saved successfully.';
    }

    /*
     * Get current values
     */
    $sm_ar = get_field( 'sm_ar', 'option' );
    $sm_en = get_field( 'sm_en', 'option' );

    $md_ar = get_field( 'md_ar', 'option' );
    $md_en = get_field( 'md_en', 'option' );

    $lg_ar = get_field( 'lg_ar', 'option' );
    $lg_en = get_field( 'lg_en', 'option' );

    ?>

<div class="wrap">

    <h1>Pizza Sizes</h1>

    <p>
        Define the pizza size names used throughout your restaurant menu.
    </p>

    <?php if ( $message ) : ?>

    <div class="notice notice-success is-dismissible">
        <p>
            <?php echo esc_html( $message ); ?>
        </p>
    </div>

    <?php endif; ?>


    <form method="post">

        <?php
            wp_nonce_field(
                'rm_save_pizza_sizes',
                'rm_pizza_sizes_nonce'
            );
            ?>


        <!-- Small -->

        <div class="rm-pizza-size-box">

            <h2>Small</h2>

            <table class="form-table">

                <tr>

                    <th scope="row">
                        <label for="sm_ar">
                            Arabic Name
                        </label>
                    </th>

                    <td>

                        <input type="text" id="sm_ar" name="sm_ar" class="regular-text"
                            value="<?php echo esc_attr( $sm_ar ); ?>" placeholder="مثال: صغير">

                    </td>

                </tr>


                <tr>

                    <th scope="row">
                        <label for="sm_en">
                            English Name
                        </label>
                    </th>

                    <td>

                        <input type="text" id="sm_en" name="sm_en" class="regular-text"
                            value="<?php echo esc_attr( $sm_en ); ?>" placeholder="Example: Small">

                    </td>

                </tr>

            </table>

        </div>


        <!-- Medium -->

        <div class="rm-pizza-size-box">

            <h2>Medium</h2>

            <table class="form-table">

                <tr>

                    <th scope="row">
                        <label for="md_ar">
                            Arabic Name
                        </label>
                    </th>

                    <td>

                        <input type="text" id="md_ar" name="md_ar" class="regular-text"
                            value="<?php echo esc_attr( $md_ar ); ?>" placeholder="مثال: وسط">

                    </td>

                </tr>


                <tr>

                    <th scope="row">
                        <label for="md_en">
                            English Name
                        </label>
                    </th>

                    <td>

                        <input type="text" id="md_en" name="md_en" class="regular-text"
                            value="<?php echo esc_attr( $md_en ); ?>" placeholder="Example: Medium">

                    </td>

                </tr>

            </table>

        </div>


        <!-- Large -->

        <div class="rm-pizza-size-box">

            <h2>Large</h2>

            <table class="form-table">

                <tr>

                    <th scope="row">
                        <label for="lg_ar">
                            Arabic Name
                        </label>
                    </th>

                    <td>

                        <input type="text" id="lg_ar" name="lg_ar" class="regular-text"
                            value="<?php echo esc_attr( $lg_ar ); ?>" placeholder="مثال: كبير">

                    </td>

                </tr>


                <tr>

                    <th scope="row">
                        <label for="lg_en">
                            English Name
                        </label>
                    </th>

                    <td>

                        <input type="text" id="lg_en" name="lg_en" class="regular-text"
                            value="<?php echo esc_attr( $lg_en ); ?>" placeholder="Example: Large">

                    </td>

                </tr>

            </table>

        </div>


        <?php submit_button( 'Save Pizza Sizes', 'primary', 'rm_save_pizza_sizes', false ); ?>
        <!-- <button type="submit" name="rm_save_pizza_sizes" value="1">
            Save Pizza Sizes
        </button> -->

    </form>

</div>

<?php
}