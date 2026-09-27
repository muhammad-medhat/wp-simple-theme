<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


/*
|--------------------------------------------------------------------------
| 1. Add Badges field to Quick Edit
|--------------------------------------------------------------------------
*/

function rm_quick_edit_badges_field( $column_name, $post_type ) {

    global $post_type;

    if ( RM_MENU_ITEM_CPT !== $post_type ) {
        return;
    }
    /*
     * Only output the badge field once.
     *
     * Replace this with the actual column where
     * you want the Quick Edit field to appear.
     */
    if ( 'rm_badges' !== $column_name ) {
        return;
    }
    $badges = rm_get_badge_labels();
    ?>

<fieldset class="inline-edit-col-right rm-quick-edit-badges">
    <div class="inline-edit-col">

        <div class="rm-quick-edit-title">
            <strong><?php esc_html_e( 'Menu Badges', 'restaurant-menu' ); ?></strong>
            <span>
                <?php esc_html_e( 'Select one or more', 'restaurant-menu' ); ?>
            </span>
        </div>

        <div class="rm-quick-edit-badge-list">

            <?php foreach ( $badges as $key => $badge ) : ?>

            <label class="rm-quick-edit-badge">

                <input type="checkbox" name="rm_quick_badges[]" value="<?php echo esc_attr( $key ); ?>">

                <span class="rm-quick-badge-icon">
                    <i class="<?php echo esc_attr( $badge['icon'] ); ?>" aria-hidden="true"></i>
                </span>

                <span class="rm-quick-badge-text">
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

        <!-- Hidden post ID -->
        <input type="hidden" name="rm_quick_edit_post_id" value="">

    </div>
</fieldset>

<?php
}

add_action( 'quick_edit_custom_box', 'rm_quick_edit_badges_field', 10, 2);
// add_action( 'bulk_edit_custom_box', 'rm_quick_edit_badges_field', 10, 2);


/*
|--------------------------------------------------------------------------
| 2. Add current badges to Quick Edit using JavaScript
|--------------------------------------------------------------------------
*/

function rm_quick_edit_badges_data() {

    global $post_type;

    if ( RM_MENU_ITEM_CPT !== $post_type ) {
        return;
    }

    $data = array();

    $posts = get_posts(
        array(
            'post_type'      => RM_MENU_ITEM_CPT,
            'posts_per_page' => -1,
            'post_status'    => array( 'publish', 'draft', 'pending', 'private' ),
        )
    );

    foreach ( $posts as $post ) {

        $badges = get_field('badges', $post->ID );

        if ( ! is_array( $badges ) ) {
            $badges = empty( $badges )
                ? array()
                : array( $badges );
        }

        $data[ $post->ID ] = $badges;
    }

    wp_register_script(
        'rm-quick-edit-badges',
        false,
        array( 'jquery', 'inline-edit-post' ),
        '1.0.0',
        true
    );

    wp_enqueue_script(
        'rm-quick-edit-badges'
    );

    wp_add_inline_script(
        'rm-quick-edit-badges',
        'window.rmQuickEditBadges = ' .
        wp_json_encode( $data ) .
        ';'
    );
}

add_action( 'admin_enqueue_scripts', 'rm_quick_edit_badges_data');


/*
|--------------------------------------------------------------------------
| 3. Save badges
|--------------------------------------------------------------------------
*/

function rm_save_quick_edit_badges( $post_id ) {

    if (
        ! isset( $_POST['rm_quick_edit_post_id'] )
        ||
        (int) $_POST['rm_quick_edit_post_id'] !== (int) $post_id
    ) {
        return;
    }

    if (
        ! current_user_can('edit_post', $post_id ) ) {
        return;
    }

    $badges = isset( $_POST['rm_quick_badges'] )
        ? (array) $_POST['rm_quick_badges']
        : array();

    $badge_labels = rm_get_badge_labels();

    /*
     * Only allow badges that actually exist
     * in our shared badge definitions.
     */
    $badges = array_values(
        array_intersect(
            $badges,
            array_keys( $badge_labels )
        )
    );

    update_field(  'badges', $badges, $post_id );
}

add_action('save_post_rm_menu_item',   'rm_save_quick_edit_badges');
add_action('save_post',   'rm_save_quick_edit_badges');


/*
|--------------------------------------------------------------------------
| 4. Quick Edit JavaScript
|--------------------------------------------------------------------------
*/

function rm_quick_edit_badges_script() {

    global $post_type;

    if ( RM_MENU_ITEM_CPT !== $post_type ) {
        return;
    }
    ?>

<script>
jQuery(function($) {

    /*
     * Store original WordPress Quick Edit function.
     */
    const originalEdit =
        inlineEditPost.edit;

    /*
     * Replace Quick Edit function.
     */
    inlineEditPost.edit = function(id) {

        /*
         * Run WordPress original Quick Edit.
         */
        originalEdit.apply(
            this,
            arguments
        );

        let postId = 0;

        if (typeof id === 'object') {

            postId = parseInt(this.getId(id));

        } else {

            postId = parseInt(id);

        }

        if (!postId) {
            return;
        }

        /*
         * Find Quick Edit row.
         */
        const editRow = $('#edit-' + postId);

        if (!editRow.length) {
            return;
        }

        /*
         * Set hidden post ID.
         */
        editRow.find('input[name="rm_quick_edit_post_id"]').val(postId);

        /*
         * Get existing badges.
         */
        const currentBadges =
            window.rmQuickEditBadges &&
            window.rmQuickEditBadges[postId] ?
            window.rmQuickEditBadges[postId] : [];

        /*
         * Reset all checkboxes.
         */
        editRow
            .find(
                'input[name="rm_quick_badges[]"]'
            )
            .prop(
                'checked',
                false
            );

        /*
         * Check current badges.
         */
        currentBadges.forEach(function(badge) {

            editRow
                .find(
                    'input[name="rm_quick_badges[]"][value="' +
                    badge +
                    '"]'
                )
                .prop(
                    'checked',
                    true
                );

        });

        /*
         * Update visual selected state.
         */
        updateBadgeCards(editRow);
    };


    /*
     * Update badge card appearance.
     */
    function updateBadgeCards(container) {

        container
            .find('.rm-quick-edit-badge')
            .each(function() {

                const card = $(this);

                const checkbox =
                    card.find(
                        'input[type="checkbox"]'
                    );

                card.toggleClass(
                    'is-selected',
                    checkbox.is(':checked')
                );

            });
    }


    /*
     * Update cards when clicked.
     */
    $(document).on(
        'change',
        '.rm-quick-edit-badge input[type="checkbox"]',
        function() {

            updateBadgeCards(
                $(this).closest(
                    '.inline-edit-row'
                )
            );

        }
    );

});
</script>

<?php
}

add_action('admin_footer-edit.php', 'rm_quick_edit_badges_script');


/*
|--------------------------------------------------------------------------
| 5. Quick Edit CSS
|--------------------------------------------------------------------------
*/

function rm_quick_edit_badges_css() {

    global $post_type;

    if ( RM_MENU_ITEM_CPT !== $post_type ) {
        return;
    }
    ?>

<style>
/*
         * Container
         */
.rm-quick-edit-badges {
    width: 360px;
}

/*
         * Title
         */
.rm-quick-edit-title {
    margin-bottom: 12px;
}

.rm-quick-edit-title strong {
    display: block;
    font-size: 13px;
    margin-bottom: 3px;
}

.rm-quick-edit-title span {
    display: block;
    color: #646970;
    font-size: 11px;
}

/*
         * Badge grid
         */
.rm-quick-edit-badge-list {
    display: grid;
    grid-template-columns:
        repeat(2, minmax(0, 1fr));

    gap: 8px;
}

/*
         * Badge card
         */
.rm-quick-edit-badge {
    position: relative;

    display: flex !important;
    align-items: center;

    /* min-height: 54px; */

    margin: 0 !important;
    padding: 8px 10px;

    background: #fff;

    border: 1px solid #dcdcde;
    border-radius: 8px;

    cursor: pointer;

    transition:
        border-color .15s ease,
        background .15s ease,
        box-shadow .15s ease;
}

.rm-quick-edit-badge:hover {
    border-color: #8c8f94;
}

/*
         * Hide checkbox visually
         */
.rm-quick-edit-badge input {
    position: absolute;

    opacity: 0;

    pointer-events: none;
}

/*
         * Icon
         */
.rm-quick-badge-icon {
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

/*
         * Text
         */
.rm-quick-badge-text {
    display: flex;
    flex-direction: column;

    line-height: 1.2;
}

.rm-quick-badge-text strong {
    font-size: 12px;
}

.rm-quick-badge-text small {
    margin-top: 2px;

    color: #646970;

    font-size: 10px;
}

/*
         * Selected
         */
.rm-quick-edit-badge.is-selected {
    border-color: #2271b1;

    background: #f0f7fc;

    box-shadow:
        0 0 0 1px #2271b1;
}

.rm-quick-edit-badge.is-selected .rm-quick-badge-icon {
    background: #2271b1;
    color: #fff;
}

/*
         * Mobile / narrow admin screen
         */
@media screen and (max-width: 782px) {

    .rm-quick-edit-badges {
        width: auto;
    }

    .rm-quick-edit-badge-list {
        grid-template-columns:
            repeat(2, minmax(0, 1fr));
    }

}
</style>

<?php
}

add_action('admin_footer-edit.php', 'rm_quick_edit_badges_css');