<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


/**
 * Add badge controls to WordPress Bulk Edit.
 */
function rm_bulk_edit_badges_field( $column_name, $post_type ) {

    if ( 'rm_menu_item' !== $post_type ) {
        return;
    }

    /*
     * Show the controls only once.
     *
     * We use the Badges column as the anchor.
     */
    if ( 'rm_badges' !== $column_name ) {
        return;
    }

    $badges = rm_get_badge_labels();
    ?>

<fieldset class="inline-edit-col-right rm-bulk-edit-badges">

    <div class="rm-bulk-badges-title">
        <strong>
            <?php esc_html_e( 'Menu Badges', 'restaurant-menu' ); ?>
        </strong>

        <span>
            <?php esc_html_e(
                    'Choose an action and select badges.',
                    'restaurant-menu'
                ); ?>
        </span>
    </div>


    <!-- Action -->

    <div class="rm-bulk-badge-actions">

        <label>
            <input type="radio" name="rm_bulk_badge_action" value="none" checked>

            <span>
                <?php esc_html_e(
                        'Do not change',
                        'restaurant-menu'
                    ); ?>
            </span>
        </label>


        <label>
            <input type="radio" name="rm_bulk_badge_action" value="add">

            <span>
                <?php esc_html_e(
                        'Add',
                        'restaurant-menu'
                    ); ?>
            </span>
        </label>


        <label>
            <input type="radio" name="rm_bulk_badge_action" value="remove">

            <span>
                <?php esc_html_e(
                        'Remove',
                        'restaurant-menu'
                    ); ?>
            </span>
        </label>


        <label>
            <input type="radio" name="rm_bulk_badge_action" value="replace">

            <span>
                <?php esc_html_e(
                        'Replace',
                        'restaurant-menu'
                    ); ?>
            </span>
        </label>

    </div>


    <!-- Badge cards -->

    <div class="rm-bulk-badge-list">

        <?php foreach ( $badges as $key => $badge ) : ?>

        <label class="rm-bulk-badge">

            <input type="checkbox" name="rm_bulk_badges[]" value="<?php echo esc_attr( $key ); ?>">

            <span class="rm-bulk-badge-icon">
                <i class="<?php echo esc_attr( $badge['icon'] ); ?>" aria-hidden="true"></i>
            </span>

            <span class="rm-bulk-badge-text">

                <strong>
                    <?php echo esc_html( $badge['ar'] ); ?>
                </strong>

                <small>
                    <?php echo esc_html( $badge['en'] ); ?>
                </small>

            </span>

        </label>

        <?php endforeach; ?>

    </div>

</fieldset>

<?php
}

add_action(
    'bulk_edit_custom_box',
    'rm_bulk_edit_badges_field',
    10,
    2
);


/**
 * Save Bulk Edit badges.
 */
function rm_save_bulk_edit_badges( $post_id ) {

    /*
     * Only process our bulk edit request.
     */
    if (
        ! isset( $_REQUEST['rm_bulk_badge_action'] )
    ) {
        return;
    }

    /*
     * Check post type.
     */
    if (
        'rm_menu_item' !== get_post_type( $post_id )
    ) {
        return;
    }

    /*
     * Check permission.
     */
    if (
        ! current_user_can(
            'edit_post',
            $post_id
        )
    ) {
        return;
    }

    /*
     * Get action.
     */
    $action = sanitize_key(
        wp_unslash(
            $_REQUEST['rm_bulk_badge_action']
        )
    );

    /*
     * Do nothing.
     */
    if ( 'none' === $action ) {
        return;
    }

    /*
     * Get selected badges.
     */
    $selected_badges = isset(
        $_REQUEST['rm_bulk_badges']
    )
        ? (array) $_REQUEST['rm_bulk_badges']
        : array();

    /*
     * Clean selected values.
     */
    $selected_badges = array_map(
        'sanitize_key',
        wp_unslash(
            $selected_badges
        )
    );

    /*
     * Get valid badges.
     */
    $badge_labels = rm_get_badge_labels();

    $selected_badges = array_values(
        array_intersect(
            $selected_badges,
            array_keys( $badge_labels )
        )
    );

    /*
     * If Add / Remove / Replace was selected
     * but no badge was selected, do nothing.
     */
    if ( empty( $selected_badges ) ) {
        return;
    }

    /*
     * Get current badges.
     */
    $current_badges = get_field(
        'badges',
        $post_id
    );

    if ( ! is_array( $current_badges ) ) {
        $current_badges = empty( $current_badges )
            ? array()
            : array( $current_badges );
    }

    /*
     * Clean current badges too.
     */
    $current_badges = array_values(
        array_intersect(
            $current_badges,
            array_keys( $badge_labels )
        )
    );


    /*
     * ADD
     *
     * Keep existing badges and add
     * the selected ones.
     */
    if ( 'add' === $action ) {

        $new_badges = array_unique(
            array_merge(
                $current_badges,
                $selected_badges
            )
        );

    }


    /*
     * REMOVE
     *
     * Remove only selected badges.
     */
    elseif ( 'remove' === $action ) {

        $new_badges = array_values(
            array_diff(
                $current_badges,
                $selected_badges
            )
        );

    }


    /*
     * REPLACE
     *
     * Completely replace existing badges.
     */
    elseif ( 'replace' === $action ) {

        $new_badges = $selected_badges;

    }


    /*
     * Save.
     */
    if ( isset( $new_badges ) ) {

        update_field(
            'badges',
            $new_badges,
            $post_id
        );
    }
}

add_action(
    'save_post_rm_menu_item',
    'rm_save_bulk_edit_badges',
    20
);


/**
 * Bulk Edit CSS.
 */
function rm_bulk_edit_badges_css() {

    global $post_type;

    if ( 'rm_menu_item' !== $post_type ) {
        return;
    }
    ?>

<style>
/* -----------------------------------------------------
         * Container
         * -------------------------------------------------- */

.rm-bulk-edit-badges {
    width: 100%;
    max-width: 760px;
    padding: 12px 0;
}


/* -----------------------------------------------------
         * Title
         * -------------------------------------------------- */

.rm-bulk-badges-title {
    margin-bottom: 12px;
}

.rm-bulk-badges-title strong {
    display: block;

    font-size: 13px;

    margin-bottom: 3px;
}

.rm-bulk-badges-title span {
    display: block;

    color: #646970;

    font-size: 11px;
}


/* -----------------------------------------------------
         * Actions
         * -------------------------------------------------- */

.rm-bulk-badge-actions {
    display: flex;
    flex-wrap: wrap;

    gap: 6px;

    margin-bottom: 14px;
}

.rm-bulk-badge-actions label {
    display: inline-flex;
    align-items: center;

    gap: 5px;

    margin: 0;

    padding: 5px 9px;

    border: 1px solid #dcdcde;

    border-radius: 5px;

    background: #fff;

    cursor: pointer;

    font-size: 11px;
}

.rm-bulk-badge-actions label:hover {
    border-color: #8c8f94;
}

.rm-bulk-badge-actions input {
    margin: 0;
}


/* -----------------------------------------------------
         * Badge grid
         * -------------------------------------------------- */

.rm-bulk-badge-list {
    display: grid;

    grid-template-columns:
        repeat(5,
            minmax(120px, 1fr));

    gap: 8px;

    max-width: 760px;
}


/* -----------------------------------------------------
         * Badge card
         * -------------------------------------------------- */

.rm-bulk-badge {
    position: relative;

    display: flex !important;
    align-items: center;

    min-height: 58px;

    margin: 0 !important;
    padding: 8px 10px;

    background: #fff;

    border: 1px solid #dcdcde;

    border-radius: 8px;

    cursor: pointer;

    transition:
        border-color .15s ease,
        background .15s ease,
        box-shadow .15s ease,
        transform .15s ease;
}

.rm-bulk-badge:hover {
    border-color: #8c8f94;

    transform: translateY(-1px);
}


/* -----------------------------------------------------
         * Hide checkbox visually
         * -------------------------------------------------- */

.rm-bulk-badge input {
    position: absolute;

    opacity: 0;

    pointer-events: none;
}


/* -----------------------------------------------------
         * Icon
         * -------------------------------------------------- */

.rm-bulk-badge-icon {
    display: flex;

    align-items: center;
    justify-content: center;

    flex: 0 0 34px;

    width: 34px;
    height: 34px;

    margin-right: 8px;

    border-radius: 50%;

    background: #f0f0f1;

    color: #50575e;

    font-size: 14px;

    transition:
        background .15s ease,
        color .15s ease;
}


/* -----------------------------------------------------
         * Text
         * -------------------------------------------------- */

.rm-bulk-badge-text {
    display: flex;

    flex-direction: column;

    line-height: 1.2;
}

.rm-bulk-badge-text strong {
    font-size: 11px;
}

.rm-bulk-badge-text small {
    margin-top: 2px;

    color: #646970;

    font-size: 9px;
}


/* -----------------------------------------------------
         * Selected
         * -------------------------------------------------- */

.rm-bulk-badge.is-selected {
    border-color: #2271b1;

    background: #f0f7fc;

    box-shadow:
        0 0 0 1px #2271b1;
}

.rm-bulk-badge.is-selected .rm-bulk-badge-icon {
    background: #2271b1;

    color: #fff;
}


/* -----------------------------------------------------
         * Responsive
         * -------------------------------------------------- */

@media screen and (max-width: 1100px) {

    .rm-bulk-badge-list {
        grid-template-columns:
            repeat(3,
                minmax(120px, 1fr));
    }
}


@media screen and (max-width: 782px) {

    .rm-bulk-edit-badges {
        max-width: none;
    }

    .rm-bulk-badge-list {
        grid-template-columns:
            repeat(2,
                minmax(120px, 1fr));
    }
}
</style>

<?php
}

add_action(
    'admin_footer-edit.php',
    'rm_bulk_edit_badges_css'
);


/**
 * Bulk Edit JavaScript.
 */
function rm_bulk_edit_badges_js() {

    global $post_type;

    if ( 'rm_menu_item' !== $post_type ) {
        return;
    }
    ?>

<script>
jQuery(function($) {

    /*
     * Update selected badge visual state.
     */
    function updateBulkBadgeCards() {

        $('.rm-bulk-badge').each(
            function() {

                const card = $(this);

                const checkbox =
                    card.find(
                        'input[type="checkbox"]'
                    );

                card.toggleClass(
                    'is-selected',
                    checkbox.is(':checked')
                );
            }
        );
    }


    /*
     * Clicking a badge.
     */
    $(document).on(
        'change',
        '.rm-bulk-badge input[type="checkbox"]',
        function() {

            updateBulkBadgeCards();

        }
    );


    /*
     * When changing action,
     * visually enable/disable badges.
     */
    $(document).on(
        'change',
        'input[name="rm_bulk_badge_action"]',
        function() {

            const action = $(
                'input[name="rm_bulk_badge_action"]:checked'
            ).val();

            const badges =
                $('.rm-bulk-badge');

            if (action === 'none') {

                badges.css(
                    'opacity',
                    '0.55'
                );

            } else {

                badges.css(
                    'opacity',
                    '1'
                );
            }
        }
    );


    /*
     * Initial state.
     */
    $('input[name="rm_bulk_badge_action"][value="none"]')
        .trigger('change');

});
</script>

<?php
}

add_action(
    'admin_footer-edit.php',
    'rm_bulk_edit_badges_js'
);
 