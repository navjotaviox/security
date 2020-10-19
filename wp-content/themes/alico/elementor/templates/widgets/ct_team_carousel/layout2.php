<?php
$default_settings = [
    'team' => '',
    'thumbnail_size' => 'full',
    'thumbnail_custom_dimension' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);

if($thumbnail_size != 'custom'){
    $img_size = $thumbnail_size;
}
elseif(!empty($thumbnail_custom_dimension['width']) && !empty($thumbnail_custom_dimension['height'])){
    $img_size = $thumbnail_custom_dimension['width'] . 'x' . $thumbnail_custom_dimension['height'];
}
else{
    $img_size = '168x168';
}

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
    'data-centerMode' => 'true',
] );

?>
<?php if(isset($team) && !empty($team) && count($team)): ?>
    <div class="ct-team ct-team-carousel2 ct-slick-slider">
        <div <?php ct_print_html($widget->get_render_attribute_string( 'inner' )); ?>>
            <div <?php ct_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                <?php foreach ($team as $key => $value) :
                    $title = isset($value['title']) ? $value['title'] : '';
                    $position = isset($value['position']) ? $value['position'] : '';
                    $desc = isset($value['desc']) ? $value['desc'] : '';
                    $image = isset($value['image']) ? $value['image'] : '';
                    $img = ct_get_image_by_size( array(
                        'attach_id'  => $image['id'],
                        'thumb_size' => $img_size,
                    ));
                    $thumbnail = $img['thumbnail'];
                    $social = isset($value['social']) ? $value['social'] : '';
                    $pr_title = isset($value['pr_title']) ? $value['pr_title'] : '';
                    $pr_percent = isset($value['pr_percent']) ? $value['pr_percent'] : '';
                    $item_link = isset($value['item_link']) ? $value['item_link'] : '';
                    $link_key = $widget->get_repeater_setting_key( 'title', 'value', $key );
                    if ( ! empty( $item_link['url'] ) ) {
                        $widget->add_render_attribute( $link_key, 'href', $item_link['url'] );

                        if ( $item_link['is_external'] ) {
                            $widget->add_render_attribute( $link_key, 'target', '_blank' );
                        }

                        if ( $item_link['nofollow'] ) {
                            $widget->add_render_attribute( $link_key, 'rel', 'nofollow' );
                        }
                    }
                    $link_attributes = $widget->get_render_attribute_string( $link_key );
                    ?>
                    <div class="slick-slide">
                        <div class="item--inner <?php echo esc_attr($settings['ct_animate']); ?>">
                            <div class="item--inner-team">
                                <div class="item--holder">
                                    <h3 class="item--title">    
                                        <?php echo ct_print_html($title); ?>
                                    </h3>
                                    <div class="item--position"><?php echo ct_print_html($position); ?></div>
                                    <div class="item--description"><?php echo ct_print_html($desc); ?></div>
                                    <div class="item--social">
                                        <?php if(!empty($social)):
                                            $team_social = json_decode($social, true); ?>
                                            <span class="item--social-btn"></span>
                                            <?php foreach ($team_social as $value): ?>
                                                <a href="<?php echo esc_url($value['url']); ?>"><i class="<?php echo esc_attr($value['icon']); ?>"></i></a>
                                            <?php endforeach;
                                        endif; ?>
                                    </div>
                                </div>
                                <?php if(!empty($image)) { ?>
                                    <div class="item--image">
                                        <?php echo wp_kses_post($thumbnail); ?>
                                        <?php if ( ! empty( $item_link['url'] ) ) { ?>
                                            <a <?php echo implode( ' ', [ $link_attributes ] ); ?>><span>+</span></a>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="ct-progressbar ct-progressbar1">
                                <div class="ct-progress-item">
                                    <div class="ct-progress-meta">
                                        <?php if ( ! empty( $pr_title ) ) { ?>
                                            <span class="ct-progress-title"><?php echo esc_attr($pr_title); ?></span>
                                        <?php } ?>
                                    </div>
                                    <div class="ct-progress-holder">
                                        <div class="ct-progress-bar" role="progressbar" data-valuetransitiongoal="<?php echo esc_html($pr_percent['size']); ?>" data-valuenow="<?php echo esc_html($pr_percent['size']); ?>" style="width: <?php echo esc_html($pr_percent['size']); ?>%;">
                                            <div class="ct-progress-percentage"><?php echo esc_html($pr_percent['size']); ?>%</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                       </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
