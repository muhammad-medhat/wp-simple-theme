<?php
/**
 * Product Badges
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$badges = $args['badges'] ?? array();
$labels = array();


$badge_labels = rm_get_badge_labels();
if ( is_array( $badges ) ) {

    foreach ( $badges as $badge ) {

        if ( isset( $badge_labels[ $badge ] ) ) {

            $labels[] = array(
                'key'   => $badge,
                'ar'    => $badge_labels[ $badge ]['ar'],
                'en'    => $badge_labels[ $badge ]['en'],
                'icon'  => $badge_labels[ $badge ]['icon'],
            );
        }
    }
}
?>
<?php if ( ! empty($labels) ) : ?>

<div class="item-badges">

    <?php foreach ($labels as $label) : ?>

    <span class="item__badge item__badge--<?php
            echo esc_attr($label['key']);
        ?>">

        <i class="<?php
                echo esc_attr($label['icon']);
            ?>" aria-hidden="true"></i>

        <span class="item__badge-ar menu-name-ar">
            <?php echo esc_html($label['ar']); ?>
        </span>

        <span class="item__badge-en menu-name-en">
            <?php echo esc_html($label['en']); ?>
        </span>

    </span>

    <?php endforeach; ?>

</div>

<?php endif; ?>