<?php
$default_settings = [
    'text_color' => '',
    'text_color_gradient' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
$html_id = ct_get_element_id($settings);

$editor_content = $widget->get_settings_for_display( 'text_editor' );

$editor_content = $widget->parse_text_editor( $editor_content );

$widget->add_render_attribute( 'text_editor', 'class', [ 'ct-text-editor', 'elementor-clearfix' ] );

$widget->add_inline_editing_attributes( 'text_editor', 'advanced' );
?>
<div id="<?php echo esc_attr($html_id); ?>" class="ct-text-editor <?php echo esc_attr($settings['ct_animate']); ?>">
	<div class="ct-inline-css"  data-css="
        <?php if(!empty($text_color_gradient)) : ?>
            #<?php echo esc_attr($html_id) ?> .ct-text-editor {
                background-image: -webkit-gradient(linear, left top, left bottom, from(<?php echo esc_attr($text_color); ?>), to(<?php echo esc_attr($text_color_gradient); ?>));
				background-image: -webkit-linear-gradient(top, <?php echo esc_attr($text_color); ?>, <?php echo esc_attr($text_color_gradient); ?>);
				background-image: -moz-linear-gradient(top, <?php echo esc_attr($text_color); ?>, <?php echo esc_attr($text_color_gradient); ?>);
				background-image: -ms-linear-gradient(top, <?php echo esc_attr($text_color); ?>, <?php echo esc_attr($text_color_gradient); ?>);
				background-image: -o-linear-gradient(top, <?php echo esc_attr($text_color); ?>, <?php echo esc_attr($text_color_gradient); ?>);
				background-image: linear-gradient(top, <?php echo esc_attr($text_color); ?>, <?php echo esc_attr($text_color_gradient); ?>);
				filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='<?php echo esc_attr($text_color); ?>', endColorStr='<?php echo esc_attr($text_color_gradient); ?>');
				background-color: transparent;
				background-clip: text;
				-o-background-clip: text;
				-ms-background-clip: text;
				-moz-background-clip: text;
				-webkit-background-clip: text;
				text-fill-color: transparent;
				-o-text-fill-color: transparent;
				-ms-text-fill-color: transparent;
				-moz-text-fill-color: transparent;
				-webkit-text-fill-color: transparent;
            }
        <?php endif; ?>">
    </div>
	<div <?php echo ''.$widget->get_render_attribute_string( 'text_editor' ); ?>><?php echo wp_kses_post($editor_content); ?></div>
</div>