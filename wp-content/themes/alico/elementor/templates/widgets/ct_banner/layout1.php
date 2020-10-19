<?php
$default_settings = [
    'banner_image' => '',
    'banner_title' => '',
    'banner_number' => '',
    'ct_icon' => '',
    'counter_title' => '',
    'counter_number' => '',
    'counter_number_suffix' => '',
    'layer_image1' => '',
    'layer_image2' => '',
    'el_layout' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
$img = ct_get_image_by_size( array(
	'attach_id'  => $banner_image['id'],
	'thumb_size' => 'full',
));
$thumbnail = $img['thumbnail']; 
$is_new = \Elementor\Icons_Manager::is_migration_allowed();
$has_icon = ! empty( $ct_icon );
if ( $has_icon ) {
    $widget->add_render_attribute( 'i', 'class', $ct_icon );
    $widget->add_render_attribute( 'i', 'aria-hidden', 'true' );
}
if(!empty($banner_image['id'])) : ?>
	<div class="ct-banner layout-<?php echo esc_attr($el_layout); ?>">
		<?php echo wp_kses_post($thumbnail); ?>
		<div class="shape-angle"></div>
		<?php if($el_layout == '2') { ?>
			<?php if(!empty($layer_image1['url'])) : ?>
				<div class="ct-banner-layer1"><img src="<?php echo esc_url($layer_image1['url']); ?>" /></div>
			<?php endif; ?>
			<?php if(!empty($layer_image2['url'])) : ?>
				<div class="ct-banner-layer2"><img src="<?php echo esc_url($layer_image2['url']); ?>" /></div>
			<?php endif; ?>
		<?php } ?>
		<div class="ct-banner-counter">
			<?php if ( $has_icon ) : ?>
		        <div class="item--icon">
		            <?php if($is_new):
		                \Elementor\Icons_Manager::render_icon( $ct_icon, [ 'aria-hidden' => 'true' ] );
		                else: ?>
		                <i <?php ct_print_html($widget->get_render_attribute_string( 'i' )); ?>></i>
		            <?php endif; ?>
		        </div>
		    <?php endif; ?>
		    <div class="ct-counter-meta">
			    <div class="ct-counter-number">
			    	<span class="ct-counter-number-value" data-duration="2000" data-to-value="<?php echo esc_attr($counter_number); ?>" data-delimiter=","></span>
			    	<span class="ct-counter-number-suffix"><?php echo esc_attr($counter_number_suffix); ?></span>
			    </div>
				<div class="item-title"><?php echo esc_attr($counter_title); ?></div>
			</div>
		</div>
		<h4 class="ct-banner-title"><?php echo esc_attr($banner_title); ?></h4>
		<div class="ct-banner-number"><?php echo esc_attr($banner_number); ?></div>
	</div>
<?php endif; ?>