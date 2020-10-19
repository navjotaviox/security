<?php
ct_add_custom_widget(
    array(
        'name' => 'ct_team_member',
        'title' => esc_html__('Team Member', 'alico'),
        'icon' => 'eicon-nerd-wink',
        'categories' => array(Case_Theme_Core::CT_CATEGORY_NAME),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_Content',
                    'label' => esc_html__('Content', 'alico'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'image',
                            'label' => esc_html__( 'Image', 'alico' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                            'description' => esc_html__('Select image.', 'alico'),
                        ),
                        array(
                            'name' => 'title',
                            'label' => esc_html__('Title', 'alico' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'title_color',
                            'label' => esc_html__( 'Title Color', 'alico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .ct-team-member .ct-team-title' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'position',
                            'label' => esc_html__('Position', 'alico' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                        ),
                        array(
                            'name' => 'position_color',
                            'label' => esc_html__( 'Position Color', 'alico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .ct-team-member .ct-team-position' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'btn_text',
                            'label' => esc_html__('Button Text', 'alico' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                        ),
                        array(
                            'name' => 'btn_link',
                            'label' => esc_html__('Button Link', 'alico' ),
                            'type' => \Elementor\Controls_Manager::URL,
                        ),
                        array(
                            'name' => 'btn_style',
                            'label' => esc_html__('Button Style', 'alico' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'btn' => 'Default',
                                'btn btn-gradient' => 'Gradient',
                            ],
                            'default' => 'btn',
                        ),
                        array(
                            'name' => 'button_bg_color',
                            'label' => esc_html__( 'Button Background Color', 'alico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .ct-team-member .ct-team-button .btn-gradient' => 'background: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'button_bg_color_hover',
                            'label' => esc_html__( 'Button Background Color', 'alico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .ct-team-member .ct-team-button .btn-gradient:hover' => 'background: {{VALUE}};',
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);