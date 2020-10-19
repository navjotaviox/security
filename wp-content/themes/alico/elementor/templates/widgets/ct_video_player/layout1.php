<?php 
$default_settings = [
    'image' => '',
    'image_type' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);

if ( ! empty( $settings['image']['url'] ) ) {
    $widget->add_render_attribute( 'image', 'src', $settings['image']['url'] );
    $widget->add_render_attribute( 'image', 'alt', \Elementor\Control_Media::get_image_alt( $settings['image'] ) );
    $widget->add_render_attribute( 'image', 'title', \Elementor\Control_Media::get_image_title( $settings['image'] ) );
}

$image_html = \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' );
?>
<div class="ct-video-player <?php echo esc_attr($settings['ct_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['ct_animate_delay']); ?>ms">
    <?php if ($image_type == 'img') { ?>
        <?php if ( ! empty( $settings['image']['url'] ) ) { echo wp_kses_post($image_html); } ?>
    <?php } else { ?>
        <div class="ct-video-image-bg bg-image" style="background-image: url(<?php echo esc_url($image['url']); ?>);"></div>
    <?php } ?>
    <?php if(!empty($settings['video_link'])) : ?>
        <a class="ct-video-button <?php echo esc_attr($settings['btn_video_style']); ?>" href="<?php echo esc_url($settings['video_link']); ?>">
            <i class="fac fac-play"></i>
        </a>
    <?php endif; ?>
    <span></span>
</div>