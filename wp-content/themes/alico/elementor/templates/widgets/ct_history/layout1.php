<?php
$default_settings = [
    'history' => '',
    'start_text' => '',
    'end_image' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
$img = ct_get_image_by_size( array(
	'attach_id'  => $end_image['id'],
	'thumb_size' => '150x150',
));
$thumbnail = $img['thumbnail']; 
?>
<div class="ct-history1">
	<?php if(!empty($start_text)) : ?>
		<div class="ct-history--start">
			<?php echo esc_attr($start_text); ?>
		</div>
	<?php endif; ?>
	<?php if(isset($history) && !empty($history) && count($history)): ?>
		<div class="ct-history--holder">
			<div class="ct-history--odd">
				<?php foreach ($history as $key => $value): 
					if($key%2==1) { ?>
						<div class="ct-history--item">
							<div class="ct-history--meta">
								<h3><?php echo esc_attr($value['title']); ?></h3>
								<span><?php echo esc_html($value['content'])?></span>
							</div>
						</div>
					<?php } ?>
				<?php endforeach; ?>
			</div>
			<div class="ct-history--even">
				<?php foreach ($history as $key => $value): 
					if($key%2==0) { ?>
						<div class="ct-history--item">
							<div class="ct-history--meta">
								<h3><?php echo esc_attr($value['title']); ?></h3>
								<span><?php echo esc_html($value['content'])?></span>
							</div>
						</div>
					<?php } ?>
				<?php endforeach; ?>
			</div>
		</div>
	<?php endif; ?>
	<?php if(!empty($end_image['id'])) : ?>
		<div class="ct-history--image">
			<?php echo wp_kses_post($thumbnail); ?>
		</div>
	<?php endif; ?>
</div>