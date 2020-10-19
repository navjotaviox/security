<?php
$default_settings = [
    'award_medal' => '',
    'thumbnail_size' => '',
    'thumbnail_custom_dimension' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);

$widget->add_render_attribute( 'inner', [
    'class' => 'ct-carousel-inner',
] );

$col_xs = $widget->get_setting('col_xs', '');
$col_sm = $widget->get_setting('col_sm', '');
$col_md = $widget->get_setting('col_md', '');
$col_lg = $widget->get_setting('col_lg', '');
$col_xl = $widget->get_setting('col_xl', '');
$slides_to_scroll = $widget->get_setting('slides_to_scroll', '');

$arrows = $widget->get_setting('arrows');
$dots = $widget->get_setting('dots');
$pause_on_hover = $widget->get_setting('pause_on_hover');
$autoplay = $widget->get_setting('autoplay', '');
$autoplay_speed = $widget->get_setting('autoplay_speed', '5000');
$infinite = $widget->get_setting('infinite');
$speed = $widget->get_setting('speed', '500');
if (is_rtl()) {
    $carousel_dir = 'true';
} else {
    $carousel_dir = 'false';
}
$widget->add_render_attribute( 'carousel', [
    'class' => 'ct-slick-carousel slick-arrow-style2',
    'data-arrows' => $arrows,
    'data-dots' => $dots,
    'data-pauseOnHover' => $pause_on_hover,
    'data-autoplay' => $autoplay,
    'data-autoplaySpeed' => $autoplay_speed,
    'data-infinite' => $infinite,
    'data-speed' => $speed,
    'data-colxs' => $col_xs,
    'data-colsm' => $col_sm,
    'data-colmd' => $col_md,
    'data-collg' => $col_lg,
    'data-colxl' => $col_xl,
    'data-dir' => $carousel_dir,
    'data-slidesToScroll' => $slides_to_scroll,
] );
if($thumbnail_size != 'custom'){
    $img_size = $thumbnail_size;
}
elseif(!empty($thumbnail_custom_dimension['width']) && !empty($thumbnail_custom_dimension['height'])){
    $img_size = $thumbnail_custom_dimension['width'] . 'x' . $thumbnail_custom_dimension['height'];
}
else{
    $img_size = '400x300';
} 
?>
<?php if(isset($settings['award']) && !empty($settings['award']) && count($settings['award'])): ?>
<div class="ct-award-wrap">
    <?php if(!empty($award_medal)) : 
        $img_award_medal = ct_get_image_by_size( array(
            'attach_id'  => $award_medal['id'],
            'thumb_size' => 'full',
        ));
        $thumbnail_award_medal = $img_award_medal['thumbnail'];
        ?>
        <div class="ct-award-image"><?php echo ct_print_html($thumbnail_award_medal); ?></div>
    <?php endif; ?>
    <div class="ct-award ct-award-carousel1 ct-slick-slider">
        <div <?php ct_print_html($widget->get_render_attribute_string( 'inner' )); ?>>
            <div <?php ct_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                <?php foreach ($settings['award'] as $value): 
                    $title = isset($value['title']) ? $value['title'] : '';
                    $image = isset($value['image']) ? $value['image'] : '';
                    $img = ct_get_image_by_size( array(
                        'attach_id'  => $image['id'],
                        'thumb_size' => $img_size,
                    ));
                    $thumbnail = $img['thumbnail']; 

                    $logo = isset($value['logo']) ? $value['logo'] : '';
                    $img_logo = ct_get_image_by_size( array(
                        'attach_id'  => $logo['id'],
                        'thumb_size' => 'full',
                    ));
                    $thumbnail_logo = $img_logo['thumbnail']; 
                    ?>
                        <div class="slick-slide">
                            <div class="item--inner <?php echo esc_attr($settings['ct_animate']); ?>">
                                <?php if(!empty($image)) { ?>
                                    <div class="item--image">
                                        <?php echo ct_print_html($thumbnail); ?>
                                    </div>
                                    <div class="item--image-bg bg-image" style="background-image: url(<?php echo esc_url($image['url']); ?>);"></div>
                                <?php } ?>
                                <div class="item--holder">
                                    <?php if(!empty($logo)) { ?>
                                        <div class="item--logo">
                                            <?php echo ct_print_html($thumbnail_logo); ?>
                                        </div>
                                    <?php } ?>
                                    <h3 class="item--title">    
                                        <?php echo ct_print_html($title); ?>
                                    </h3>
                                </div>
                           </div>
                        </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
