<?php
$default_settings = [
    'style' => '',
    'button_color1' => '',
    'button_color2' => '',
    'button_label' => esc_html__('Subscribe', 'alico'),
    'email_label' => esc_html__('Your mail address', 'alico'),
];
$settings = array_merge($default_settings, $settings);
extract($settings);
$html_id = ct_get_element_id($settings);
if(class_exists('Newsletter')) : 
	$newsletter = Newsletter::instance();
	?>
    <div id="<?php echo esc_attr($html_id); ?>" class="ct-newsletter ct-newsletter1 <?php echo esc_attr($style); ?>">
	    <form class="newsletter" action="<?php echo esc_url($newsletter->build_action_url('s')); ?>" method="post" onsubmit="return newsletter_check(this)">
	    	<input type="hidden" name="nr" value="widget-minimal"/>
	    	<div class="tnp-field tnp-field-email">
	    		<label><?php echo esc_attr($email_label); ?></label>
	    		<input class="tnp-email" type="email" required name="ne" value="" placeholder="<?php echo esc_attr($email_label); ?>">
	    	</div>
	    	<div class="tnp-field tnp-field-button">
	    		<input class="tnp-button" type="submit" value="<?php echo esc_attr(esc_attr($button_label)); ?>">
	    	</div>
	    </form>
    </div>
<?php endif; ?>
