<?php
$default_settings = [
    'list' => '',
    'style' => 'style1',
    'ct_animate' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
?>
<?php if(isset($list) && !empty($list) && count($list)): ?>
    <div class="ct-list <?php echo esc_attr($style.' '.$ct_animate); ?>">
        <?php
        	foreach ($list as $key => $ct_list): ?>
            <div class="ct-list-item">
            	<div class="ct-list-icon"><i class="ct-list-dot"></i></div>
            	<div class="ct-list-meta">
	            	<div class="ct-list-desc">
	            		<?php echo esc_html($ct_list['list_content'])?>
	            	</div>
	            </div>
           </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
