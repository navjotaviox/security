<?php
$default_settings = [
    'title' => '',
    'phone_label' => '',
    'phone_number' => '',
    'email_label' => '',
    'email' => '',
    'image' => '',
    'ct_animate' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
$html_id = ct_get_element_id($settings);
if ( ! empty( $btn_link['url'] ) ) {
    $widget->add_render_attribute( 'button', 'href', $btn_link['url'] );

    if ( $btn_link['is_external'] ) {
        $widget->add_render_attribute( 'button', 'target', '_blank' );
    }

    if ( $btn_link['nofollow'] ) {
        $widget->add_render_attribute( 'button', 'rel', 'nofollow' );
    }
}
$is_new = \Elementor\Icons_Manager::is_migration_allowed();

?>
<div class="ct-cta1 bg-image <?php echo esc_attr($ct_animate); ?>">
    <div class="ct-cta-content">
        <?php if(!empty($title)) : ?>
            <h3 class="item--title"><?php echo ct_print_html($title); ?></h3>
        <?php endif; ?>
        <div class="ct-cta-holder">
            <?php if(!empty($phone_number)) : ?>
                <div class="ct-cta-info">
                    <div class="ct-cta-label"><span><?php echo esc_attr($phone_label); ?></span></div>
                    <a href="tel:<?php echo esc_attr($phone_number); ?>"><i class="flaticon-telephone-call"></i><?php echo esc_attr($phone_number); ?></a>
                </div>
            <?php endif; ?>
            <div class="ct-cta-text"><?php echo esc_html__('or', 'alico'); ?><span></span></div>
            <?php if(!empty($email)) : ?>
                <div class="ct-cta-info">
                    <div class="ct-cta-label"><span><?php echo esc_attr($email_label); ?></span></div>
                    <a href="mailto:<?php echo esc_attr($email); ?>"><i class="flaticon-v2-mail"></i><?php echo esc_attr($email); ?></a>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php if(!empty($image['id'])) : 
        $img  = ct_get_image_by_size( array(
            'attach_id'  => $image['id'],
            'thumb_size' => 'full',
        ) );
        $thumbnail = $img['thumbnail'];
        ?>
        <div class="ct-cta-image">
            <?php echo wp_kses_post($thumbnail); ?>
        </div>
    <?php endif; ?>
</div>
