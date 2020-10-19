<?php
$html_id = ct_get_element_id($settings);
if(class_exists('MC4WP_Container')) : ?>
    <div id="<?php echo esc_attr($html_id); ?>" class="ct-mailchimp ct-mailchimp1 <?php echo esc_attr($settings['style']); ?>">
    	<?php if(!empty($settings['button_bg_color']) && !empty($settings['button_bg_color2'])) : ?>
	        <div class="ct-inline-css"  data-css="
	            #<?php echo esc_attr($html_id) ?> .mc4wp-form .mc4wp-form-fields::before, #<?php echo esc_attr($html_id) ?> .mc4wp-form .mc4wp-form-fields input[type='submit'] {
	                background-image: -webkit-gradient(linear, left top, left bottom, from(<?php echo esc_attr($settings['button_bg_color']); ?>), to(<?php echo esc_attr($settings['button_bg_color2']); ?>));
	                background-image: -webkit-linear-gradient(left, <?php echo esc_attr($settings['button_bg_color']); ?>, <?php echo esc_attr($settings['button_bg_color2']); ?>);
	                background-image: -moz-linear-gradient(left, <?php echo esc_attr($settings['button_bg_color']); ?>, <?php echo esc_attr($settings['button_bg_color2']); ?>);
	                background-image: -ms-linear-gradient(left, <?php echo esc_attr($settings['button_bg_color']); ?>, <?php echo esc_attr($settings['button_bg_color2']); ?>);
	                background-image: -o-linear-gradient(left, <?php echo esc_attr($settings['button_bg_color']); ?>, <?php echo esc_attr($settings['button_bg_color2']); ?>);
	                background-image: linear-gradient(left, <?php echo esc_attr($settings['button_bg_color']); ?>, <?php echo esc_attr($settings['button_bg_color2']); ?>);
	                filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='<?php echo esc_attr($settings['button_bg_color']); ?>', endColorStr='<?php echo esc_attr($settings['button_bg_color2']); ?>');
	                background-color: transparent;
	            }">
	        </div>
	    <?php endif; ?>
	    <?php echo do_shortcode('[mc4wp_form]'); ?>
    </div>
<?php endif; ?>
