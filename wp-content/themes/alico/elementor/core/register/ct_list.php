<?php
ct_add_custom_widget(
    array(
        'name' => 'ct_list',
        'title' => esc_html__('Lists', 'alico'),
        'icon' => 'eicon-editor-list-ul',
        'categories' => array(Case_Theme_Core::CT_CATEGORY_NAME),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_list',
                    'label' => esc_html__('Content', 'alico'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'style',
                            'label' => esc_html__('Layout', 'alico' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'style1' => 'Dot',
                                'style2' => 'Arrow',
                                'style3' => 'Check',
                            ],
                            'default' => 'style1',
                        ),
                        array(
                            'name' => 'list',
                            'label' => esc_html__('List', 'alico'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name' => 'list_content',
                                    'label' => esc_html__('Content', 'alico'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                            ),
                            'title_field' => '{{{ list_content }}}',
                        ),
                        array(
                            'name' => 'ct_animate',
                            'label' => esc_html__('Case Animate', 'alico' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => alico_animate(),
                        ),
                    ),
                ),
                array(
                    'name' => 'style_section',
                    'label' => esc_html__('Style', 'alico' ),
                    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => array(
                        array(
                            'name' => 'content_color',
                            'label' => esc_html__('Content Color', 'alico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .ct-list .ct-list-item .ct-list-desc' => 'color: {{VALUE}};',
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);