<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}




/**
 * Add Badges column.
 */
function rm_menu_item_badges_column( $columns ) {

    $new_columns = array();

    foreach ( $columns as $key => $label ) {

        $new_columns[ $key ] = $label;

        if ( 'title' === $key ) {
            $new_columns['rm_badges'] = __( 'Badges', 'restaurant-menu' );
        }
    }

    return $new_columns;
}

add_filter('manage_rm_menu_item_posts_columns', 'rm_menu_item_badges_column');


/**
 * Render Badges column.
 */
function rm_menu_item_badges_column_content( $column, $post_id ) {

    if ( 'rm_badges' !== $column ) {
        return;
    }

    $badges = get_field( 'badges', $post_id);

    if ( empty( $badges ) ) {
        echo '<span class="rm-no-badges">—</span>';
        return;
    }

    /*
     * ACF can return a single value if the field
     * configuration is changed from multiple to single.
     */
    if ( ! is_array( $badges ) ) {
        $badges = array( $badges );
    }

    $badge_labels = rm_get_badge_labels();

    echo '<div class="rm-admin-badges">';

    foreach ( $badges as $badge ) {

        if ( ! isset( $badge_labels[ $badge ] ) ) {
            continue;
        }

        $label = $badge_labels[ $badge ];

        printf(
            '<span class="rm-admin-badge rm-admin-badge--%1$s" title="%2$s / %3$s">
                <i class="%4$s" aria-hidden="true"></i>
            </span>',
            esc_attr( $badge ),
            esc_attr( $label['ar'] ),
            esc_attr( $label['en'] ),
            esc_attr( $label['icon'] )
        );
    }

    echo '</div>';
}

add_action('manage_rm_menu_item_posts_custom_column', 'rm_menu_item_badges_column_content', 10,  2);

function rm_admin_badges_assets( $hook ) {

    global $post_type;

    if (
        'edit.php' !== $hook ||
        // 'rm_menu_item' !== $post_type||
        RM_MENU_ITEM_CPT!==$post_type
    ) {
        return;
    }

    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css',
        array(),
        '6.5.2'
    );

    wp_add_inline_style(
        'font-awesome',
        '
        .column-rm_badges {
            width: 130px;
        }

        .rm-admin-badges {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 5px;
        }

        .rm-admin-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            width: 28px;
            height: 28px;

            border-radius: 50%;

            font-size: 13px;

            border: 1px solid rgba(0,0,0,.08);
            box-shadow: 0 1px 2px rgba(0,0,0,.08);
        }

        .rm-admin-badge--popular {
            background: #fff3e0;
            color: #e65100;
        }

        .rm-admin-badge--recommended {
            background: #fff8e1;
            color: #b7791f;
        }

        .rm-admin-badge--new {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .rm-admin-badge--spicy {
            background: #ffebee;
            color: #c62828;
        }

        .rm-admin-badge--vegetarian {
            background: #e8f5e9;
            color: #388e3c;
        }

        .rm-no-badges {
            color: #999;
        }
        '
    );
}

add_action(
    'admin_enqueue_scripts',
    'rm_admin_badges_assets'
);

/**
 * Load badge admin assets only on the menu item edit screen.
 */
function rm_admin_badges_edit_assets( $hook ) {

    global $post_type;

    if (
        ! in_array( $hook, array( 'post.php', 'post-new.php' ), true )
        || 'rm_menu_item' !== $post_type
    ) {
        return;
    }

    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css',
        array(),
        '6.5.2'
    );

    wp_add_inline_style(
        'font-awesome',
        '
        /* =====================================================
         * Restaurant Menu - Badge Selector
         * ===================================================== */

        .acf-field[data-name="badges"] .acf-label {
            margin-bottom: 12px;
        }

        .acf-field[data-name="badges"] .acf-label label {
            font-size: 14px;
            font-weight: 600;
        }

        .acf-field[data-name="badges"] .acf-input > ul.acf-checkbox-list {
            display: grid !important;
            grid-template-columns: repeat(
                auto-fit,
                minmax(150px, 1fr)
            );

            gap: 10px;

            margin: 0 !important;
            padding: 0 !important;

            list-style: none !important;
        }

        .acf-field[data-name="badges"] .acf-checkbox-list > li {
            margin: 0 !important;
            padding: 0 !important;
        }

        .acf-field[data-name="badges"] .acf-checkbox-list label {
            position: relative;

            display: flex;
            align-items: center;
            gap: 10px;

            min-height: 72px;

            padding: 12px 14px;

            background: #fff;

            border: 1px solid #dcdcde;
            border-radius: 10px;

            cursor: pointer;

            transition:
                border-color .2s ease,
                box-shadow .2s ease,
                background .2s ease,
                transform .15s ease;
        }

        .acf-field[data-name="badges"] .acf-checkbox-list label:hover {
            border-color: #8c8f94;
            transform: translateY(-1px);
        }

        .acf-field[data-name="badges"] .acf-checkbox-list input[type="checkbox"] {
            position: absolute;

            width: 1px;
            height: 1px;

            opacity: 0;
            pointer-events: none;
        }

        /* Icon */

        .rm-admin-badge-icon {
            flex: 0 0 38px;

            width: 38px;
            height: 38px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: #f1f1f1;

            font-size: 16px;

            transition:
                background .2s ease,
                color .2s ease,
                transform .2s ease;
        }

        /* Text */

        .rm-admin-badge-text {
            display: flex;
            flex-direction: column;

            line-height: 1.25;
        }

        .rm-admin-badge-text-ar {
            font-size: 13px;
            font-weight: 600;
        }

        .rm-admin-badge-text-en {
            margin-top: 2px;

            font-size: 11px;
            color: #646970;
        }

        /* Selected */

        .acf-field[data-name="badges"]
        .acf-checkbox-list
        input[type="checkbox"]:checked + .rm-admin-badge-icon {
            transform: scale(1.05);
        }

        .acf-field[data-name="badges"]
        .acf-checkbox-list
        label:has(input[type="checkbox"]:checked) {
            border-color: #2271b1;

            background: #f0f7fc;

            box-shadow:
                0 0 0 1px #2271b1;
        }

        .acf-field[data-name="badges"]
        .acf-checkbox-list
        label:has(input[type="checkbox"]:checked)
        .rm-admin-badge-icon {
            background: #2271b1;
            color: #fff;
        }

        /* Keyboard focus */

        .acf-field[data-name="badges"]
        .acf-checkbox-list
        input[type="checkbox"]:focus-visible
        + .rm-admin-badge-icon {
            outline: 2px solid #2271b1;
            outline-offset: 3px;
        }

        /* Description */

        .acf-field[data-name="badges"] .description {
            margin-top: 10px;
            color: #646970;
        }
        '
    );
    wp_add_inline_script(
    'jquery-core',
    '
    jQuery(function($) {

        const badgeLabels = ' . wp_json_encode( rm_get_badge_labels() ) . ';

        function styleBadgeChoices() {

            const field = document.querySelector(
                ".acf-field[data-name=\"badges\"]"
            );

            if (!field) {
                return;
            }

            const labels = field.querySelectorAll(
                ".acf-checkbox-list > li > label"
            );

            labels.forEach(function(label) {

                if (label.dataset.rmStyled === "1") {
                    return;
                }

                const input = label.querySelector(
                    "input[type=\"checkbox\"]"
                );

                if (!input) {
                    return;
                }

                const badgeKey = input.value;

                if (!badgeLabels[badgeKey]) {
                    return;
                }

                const badge = badgeLabels[badgeKey];

                label.dataset.rmStyled = "1";

                input.setAttribute(
                    "aria-label",
                    badge.en
                );

                label.innerHTML = "";

                const icon = document.createElement("span");

                icon.className =
                    "rm-admin-badge-icon " +
                    badge.icon;

                icon.setAttribute(
                    "aria-hidden",
                    "true"
                );

                const text = document.createElement("span");

                text.className =
                    "rm-admin-badge-text";

                text.innerHTML =
                    "<span class=\"rm-admin-badge-text-ar\">" +
                    badge.ar +
                    "</span>" +
                    "<span class=\"rm-admin-badge-text-en\">" +
                    badge.en +
                    "</span>";

                label.appendChild(input);
                label.appendChild(icon);
                label.appendChild(text);
            });
        }

        styleBadgeChoices();

        if (
            typeof acf !== "undefined" &&
            acf.addAction
        ) {
            acf.addAction(
                "ready",
                styleBadgeChoices
            );

            acf.addAction(
                "append",
                styleBadgeChoices
            );
        }

    });
    '
);
}

add_action(
    'admin_enqueue_scripts',
    'rm_admin_badges_edit_assets'
);