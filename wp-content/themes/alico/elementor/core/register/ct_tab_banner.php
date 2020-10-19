<?php
// Register Tabs Widget
ct_add_custom_widget(
    array(
        'name' => 'ct_tab_banner',
        'title' => esc_html__( 'Tab Banner', 'alico' ),
        'icon' => 'eicon-tabs',
        'categories' => array( Case_Theme_Core::CT_CATEGORY_NAME ),
        'scripts' => [
          'ct-tabs-widget-js',
        ],
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_tabs',
                    'label' => esc_html__( 'Tabs', 'alico' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'active_tab',
                            'label' => esc_html__( 'Active Tab', 'alico' ),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'default' => 1,
                            'separator' => 'after',
                        ),
                        array(
                            'name' => 'tabs',
                            'label' => esc_html__( 'Tabs Items', 'alico' ),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name' => 'ct_icon',
                                    'label' => esc_html__('Icon', 'alico' ),
                                    'type' => \Elementor\Controls_Manager::ICONS,
                                    'fa4compatibility' => 'icon',
                                ),
                                array(
                                    'name' => 'tab_title',
                                    'label' => esc_html__( 'Title', 'alico' ),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'default' => esc_html__( 'Tab Title', 'alico' ),
                                    'placeholder' => esc_html__( 'Tab Title', 'alico' ),
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'tab_content',
                                    'label' => esc_html__( 'Content', 'alico' ),
                                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                                    'default' => esc_html__( 'Tab Content', 'alico' ),
                                    'placeholder' => esc_html__( 'Tab Content', 'alico' ),
                                    'show_label' => false,
                                ),
                                array(
                                    'name' => 'banner',
                                    'label' => esc_html__( 'Image', 'alico' ),
                                    'type' => \Elementor\Controls_Manager::MEDIA,
                                    'description' => esc_html__('Select image.', 'alico'),
                                ),
                                array(
                                    'name' => 'box_title',
                                    'label' => esc_html__( 'Box Title', 'alico' ),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'box_subtitle',
                                    'label' => esc_html__( 'Box Sub Title', 'alico' ),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'box_content',
                                    'label' => esc_html__( 'Box Content', 'alico' ),
                                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                                    'show_label' => false,
                                ),
                                array(
                                    'name' => 'box_btn_text',
                                    'label' => esc_html__( 'Box Button Text', 'alico' ),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'box_btn_link',
                                    'label' => esc_html__('Box Button Link', 'alico' ),
                                    'type' => \Elementor\Controls_Manager::URL,
                                ),
                            ),
                            'title_field' => '{{{ tab_title }}}',
                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);