<?php

class CT_FancyBox extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
            'ct_wg_fancybox',
            esc_html__('* Fancy Box', 'alico'),
            array('description' => esc_html__('Fancy Box Widget', 'alico'),)
        );
    }

    function widget($args, $instance)
    {

        extract($args);

        $title = isset($instance['title']) ? (!empty($instance['title']) ? $instance['title'] : '') : '';
        $sub_title = isset($instance['sub_title']) ? (!empty($instance['sub_title']) ? $instance['sub_title'] : '') : '';
        $btn_text = isset($instance['btn_text']) ? (!empty($instance['btn_text']) ? $instance['btn_text'] : '') : '';
        $btn_link = isset($instance['btn_link']) ? (!empty($instance['btn_link']) ? $instance['btn_link'] : '') : '';
        $background_img_id = isset($instance['background_img']) ? (!empty($instance['background_img']) ? $instance['background_img'] : '') : '';
        $background_img_url = wp_get_attachment_image_url($background_img_id, '');
        $icon_img_id = isset($instance['icon_img']) ? (!empty($instance['icon_img']) ? $instance['icon_img'] : '') : '';
        $icon_img_url = wp_get_attachment_image_url($icon_img_id);
        ?>
        <div class="ct-wg-fancybox widget">
            <div class="ct-wg-fancybox-inner bg-image" style="background-image: url('<?php echo esc_url($background_img_url)?>');">
                <?php if (!empty($icon_img_url)): ?>
                    <div class="wg-fancybox-icon">
                        <img src="<?php echo esc_url($icon_img_url);?>" alt="<?php echo esc_attr( get_post_meta( $icon_img_id, '_wp_attachment_image_alt', true ) ) ?>">
                    </div>
                <?php endif; ?>

                <?php if (!empty($sub_title)): ?>
                    <h4 class="wg-fancybox-subtitle">
                        <?php echo wp_kses_post($sub_title); ?>
                    </h4>
                <?php endif; ?>

                <?php if (!empty($title)) : ?>
                    <h3 class="wg-fancybox-title"><?php echo esc_html($title); ?></h3>
                <?php endif; ?>

                <?php if (!empty($btn_text)) : ?>
                    <div class="wg-fancybox-button">
                        <a href="<?php echo esc_url($btn_link); ?>" target="_blank"><?php echo esc_attr($btn_text); ?><i class="fa fa-link"></i></a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['sub_title'] = strip_tags($new_instance['sub_title']);
        $instance['btn_text'] = strip_tags($new_instance['btn_text']);
        $instance['btn_link'] = strip_tags($new_instance['btn_link']);
        $instance['background_img'] = strip_tags($new_instance['background_img']);
        $instance['icon_img'] = strip_tags($new_instance['icon_img']);
        return $instance;
    }

    function form($instance)
    {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $sub_title = isset($instance['sub_title']) ? esc_attr($instance['sub_title']) : '';
        $btn_text = isset($instance['btn_text']) ? esc_attr($instance['btn_text']) : '';
        $btn_link = isset($instance['btn_link']) ? esc_attr($instance['btn_link']) : '';
        $background_img = isset($instance['background_img']) ? esc_attr($instance['background_img']) : '';
        $icon_img = isset($instance['icon_img']) ? esc_attr($instance['icon_img']) : '';
        ?>

        <div class="ct-wg-image-wrap">
            <label for="<?php echo esc_url($this->get_field_id('background_img')); ?>"><?php esc_html_e('Background Image', 'alico'); ?></label>
            <input type="hidden" class="widefat hide-image-url"
                   id="<?php echo esc_attr($this->get_field_id('background_img')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('background_img')); ?>"
                   value="<?php echo esc_attr($background_img) ?>"/>
            <div class="ct-wg-show-image">
                <?php
                if ($background_img != "") {
                    ?>
                    <img src="<?php echo wp_get_attachment_image_url($background_img) ?>">
                    <?php
                }
                ?>
            </div>
            <?php
            if ($background_img != "") {
                ?>
                <a href="#" class="ct-wg-select-image button" style="display: none;"><?php esc_html_e('Select Image', 'alico'); ?></a>
                <a href="#" class="ct-wg-remove-image button"><?php esc_html_e('Remove Image', 'alico'); ?></a>
                <?php
            } else {
                ?>
                <a href="#" class="ct-wg-select-image button"><?php esc_html_e('Select Image', 'alico'); ?></a>
                <a href="#" class="ct-wg-remove-image button" style="display: none;"><?php esc_html_e('Remove Image', 'alico'); ?></a>
                <?php
            }
            ?>
        </div>

        <div class="ct-wg-image-wrap">
            <label for="<?php echo esc_url($this->get_field_id('icon_img')); ?>"><?php esc_html_e('Icon Image', 'alico'); ?></label>
            <input type="hidden" class="widefat hide-image-url"
                   id="<?php echo esc_attr($this->get_field_id('icon_img')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('icon_img')); ?>"
                   value="<?php echo esc_attr($icon_img) ?>"/>
            <div class="ct-wg-show-image">
                <?php
                if ($icon_img != "") {
                    ?>
                    <img src="<?php echo wp_get_attachment_image_url($icon_img) ?>">
                    <?php
                }
                ?>
            </div>
            <?php
            if ($icon_img != "") {
                ?>
                <a href="#" class="ct-wg-select-image button" style="display: none;"><?php esc_html_e('Select Image', 'alico'); ?></a>
                <a href="#" class="ct-wg-remove-image button"><?php esc_html_e('Remove Image', 'alico'); ?></a>
                <?php
            } else {
                ?>
                <a href="#" class="ct-wg-select-image button"><?php esc_html_e('Select Image', 'alico'); ?></a>
                <a href="#" class="ct-wg-remove-image button" style="display: none;"><?php esc_html_e('Remove Image', 'alico'); ?></a>
                <?php
            }
            ?>
        </div>
        
        <p>
            <label for="<?php echo esc_url($this->get_field_id('title')); ?>"><?php esc_html_e('Title', 'alico'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text"
                   value="<?php echo esc_attr($title); ?>"/></p>

        <p>
            <label for="<?php echo esc_url($this->get_field_id('sub_title')); ?>"><?php esc_html_e('Sub Title', 'alico'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('sub_title')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('sub_title')); ?>" type="text"
                   value="<?php echo esc_attr($sub_title); ?>"/></p>

        <p>
            <label for="<?php echo esc_url($this->get_field_id('btn_text')); ?>"><?php esc_html_e('Button Text', 'alico'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('btn_text')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('btn_text')); ?>" type="text"
                   value="<?php echo esc_attr($btn_text); ?>"/></p>

        <p>
            <label for="<?php echo esc_url($this->get_field_id('btn_link')); ?>"><?php esc_html_e('Button Link', 'alico'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('btn_link')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('btn_link')); ?>" type="text"
                   value="<?php echo esc_attr($btn_link); ?>"/></p>
        <?php
    }

}
function register_fancybox_widget() {
    if(function_exists('ct_allow_RegisterWidget')){
        ct_allow_RegisterWidget( 'CT_FancyBox' );
    }
}
add_action('widgets_init', 'register_fancybox_widget');

?>