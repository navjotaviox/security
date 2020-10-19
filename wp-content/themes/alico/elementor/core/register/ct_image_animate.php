<?php
// Register Video Player Widget
ct_add_custom_widget(
    array(
        'name' => 'ct_image_animate',
        'title' => esc_html__('Image Animate', 'alico' ),
        'icon' => 'eicon-barcode',
        'categories' => array( Case_Theme_Core::CT_CATEGORY_NAME ),
        'scripts' => array(

        ),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'content_section',
                    'label' => esc_html__('Source Settings', 'alico'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'content_list',
                            'label' => esc_html__('Images', 'alico'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'default' => [],
                            'controls' => array(
                                array(
                                    'name' => 'image',
                                    'label' => esc_html__( 'Image', 'alico' ),
                                    'type' => \Elementor\Controls_Manager::MEDIA,
                                ),
                                array(
                                    'name' => 'image_animate',
                                    'label' => esc_html__('Animate', 'alico' ),
                                    'type' => \Elementor\Controls_Manager::SELECT,
                                    'options' => [
                                        'shape-animate1' => 'Animate 1',
                                        'shape-animate2' => 'Animate 2',
                                        'shape-animate3' => 'Animate 3',
                                        'shape-animate4' => 'Animate 4',
                                        'wow bounceInLeft' => 'Bounce In Left',
                                        'wow bounceInRight' => 'Bounce In Right',
                                        'animate-none' => 'None',
                                    ],
                                    'default' => 'shape-animate1',
                                ),
                                array(
                                    'name' => 'top_positioon',
                                    'label' => esc_html__('Top Position (%)', 'alico' ),
                                    'type' => \Elementor\Controls_Manager::SLIDER,
                                    'size_units' => [ '%' ],
                                    'default' => [
                                        'size' => 0,
                                    ],
                                    'range' => [
                                        '%' => [
                                            'min' => 0,
                                            'max' => 100,
                                        ],
                                    ],
                                ),
                                array(
                                    'name' => 'right_positioon',
                                    'label' => esc_html__('Right Position (%)', 'alico' ),
                                    'type' => \Elementor\Controls_Manager::SLIDER,
                                    'size_units' => [ '%' ],
                                    'default' => [
                                        'size' => 0,
                                    ],
                                    'range' => [
                                        '%' => [
                                            'min' => 0,
                                            'max' => 100,
                                        ],
                                    ],
                                ),
                                array(
                                    'name' => 'bottom_positioon',
                                    'label' => esc_html__('Bottom Position (%)', 'alico' ),
                                    'type' => \Elementor\Controls_Manager::SLIDER,
                                    'size_units' => [ '%' ],
                                    'default' => [
                                        'size' => 0,
                                    ],
                                    'range' => [
                                        '%' => [
                                            'min' => 0,
                                            'max' => 100,
                                        ],
                                    ],
                                ),
                                array(
                                    'name' => 'left_positioon',
                                    'label' => esc_html__('Left Position (%)', 'alico' ),
                                    'type' => \Elementor\Controls_Manager::SLIDER,
                                    'size_units' => [ '%' ],
                                    'default' => [
                                        'size' => 0,
                                    ],
                                    'range' => [
                                        '%' => [
                                            'min' => 0,
                                            'max' => 100,
                                        ],
                                    ],
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);