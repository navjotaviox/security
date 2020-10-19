<?php
$default_settings = [
    'image' => '',
    'title' => '',
    'btn_text' => '',
    'button_link' => '',
    'ct_animate' => '',
    'ct_animate_delay' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
if ( ! empty( $button_link['url'] ) ) {
    $widget->add_render_attribute( 'button', 'href', $button_link['url'] );

    if ( $button_link['is_external'] ) {
        $widget->add_render_attribute( 'button', 'target', '_blank' );
    }

    if ( $button_link['nofollow'] ) {
        $widget->add_render_attribute( 'button', 'rel', 'nofollow' );
    }
}
$img = ct_get_image_by_size( array(
	'attach_id'  => $image['id'],
	'thumb_size' => 'full',
	'class'      => '',
));
$thumbnail = $img['thumbnail'];
?>
<div class="ct-showcase1 <?php echo esc_attr($ct_animate); ?>" data-wow-delay="<?php echo esc_attr($ct_animate_delay); ?>ms" data-wow-duration="1.2s">
	<?php if(!empty($image['url'])) : ?>
	    <div class="ct-showcase-image">
	    	<?php echo wp_kses_post($thumbnail); ?>
	    	<div class="ct-showcase-overlay"></div>
	    	<?php if(!empty($btn_text)) : ?>
	    		<a <?php ct_print_html($widget->get_render_attribute_string( 'button' )); ?> class="ct-showcase-link btn"><?php echo esc_attr($btn_text); ?></a>
	    	<?php endif; ?>
	    </div>
	<?php endif; ?>
    <?php if(!empty($title)) : ?>
	    <div class="ct-showcase-meta">
	    	<h3><?php echo wp_kses_post($title); ?></h3>
	    </div>
	<?php endif; ?>
</div>