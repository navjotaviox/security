<?php

ct_add_custom_widget(
    array(
        'name' => 'ct_find_marker_form',
        'title' => esc_html__('Find Marker Form', 'alico'),
        'icon' => 'eicon-map-pin',
        'categories' => array(Case_Theme_Core::CT_CATEGORY_NAME),
        'scripts' => array(
            'jquery-ui-slider',
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'content_section',
                    'label' => esc_html__('Content', 'alico'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);