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

<?php if ( ! empty( $labels ) ) : ?>

<div class="item-badges">

    <?php foreach ( $labels as $label ) : ?>

    <span class="item__badge item__badge--<?php echo esc_attr( $label['key'] ); ?>">

        <span class="item__badge-ar" data-tooltip="<?php echo esc_html( $label['ar'] ); ?>">
            <i class="<?php echo esc_attr( $label['icon'] ); ?>" aria-hidden="true"></i>


        </span>

        <span class="item__badge-en" data-tooltip=" <?php echo esc_html( $label['en'] ); ?>">
            <i class="<?php echo esc_attr( $label['icon'] ); ?>" aria-hidden="true"></i>


        </span>

    </span>

    <?php endforeach; ?>

</div>

<?php endif; ?>