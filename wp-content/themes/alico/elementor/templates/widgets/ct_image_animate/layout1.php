<?php
$default_settings = [
    'content_list' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
$html_id = ct_get_element_id($settings);
?>
<?php if(isset($content_list) && !empty($content_list) && count($content_list)): ?>
	<div class="ct-image-animate">
		<?php foreach ($content_list as $key => $value): 
			$image  = ct_get_image_by_size( array(
                'attach_id'  => $value['image']['id'],
                'thumb_size' => 'full',
            ) );
            $image_tb    = $image['thumbnail'];
			?>
		    <div id="<?php echo esc_attr($html_id.$key); ?>" class="<?php echo esc_attr($value['image_animate']); ?>" data-wow-duration="1.5s">
		    	<div class="ct-inline-css"  data-css="
		            .ct-image-animate #<?php echo esc_attr($html_id.$key) ?> {
		            	<?php if(!empty($value['left_positioon']['size']) && $value['left_positioon']['size'] != '0') : ?>
		                	left: <?php echo esc_attr($value['left_positioon']['size']); ?>%;
		                <?php endif; ?>
		                <?php if(!empty($value['right_positioon']['size']) && $value['right_positioon']['size'] != '0') : ?>
		                	right: <?php echo esc_attr($value['right_positioon']['size']); ?>%;
		                <?php endif; ?>
		                <?php if(!empty($value['bottom_positioon']['size']) && $value['bottom_positioon']['size'] != '0') : ?>
		                	bottom: <?php echo esc_attr($value['bottom_positioon']['size']); ?>%;
		                <?php endif; ?>
		                <?php if(!empty($value['top_positioon']['size']) && $value['top_positioon']['size'] != '0') : ?>
		                	top: <?php echo esc_attr($value['top_positioon']['size']); ?>%;
		                <?php endif; ?>
		            }">
		        </div>
		    	<?php echo wp_kses_post($image_tb); ?>		
		    </div>
		<?php endforeach; ?>
	</div>
<?php endif; ?>
