<?php
ct_add_custom_widget(
    array(
        'name' => 'ct_banner',
        'title' => esc_html__('Banner', 'alico'),
        'icon' => 'eicon-posts-ticker',
        'categories' => array(Case_Theme_Core::CT_CATEGORY_NAME),
        'scripts' => array(
            'jquery-numerator',
            'ct-counter-widget-js',
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'alico'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'el_layout',
                            'label' => esc_html__('Icon Type', 'alico' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                '1' => 'Layout 1',
                                '2' => 'Layout 2',
                            ],
                            'default' => '1',
                        ),
                        array(
                            'name' => 'banner_image',
                            'label' => esc_html__('Banner Image', 'alico' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                        ),
                        array(
                            'name' => 'layer_image1',
                            'label' => esc_html__('Layer Image 1', 'alico' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                            'condition' => [
                                'el_layout' => '2',
                            ],
                        ),
                        array(
                            'name' => 'layer_image2',
                            'label' => esc_html__('Layer Image 2', 'alico' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                            'condition' => [
                                'el_layout' => '2',
                            ],
                        ),
                        array(
                            'name' => 'banner_title',
                            'label' => esc_html__('Banner Title', 'alico'),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'condition' => [
                                'el_layout' => '1',
                            ],
                        ),
                        array(
                            'name' => 'banner_number',
                            'label' => esc_html__('Banner Number', 'alico'),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'condition' => [
                                'el_layout' => '1',
                            ],
                        ),
                        array(
                            'name' => 'ct_icon',
                            'label' => esc_html__('Counter Icon', 'alico' ),
                            'type' => \Elementor\Controls_Manager::ICONS,
                            'fa4compatibility' => 'icon',
                            'default' => [
                                'value' => 'fas fa-star',
                                'library' => 'fa-solid',
                            ],
                        ),
                        array(
                            'name' => 'counter_title',
                            'label' => esc_html__('Counter Title', 'alico'),
                            'type' => \Elementor\Controls_Manager::TEXT,
                        ),
                        array(
                            'name' => 'counter_number',
                            'label' => esc_html__('Counter Number', 'alico'),
                            'type' => \Elementor\Controls_Manager::TEXT,
                        ),
                        array(
                            'name' => 'counter_number_suffix',
                            'label' => esc_html__('Counter Number Suffix', 'alico'),
                            'type' => \Elementor\Controls_Manager::TEXT,
                        ),
                        array(
                            'name' => 'counter_bg_color',
                            'label' => esc_html__('Counter Box Color', 'alico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .ct-banner .ct-banner-counter' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'counter_title_color',
                            'label' => esc_html__('Counter Title Color', 'alico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .ct-banner .ct-banner-counter .item-title' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'counter_number_color',
                            'label' => esc_html__('Counter Number Color', 'alico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .ct-banner .ct-banner-counter .ct-counter-number' => 'color: {{VALUE}};',
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);