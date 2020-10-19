<?php
ct_add_custom_widget(
    array(
        'name' => 'ct_cover_boxes',
        'title' => esc_html__('Cover Boxes', 'alico'),
        'icon' => 'eicon-lightbox',
        'categories' => array(Case_Theme_Core::CT_CATEGORY_NAME),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'alico'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'ct_content',
                            'label' => esc_html__('Content', 'alico'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name' => 'ct_icon',
                                    'label' => esc_html__('Icon', 'alico' ),
                                    'type' => \Elementor\Controls_Manager::ICONS,
                                    'fa4compatibility' => 'icon',
                                    'default' => [
                                        'value' => 'fas fa-star',
                                        'library' => 'fa-solid',
                                    ],
                                ),
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
                                    'placeholder' => esc_html__('Enter your title', 'alico' ),
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'description',
                                    'label' => esc_html__('Description', 'alico' ),
                                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                                    'placeholder' => esc_html__('Enter your description', 'alico' ),
                                    'rows' => 10,
                                    'show_label' => false,
                                ),
                                array(
                                    'name' => 'btn_text',
                                    'label' => esc_html__('Button Text', 'alico' ),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'btn_link',
                                    'label' => esc_html__('Button Link', 'alico' ),
                                    'type' => \Elementor\Controls_Manager::URL,
                                ),
                            ),
                            'title_field' => '{{{ title }}}',
                        ),
                        array(
                            'name' => 'active',
                            'label' => esc_html__('Active', 'alico' ),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'separator' => 'after',
                            'default' => '2',
                        ),
                        array(
                            'name' => 'ct_animate',
                            'label' => esc_html__('Case Animate', 'alico' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => alico_animate(),
                            'default' => '',
                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);