<?php
$default_settings = [
    'image' => '',
    'title' => '',
    'position' => '',
    'btn_text' => '',
    'btn_link' => '',
    'btn_style' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
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
<div class="ct-team-member">
	<?php if(!empty($image)) : 
		$img  = ct_get_image_by_size( array(
		    'attach_id'  => $settings['image']['id'],
		    'thumb_size' => '100x100',
		) );
		$thumbnail = $img['thumbnail'];
		?>
		<div class="ct-team-image"><?php echo ct_print_html($thumbnail); ?></div>
	<?php endif; ?>
	<div class="ct-team-meta">
		<h3 class="ct-team-title"><?php echo esc_attr($title); ?></h3>
		<div class="ct-team-position"><?php echo esc_attr($position); ?></div>
	</div>
	<?php if(!empty($btn_text)) : ?>
		<div class="ct-team-button">
			<a class="<?php echo esc_attr($btn_style); ?>" <?php ct_print_html($widget->get_render_attribute_string( 'button' )); ?>><i class="flaticon-group"></i><?php echo esc_attr($btn_text); ?></a>
		</div>
	<?php endif; ?>
</div>