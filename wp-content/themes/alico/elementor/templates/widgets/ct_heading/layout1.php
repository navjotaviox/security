<?php
$default_settings = [
    'title' => '',
    'title_tag' => 'h3',
    'style' => '',
    'sub_title_style' => '',
    'sub_title' => '',
    'content_alignment_section' => 'left',
    'text_align' => '',
    'ct_animate' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings); ?>
<div class="ct-heading ct-heading-<?php echo esc_attr($style); ?> h-align-<?php echo esc_attr($text_align); ?> <?php echo esc_attr($ct_animate); ?>" data-wow-duration="1.2s">
	<?php if(!empty($sub_title)) : ?>
		<div class="item--sub-title <?php echo esc_attr($sub_title_style); ?>">
            <span><?php echo esc_attr($sub_title); ?></span>
        </div>
	<?php endif; ?>
    <?php if($style == 'line') : ?>
        <div class="line-divider"><span></span></div>
    <?php endif; ?>
    <<?php echo esc_attr($title_tag); ?> class="item--title">
        <?php if($style == 'dot') : ?>
            <i class="dot-shape">
                <i></i>
                <i></i>
                <i></i>
                <i></i>
                <i></i>
                <i></i>
            </i>
        <?php endif; ?>
        <?php echo ct_print_html($title); ?>
    </<?php echo esc_attr($title_tag); ?>>
</div>