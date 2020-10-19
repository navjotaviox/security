<?php
$default_settings = [
    'contact_info' => '',
    'ct_animate' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
$has_icon = ! empty( $settings['ct_icon'] );
if ( $has_icon ) {
    $widget->add_render_attribute( 'i', 'class', $settings['ct_icon'] );
    $widget->add_render_attribute( 'i', 'aria-hidden', 'true' );
}
$is_new = \Elementor\Icons_Manager::is_migration_allowed();
?>
<?php if(isset($settings['contact_info']) && !empty($settings['contact_info']) && count($settings['contact_info'])): ?>
    <ul class="ct-contact-info ct-contact-info1 <?php echo esc_attr($ct_animate); ?>" data-wow-duration="1.2s">
        <?php
        	foreach ($settings['contact_info'] as $key => $ct_info):
        		$icon_key = $widget->get_repeater_setting_key( 'ct_icon', 'contact_info', $key );

        		$has_icon = ! empty( $ct_info['ct_icon'] );
        		$widget->add_render_attribute( $icon_key, [
	                'class' => $ct_info['ct_icon'],
	                'aria-hidden' => 'true',
	            ] );
			?>
            <li>
            	<?php if ( $ct_info['icon_type'] == 'icon' && $has_icon ) : ?>
			        <span class="ct-contact-icon">
		                <?php
		                    if($is_new):
		                        \Elementor\Icons_Manager::render_icon( $ct_info['ct_icon'], [ 'aria-hidden' => 'true' ] );
		                ?>
		                <?php else: ?>
		                    <i <?php ct_print_html($widget->get_render_attribute_string( $icon_key )); ?>></i>
		                <?php endif; ?>
			        </span>
			    <?php endif; ?>
                <?php if ( $ct_info['icon_type'] == 'image' && !empty($ct_info['icon_image']) ) : 
                    $img_icon  = ct_get_image_by_size( array(
                        'attach_id'  => $ct_info['icon_image']['id'],
                        'thumb_size' => 'full',
                    ) );
                    $thumbnail_icon    = $img_icon['thumbnail'];
                    ?>
                    <span class="ct-contact-icon">
                        <?php echo ct_print_html($thumbnail_icon); ?>
                    </span>
                <?php endif; ?>
                <span class="ct-contact-content">
            	   <?php echo ct_print_html($ct_info['content'])?>
                </span>
           </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
