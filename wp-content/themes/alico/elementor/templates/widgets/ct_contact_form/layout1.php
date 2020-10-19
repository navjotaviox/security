<?php
$default_settings = [
    'form_id' => '',
    'title' => '',
    'description' => '',
    'style' => 'style1',
    'ct_animate' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);

if(class_exists('WPCF7') && !empty($form_id)) : ?>
    <div class="ct-contact-form-layout1 <?php echo esc_attr($style.' '.$ct_animate); ?>">
    	<?php if(!empty($title) || !empty($description)) : ?>
	    	<div class="ct-contact-meta">
	    		<h3><?php echo esc_attr($title); ?></h3>
	    		<p><?php echo ct_print_html($description); ?></p>
	    	</div>
	    <?php endif; ?>
        <div class="ct-contact-form">
            <?php echo do_shortcode('[contact-form-7 id="'.esc_attr( $form_id ).'"]'); ?>
        </div>
    </div>
<?php endif; ?>
