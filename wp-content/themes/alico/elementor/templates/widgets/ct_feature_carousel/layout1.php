<?php
$widget->add_render_attribute( 'inner', [
    'class' => 'ct-carousel-inner',
] );

$col_xs = $widget->get_setting('col_xs', '');
$col_sm = $widget->get_setting('col_sm', '');
$col_md = $widget->get_setting('col_md', '');
$col_lg = $widget->get_setting('col_lg', '');
$col_xl = $widget->get_setting('col_xl', '');
$slides_to_scroll = $widget->get_setting('slides_to_scroll', '');

$vertical = $widget->get_setting('vertical');
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
    'class' => 'ct-slick-carousel',
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
    'data-vertical'=> $vertical
] );
$html_id = ct_get_element_id($settings);
?>
<?php if(isset($settings['feature']) && !empty($settings['feature']) && count($settings['feature'])): ?>
    <div class="ct-feature ct-feature-carousel1 ct-slick-slider">
        <div <?php ct_print_html($widget->get_render_attribute_string( 'inner' )); ?>>
            <div <?php ct_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                <?php foreach ($settings['feature'] as $key => $value): 
                    $title = isset($value['title']) ? $value['title'] : '';
                    $description = isset($value['description']) ? $value['description'] : '';
                    $number_value = isset($value['number_value']) ? $value['number_value'] : '';
                    $box_color = isset($value['box_color']) ? $value['box_color'] : '';
                    $box_space_left = isset($value['box_space_left']) ? $value['box_space_left'] : '';
                    $suffix = isset($value['suffix']) ? $value['suffix'] : '';
                    ?>
                    <div class="slick-slide">
                        <div id="<?php echo esc_attr($html_id.$key); ?>" class="item--inner <?php echo esc_attr($settings['ct_animate']); ?>">
                            <div class="ct-inline-css"  data-css="
                                .ct-feature #<?php echo esc_attr($html_id.$key) ?> {
                                    margin-left: <?php echo esc_attr($box_space_left['size']); ?>px;
                                }
                                .ct-feature #<?php echo esc_attr($html_id.$key) ?> .item--counter {
                                    background-color: <?php echo esc_attr($box_color); ?>;
                                }
                                <?php if(!empty($box_color)) : ?>
                                .ct-feature #<?php echo esc_attr($html_id.$key) ?>:before {
                                    border-color: transparent <?php echo esc_attr($box_color); ?> <?php echo esc_attr($box_color); ?> transparent;
                                }<?php endif; ?>">
                            </div>
                            <div class="item--counter">
                                <span class="ct-counter-number-value" data-duration="2000" data-to-value="<?php echo esc_html($number_value); ?>" data-delimiter=""></span>
                                <span class="ct-counter-number-suffix"><?php echo ct_print_html($suffix); ?></span>
                            </div>
                            <div class="item--holder">
                                <h3 class="item--title">    
                                    <?php echo esc_attr($title); ?>
                                </h3>
                                <div class="item--description"><?php echo esc_html($description); ?></div>
                            </div>
                       </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
