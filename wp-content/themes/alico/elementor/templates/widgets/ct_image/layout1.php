<?php 
$default_settings = [
    'image' => '',
    'image_type' => '',
    'image_link' => '',
    'img_size' => '',
    'ct_animate' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
$size = 'full';
if(!empty($img_size)) {
    $size = $img_size;
} else {
    $size = 'full';
}
$img  = ct_get_image_by_size( array(
    'attach_id'  => $image['id'],
    'thumb_size' => $size,
) );
$thumbnail    = $img['thumbnail'];
if ( ! empty( $image_link['url'] ) ) {
    $widget->add_render_attribute( 'image_link', 'href', $image_link['url'] );

    if ( $image_link['is_external'] ) {
        $widget->add_render_attribute( 'image_link', 'target', '_blank' );
    }

    if ( $image_link['nofollow'] ) {
        $widget->add_render_attribute( 'image_link', 'rel', 'nofollow' );
    }
}
?>
<div class="ct-image-single <?php echo esc_attr($ct_animate); ?>" data-wow-duration="1.2s" data-wow-delay="<?php echo esc_attr($settings['ct_animate_delay']); ?>ms">
    <?php if ($image_type == 'img') { ?>
        <?php if ( ! empty( $image_link['url'] ) ) { ?><a <?php ct_print_html($widget->get_render_attribute_string( 'image_link' )); ?>><?php } ?>
            <?php if ( ! empty( $image['url'] ) ) { echo wp_kses_post($thumbnail); } ?>
        <?php if ( ! empty( $image_link['url'] ) ) { ?></a><?php } ?>
    <?php } else { ?>
        <div class="ct-image-bg bg-image" style="background-image: url(<?php echo esc_url($image['url']); ?>);"></div>
    <?php } ?>
</div>