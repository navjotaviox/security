<?php
$default_settings = [
    'active_tab' => '1',
    'tabs' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings); 
$is_new = \Elementor\Icons_Manager::is_migration_allowed();
?>
<?php if(isset($tabs) && !empty($tabs) && count($tabs)): ?>
    <div class="ct-tab-form ct-tab-form1">
        <div class="ct-tabs-title">
            <?php foreach ($tabs as $key => $title): 
                $tab_title = isset($title['tab_title']) ? $title['tab_title'] : '';
                $tab_title_bgcolor = isset($title['tab_title_bgcolor']) ? $title['tab_title_bgcolor'] : '';
                $icon_type = isset($title['icon_type']) ? $title['icon_type'] : '';
                $selected_icon = isset($title['selected_icon']) ? $title['selected_icon'] : '';
                $icon_image = isset($title['icon_image']) ? $title['icon_image'] : '';
                $icon_key = $widget->get_repeater_setting_key( 'selected_icon', 'icons', $key );
                $has_icon = ! empty( $title['selected_icon'] );
                $widget->add_render_attribute( $icon_key, [
                    'class' => $title['selected_icon'],
                    'aria-hidden' => 'true',
                ] );
                ?>
                <span class="ct-tab-title <?php if($active_tab == $key + 1) { echo 'active'; } ?>" data-target="#<?php echo esc_attr($title['_id']); ?>" style="background-color: <?php echo esc_attr($tab_title_bgcolor); ?>">
                    <?php if($icon_type == 'icon') { ?>
                        <?php if($is_new):
                            \Elementor\Icons_Manager::render_icon( $title['selected_icon'], [ 'aria-hidden' => 'true' ] );
                        else: ?>
                            <i <?php ct_print_html($widget->get_render_attribute_string( $icon_key )); ?>></i>
                        <?php endif; ?>
                    <?php } else {
                        $img_icon_title  = ct_get_image_by_size( array(
                            'attach_id'  => $icon_image['id'],
                            'thumb_size' => 'full',
                        ) );
                        $thumbnail_icon_title  = $img_icon_title['thumbnail'];
                        echo ct_print_html($thumbnail_icon_title);
                    } ?>
                    <?php echo ct_print_html($tab_title); ?>    
                </span>
            <?php endforeach; ?>
        </div>

        <div class="ct-tabs-content">
            <?php foreach ($tabs as $key => $content): 
                $form_id = isset($content['form_id']) ? $content['form_id'] : '';
                $fancybox_title = isset($content['fancybox_title']) ? $content['fancybox_title'] : '';
                $fancybox_icon = isset($content['fancybox_icon']) ? $content['fancybox_icon'] : '';
                $fancybox_desc = isset($content['fancybox_desc']) ? $content['fancybox_desc'] : '';
                $img_icon  = ct_get_image_by_size( array(
                    'attach_id'  => $fancybox_icon['id'],
                    'thumb_size' => 'full',
                ) );
                $thumbnail_icon  = $img_icon['thumbnail'];
                ?>
                <div id="<?php echo esc_attr($content['_id']); ?>" class="ct-tab-content <?php if($active_tab == $key + 1) { echo 'active'; } ?>">
                    <div class="item-fancy-box">
                        <div class="fancy-box-meta">
                            <div class="fancy-box-image">
                                <?php echo ct_print_html($thumbnail_icon); ?>
                            </div>
                            <h5 class="fancy-box-title"><?php echo ct_print_html($fancybox_title); ?></h5>
                        </div>
                        <div class="fancy-box-desc"><?php echo ct_print_html($fancybox_desc); ?></div>
                    </div>
                    <div class="item-form">
                        <?php echo do_shortcode('[contact-form-7 id="'.esc_attr( $form_id ).'"]'); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>