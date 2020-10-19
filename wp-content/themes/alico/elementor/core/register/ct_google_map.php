<?php

// Register Google Maps Widget
ct_add_custom_widget(
    array(
        'name' => 'ct_google_map',
        'title' => esc_html__( 'Google Maps', 'alico' ),
        'icon' => 'eicon-google-maps',
        'categories' => array( Case_Theme_Core::CT_CATEGORY_NAME ),
        'scripts' => array(
            'maps-googleapis',
            'custom-gm-widget-js',
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'source_section',
                    'label' => esc_html__( 'Source Settings', 'alico' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'address',
                            'label' => esc_html__( 'Address', 'alico' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => 'New York, United States',
                        ),
                        array(
                            'name' => 'coordinate',
                            'label' => esc_html__( 'Coordinate', 'alico' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => '40.6976684,-74.2605501',
                        ),
                        array(
                            'name' => 'infoclick',
                            'label' => esc_html__( 'Click Show Info Window', 'alico' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                        ),
                        array(
                            'name' => 'markercoordinate',
                            'label' => esc_html__( 'Marker Coordinate', 'alico' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'description' => esc_html__('Enter marker coordinate of Map, format input (latitude, longitude)', 'alico'),
                            'default' => '40.6976684,-74.2605501',
                        ),
                        array(
                            'name' => 'markericon',
                            'label' => esc_html__( 'Marker Icon', 'alico' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                            'description' => esc_html__('Select image icon for marker', 'alico')
                        ),
                        array(
                            'name' => 'infowidth',
                            'label' => esc_html__( 'Info Window Max Width', 'alico' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'description' => esc_html__('Set max width for info window', 'alico')
                        ),
                        array(
                            'name' => 'type',
                            'label' => esc_html__( 'Map Type', 'alico' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'ROADMAP' => 'ROADMAP',
                                'HYBRID' => 'HYBRID',
                                'SATELLITE' => 'SATELLITE',
                                'TERRAIN' => 'TERRAIN'
                            ],
                            'default' => 'ROADMAP',
                            'description' => esc_html__('Select the map type.', 'alico')
                        ),
                        array(
                            'name' => 'style',
                            'label' => esc_html__( 'Style Template', 'alico' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                '' => 'Google Default',
                                'light-monochrome' => 'Light Monochrome',
                                'blue-water' => 'Blue water',
                                'midnight-commander' => 'Midnight Commander',
                                'paper' => 'Paper',
                                'red-hues' => 'Red Hues',
                                'hot-pink' => 'Hot Pink',
                                'custom' => 'Custom',
                            ],
                            'default' => '',
                            'description' => esc_html__('Select the map template.', 'alico')
                        ),
                        array(
                            'name' => 'content',
                            'label' => esc_html__( 'Custom Template', 'alico' ),
                            'type' => \Elementor\Controls_Manager::CODE,
                            'language' => 'json',
                            'description' => esc_html__('Get template from snazzymaps.com', 'alico'),
                            'condition' => [
                                'style' => 'custom',
                            ],
                        ),
                        array(
                            'name' => 'zoom',
                            'label' => esc_html__( 'Zoom', 'alico' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => 13,
                            'description' => esc_html__('Set max width for info window', 'alico')
                        ),
                        array(
                            'name' => 'width',
                            'label' => esc_html__( 'Width', 'alico' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => 'auto',
                            'description' => esc_html__('Width of map without pixel, default is auto', 'alico')
                        ),
                        array(
                            'name' => 'height',
                            'label' => esc_html__( 'Height', 'alico' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => '350px',
                            'description' => esc_html__('Height of map without pixel, default is 350px', 'alico')
                        ),
                        array(
                            'name' => 'scrollwheel',
                            'label' => esc_html__( 'Scroll Wheel', 'alico' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'description' => esc_html__('Height of map without pixel, default is 350px', 'alico')
                        ),
                        array(
                            'name' => 'pancontrol',
                            'label' => esc_html__( 'Pan Control', 'alico' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'description' => esc_html__('Height of map without pixel, default is 350px', 'alico')
                        ),
                        array(
                            'name' => 'zoomcontrol',
                            'label' => esc_html__( 'Zoom Control', 'alico' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'description' => esc_html__('Height of map without pixel, default is 350px', 'alico')
                        ),
                        array(
                            'name' => 'scalecontrol',
                            'label' => esc_html__( 'Scale Control', 'alico' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'description' => esc_html__('Height of map without pixel, default is 350px', 'alico')
                        ),
                        array(
                            'name' => 'maptypecontrol',
                            'label' => esc_html__( 'Map Type Control', 'alico' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'description' => esc_html__('Height of map without pixel, default is 350px', 'alico')
                        ),
                        array(
                            'name' => 'streetviewcontrol',
                            'label' => esc_html__( 'Street View Control', 'alico' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'description' => esc_html__('Height of map without pixel, default is 350px', 'alico')
                        ),
                        array(
                            'name' => 'overviewmapcontrol',
                            'label' => esc_html__( 'Over View Map Control', 'alico' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'description' => esc_html__('Height of map without pixel, default is 350px', 'alico')
                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);