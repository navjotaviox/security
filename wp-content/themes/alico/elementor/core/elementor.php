<?php

$files = scandir(get_template_directory() . '/elementor/core/register');

foreach ($files as $file){
    $pos = strrpos($file, ".php");
    if($pos !== false){
        require_once get_template_directory() . '/elementor/core/register/' . $file;
    }
}

if(!function_exists('alico_register_custom_icon_library')){
    add_filter('elementor/icons_manager/native', 'alico_register_custom_icon_library');
    function alico_register_custom_icon_library($tabs){
        $custom_tabs = [
            'extra_icon1' => [
                'name' => 'material',
                'label' => esc_html__( 'Material Design Iconic', 'alico' ),
                'url' => get_template_directory_uri() . '/assets/css/material-design-iconic-font.min.css',
                'enqueue' => [  ],
                'prefix' => 'zmdi zmdi-',
                'displayPrefix' => 'material',
                'labelIcon' => 'zmdi zmdi-collection-text',
                'ver' => '1.0.0',
                'fetchJson' => get_template_directory_uri() . '/assets/elementor-icon/materialdesign.js',
                'native' => true,
            ],

            'extra_icon2' => [
                'name' => 'flaticon',
                'label' => esc_html__( 'Flaticon 1', 'alico' ),
                'url' => get_template_directory_uri() . '/assets/css/flaticon.css',
                'enqueue' => [  ],
                'prefix' => 'flaticon-',
                'displayPrefix' => 'flaticon',
                'labelIcon' => 'flaticon-start-button',
                'ver' => '1.0.0',
                'fetchJson' => get_template_directory_uri() . '/assets/elementor-icon/flaticon.js',
                'native' => true,
            ],

            'extra_icon3' => [
                'name' => 'flaticon-v2',
                'label' => esc_html__( 'Flaticon 2', 'alico' ),
                'url' => get_template_directory_uri() . '/assets/css/flaticon-v2.css',
                'enqueue' => [  ],
                'prefix' => 'flaticon-v2-',
                'displayPrefix' => 'flaticon-v2',
                'labelIcon' => 'flaticon-v2-nailed',
                'ver' => '1.0.0',
                'fetchJson' => get_template_directory_uri() . '/assets/elementor-icon/flaticon-v2.js',
                'native' => true,
            ],

        ];

        $tabs = array_merge($custom_tabs, $tabs);

        return $tabs;
    }
}