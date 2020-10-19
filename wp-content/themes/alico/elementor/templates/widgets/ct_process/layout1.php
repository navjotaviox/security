<?php
$default_settings = [
    'content_list' => '',
    'column' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
$is_new = \Elementor\Icons_Manager::is_migration_allowed();
?>
<?php if(isset($content_list) && !empty($content_list) && count($content_list)): ?>
    <div class="ct-process ct-process1 ct-process-<?php echo esc_attr($column); ?>-column">
        <?php foreach ($content_list as $key => $value):
            $title = isset($value['title']) ? $value['title'] : '';
            $description = isset($value['description']) ? $value['description'] : '';
            $icon_type = isset($value['icon_type']) ? $value['icon_type'] : '';
            $icon = isset($value['ct_icon']) ? $value['ct_icon'] : '';
            $icon_key = $widget->get_repeater_setting_key( 'ct_icon', 'icons', $key );
            $has_icon = ! empty( $value['ct_icon'] );
            $widget->add_render_attribute( $icon_key, [
                'class' => $icon,
                'aria-hidden' => 'true',
            ] );
            $icon_image = isset($value['icon_image']) ? $value['icon_image'] : '';
            ?>
            <div class="ct-process-item">
                <?php if($icon_type == 'icon' && !empty($icon)) { ?>
                    <div class="item--icon">
                        <?php
                            if($is_new):
                                \Elementor\Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true' ] );
                        ?>
                        <?php else: ?>
                            <i <?php ct_print_html($widget->get_render_attribute_string( $icon_key )); ?>></i>
                        <?php endif; ?>
                        <?php if($key > 0) : ?>
                            <div class="ct-process-divider"></div>
                        <?php endif; ?>
                    </div>
                <?php } ?>
                <?php if($icon_type == 'image' && !empty($icon_image)) { 
                    $img = ct_get_image_by_size( array(
                        'attach_id'  => $icon_image['id'],
                        'thumb_size' => 'full',
                    ));
                    $thumbnail = $img['thumbnail']; ?>
                    <div class="item--icon">
                        <?php echo wp_kses_post($thumbnail); ?>
                        <?php if($key > 0) : ?>
                            <div class="ct-process-divider"></div>
                        <?php endif; ?>
                    </div>
                <?php } ?>
                <?php if(!empty($title)) : ?>
                    <h3 class="ct-process-title"><?php echo esc_attr($title); ?></h3>
                <?php endif; ?>
                <?php if(!empty($description)) : ?>
                    <div class="ct-process-description"><?php echo ct_print_html($description); ?></div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>