<?php
$widget->add_render_attribute( 'selected_icon', 'class' );
$has_icon = ! empty( $settings['selected_icon'] );
if ( $has_icon ) {
    $widget->add_render_attribute( 'i', 'class', $settings['selected_icon'] );
    $widget->add_render_attribute( 'i', 'aria-hidden', 'true' );
}

$btn_icon = ! empty( $settings['btn_icon1'] );
if ( $btn_icon ) {
    $widget->add_render_attribute( 'btn_icon', 'class', $settings['btn_icon1'] );
    $widget->add_render_attribute( 'btn_icon', 'aria-hidden', 'true' );
}

$widget->add_render_attribute( 'description_text', 'class', 'item--description' );

$widget->add_inline_editing_attributes( 'title_text', 'none' );
$widget->add_inline_editing_attributes( 'description_text' );

$is_new = \Elementor\Icons_Manager::is_migration_allowed();

if ( ! empty( $settings['btn_link']['url'] ) ) {
    $widget->add_render_attribute( 'button', 'href', $settings['btn_link']['url'] );

    if ( $settings['btn_link']['is_external'] ) {
        $widget->add_render_attribute( 'button', 'target', '_blank' );
    }

    if ( $settings['btn_link']['nofollow'] ) {
        $widget->add_render_attribute( 'button', 'rel', 'nofollow' );
    }
}

if ( ! empty( $settings['btn_link2']['url'] ) ) {
    $widget->add_render_attribute( 'button2', 'href', $settings['btn_link2']['url'] );

    if ( $settings['btn_link2']['is_external'] ) {
        $widget->add_render_attribute( 'button2', 'target', '_blank' );
    }

    if ( $settings['btn_link2']['nofollow'] ) {
        $widget->add_render_attribute( 'button2', 'rel', 'nofollow' );
    }
}
?>
<div class="ct-fancy-box ct-fancy-box-layout4 <?php echo esc_attr($settings['ct_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['ct_animate_delay']); ?>ms">
    <?php if ( $settings['icon_type'] == 'icon' && $has_icon ) : ?>
        <div class="item--icon">
            <?php if($is_new):
                \Elementor\Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
                else: ?>
                <i <?php ct_print_html($widget->get_render_attribute_string( 'i' )); ?>></i>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <?php if ( $settings['icon_type'] == 'image' && !empty($settings['icon_image']['id']) ) : ?>
        <div class="item--icon">
            <?php $img_icon  = ct_get_image_by_size( array(
                    'attach_id'  => $settings['icon_image']['id'],
                    'thumb_size' => 'full',
                ) );
                $thumbnail_icon    = $img_icon['thumbnail'];
            echo ct_print_html($thumbnail_icon); ?>
        </div>
    <?php endif; ?>
    <div class="item--holder">
        <h3 class="item--title">
            <?php echo ct_print_html($settings['title_text']); ?>
        </h3>
        <div <?php ct_print_html($widget->get_render_attribute_string( 'description_text' )); ?>><?php echo ct_print_html($settings['description_text']); ?></div>
        
            <div class="item--button">
                <?php if ( ! empty( $settings['btn_text'] ) ) { ?>
                    <a class="btn <?php echo esc_attr($settings['btn_type1']); ?>" <?php ct_print_html($widget->get_render_attribute_string( 'button' )); ?>>
                        <?php if ( $btn_icon ) : ?>
                            <?php if($is_new):
                                \Elementor\Icons_Manager::render_icon( $settings['btn_icon1'], [ 'aria-hidden' => 'true' ] );
                                else: ?>
                                <i <?php ct_print_html($widget->get_render_attribute_string( 'btn_icon' )); ?>></i>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php echo esc_attr($settings['btn_text']); ?>
                    </a>
                <?php } ?>
                <?php if ( ! empty( $settings['btn_text2'] ) ) { ?>
                    <a class="btn-text" <?php ct_print_html($widget->get_render_attribute_string( 'button2' )); ?>>
                        <span><?php echo esc_attr($settings['btn_text2']); ?></span>
                        <i class="fac fa-angle-right space-left"></i>
                    </a>
                <?php } ?>
            </div>
        
    </div>
</div>