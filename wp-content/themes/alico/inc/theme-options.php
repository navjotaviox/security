<?php
if (!class_exists('ReduxFramework')) {
    return;
}
if (class_exists('ReduxFrameworkPlugin')) {
    remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
}

if(class_exists('Newsletter')) {
    $forms = array_filter( (array) get_option( 'newsletter_forms', array() ) );

    $newsletter_forms = array(
        'default' => esc_html__( 'Default Form', 'alico' )
    );

    if ( $forms )
    {
        $index = 1;
        foreach ( $forms as $key => $form )
        {
            $newsletter_forms[ $key ] = sprintf( esc_html__( 'Form %s', 'alico' ), $index );
            $index ++;
        }
    }
} else {
    $newsletter_forms = '';
}

$opt_name = alico_get_opt_name();
$theme = wp_get_theme();

$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name'             => $opt_name,
    // This is where your data is stored in the database and also becomes your global variable name.
    'display_name'         => $theme->get('Name'),
    // Name that appears at the top of your panel
    'display_version'      => $theme->get('Version'),
    // Version that appears at the top of your panel
    'menu_type'            => class_exists('Case_Theme_Core') ? 'submenu' : '',
    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu'       => true,
    // Show the sections below the admin menu item or not
    'menu_title'           => esc_html__('Theme Options', 'alico'),
    'page_title'           => esc_html__('Theme Options', 'alico'),
    // You will need to generate a Google API key to use this feature.
    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
    'google_api_key'       => '',
    // Set it you want google fonts to update weekly. A google_api_key value is required.
    'google_update_weekly' => false,
    // Must be defined to add google fonts to the typography module
    'async_typography'     => false,
    // Use a asynchronous font on the front end or font string
    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
    'admin_bar'            => true,
    // Show the panel pages on the admin bar
    'admin_bar_icon'       => 'dashicons-admin-generic',
    // Choose an icon for the admin bar menu
    'admin_bar_priority'   => 50,
    // Choose an priority for the admin bar menu
    'global_variable'      => '',
    // Set a different name for your global variable other than the opt_name
    'dev_mode'             => true,
    // Show the time the page took to load, etc
    'update_notice'        => true,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer'           => true,
    // Enable basic customizer support
    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
    //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field
    'show_options_object' => false,
    // OPTIONAL -> Give you extra features
    'page_priority'        => null,
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent'          => class_exists('Case_Theme_Core') ? $theme->get('TextDomain') : '',
    // For a full list of options, visit: //codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions'     => 'manage_options',
    // Permissions needed to access the options panel.
    'menu_icon'            => '',
    // Specify a custom URL to an icon
    'last_tab'             => '',
    // Force your panel to always open to a specific tab (by id)
    'page_icon'            => 'icon-themes',
    // Icon displayed in the admin panel next to your menu_title
    'page_slug'            => 'theme-options',
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults'        => true,
    // On load save the defaults to DB before user clicks save or not
    'default_show'         => false,
    // If true, shows the default value next to each field that is not the default value.
    'default_mark'         => '',
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export'   => true,
    // Shows the Import/Export panel when not used as a field.

    // CAREFUL -> These options are for advanced use only
    'transient_time'       => 60 * MINUTE_IN_SECONDS,
    'output'               => true,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag'           => true,
    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database'             => '',
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn'              => true,
    // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

    // HINTS
    'hints'                => array(
        'icon'          => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color'    => 'lightgray',
        'icon_size'     => 'normal',
        'tip_style'     => array(
            'color'   => 'red',
            'shadow'  => true,
            'rounded' => false,
            'style'   => '',
        ),
        'tip_position'  => array(
            'my' => 'top left',
            'at' => 'bottom right',
        ),
        'tip_effect'    => array(
            'show' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'mouseover',
            ),
            'hide' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'click mouseleave',
            ),
        ),
    ),
    'templates_path'       => get_template_directory() . '/inc/templates/redux/'
);

Redux::SetArgs($opt_name, $args);

/*--------------------------------------------------------------
# General
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title'  => esc_html__('General', 'alico'),
    'icon'   => 'el-icon-home',
    'fields' => array(
        array(
            'id'       => 'favicon',
            'type'     => 'media',
            'title'    => esc_html__('Favicon', 'alico'),
            'default' => ''
        ),
        array(
            'id'       => 'dev_mode',
            'type'     => 'switch',
            'title'    => esc_html__('Dev Mode (not recommended)', 'alico'),
            'description' => 'no minimize , generate css over time...',
            'default'  => false
        ),
        array(
            'id'       => 'show_page_loading',
            'type'     => 'switch',
            'title'    => esc_html__('Enable Page Loading', 'alico'),
            'subtitle' => esc_html__('Enable page loading effect when you load site.', 'alico'),
            'default'  => false
        ),
        array(
            'id'       => 'loading_type',
            'type'     => 'select',
            'title'    => esc_html__('Loading Style', 'alico'),
            'options'  => array(
                'style1'  => esc_html__('Style 1', 'alico'),
                'style2'  => esc_html__('Style 2', 'alico'),
                'style3'  => esc_html__('Style 3', 'alico'),
                'style4'  => esc_html__('Style 4', 'alico'),
                'style5'  => esc_html__('Style 5', 'alico'),
                'style6'  => esc_html__('Style 6', 'alico'),
                'style7'  => esc_html__('Style 7', 'alico'),
                'style8'  => esc_html__('Style 8', 'alico'),
                'style9'  => esc_html__('Style 9', 'alico'),
                'style10'  => esc_html__('Style 10', 'alico'),
                'style11'  => esc_html__('Style 11', 'alico'),
                'style12'  => esc_html__('Style 12', 'alico'),
            ),
            'default'  => 'style1',
            'required' => array( 0 => 'show_page_loading', 1 => 'equals', 2 => '1' ),
            'force_output' => true
        ),
    )
));

/*--------------------------------------------------------------
# Header
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title'  => esc_html__('Header', 'alico'),
    'icon'   => 'el el-indent-left',
    'fields' => array(
        array(
            'id'       => 'header_layout',
            'type'     => 'image_select',
            'title'    => esc_html__('Layout', 'alico'),
            'subtitle' => esc_html__('Select a layout for header.', 'alico'),
            'options'  => array(
                '1' => get_template_directory_uri() . '/assets/images/header-layout/h1.jpg',
                '2' => get_template_directory_uri() . '/assets/images/header-layout/h2.jpg',
                '3' => get_template_directory_uri() . '/assets/images/header-layout/h3.jpg',
                '4' => get_template_directory_uri() . '/assets/images/header-layout/h4.jpg',
                '5' => get_template_directory_uri() . '/assets/images/header-layout/h5.jpg',
                '6' => get_template_directory_uri() . '/assets/images/header-layout/h6.jpg',
            ),
            'default'  => '1'
        ),
        array(
            'id'       => 'sticky_on',
            'type'     => 'switch',
            'title'    => esc_html__('Sticky Header', 'alico'),
            'subtitle' => esc_html__('Header will be sticked when applicable.', 'alico'),
            'default'  => false
        ),
        array(
            'id'       => 'sticky_scroll',
            'type'     => 'button_set',
            'title'    => esc_html__('Sticky Scroll', 'alico'),
            'options'  => array(
                'scroll-to-top' => esc_html__('Scroll To Top', 'alico'),
                'scroll-to-bottom'  => esc_html__('Scroll To Bottom', 'alico'),
            ),
            'default'  => 'scroll-to-bottom',
            'required' => array( 0 => 'sticky_on', 1 => 'equals', 2 => '1' ),
            'force_output' => true
        ),
        array(
            'id'       => 'hidden_sidebar_icon',
            'type'     => 'switch',
            'title'    => esc_html__('Hidden Sidebar Icon', 'alico'),
            'default'  => false,
            'desc'     => esc_html__('Apply header layout 3.', 'alico'),
        ),
        array(
            'id'       => 'h_search_form',
            'type'     => 'switch',
            'title'    => esc_html__('Search Form', 'alico'),
            'default'  => false,
            'desc'     => esc_html__('Apply header layout 4.', 'alico'),
        ),
        array(
            'title' => esc_html__('Social', 'alico'),
            'type'  => 'section',
            'id' => 'header_social',
            'indent' => true,
            'subtitle'     => esc_html__('Apply header layout 4.', 'alico'),
        ),

        array(
            'id'      => 'h_social_facebook_url',
            'type'    => 'text',
            'title'   => esc_html__('Facebook URL', 'alico'),
            'default' => '',
        ),
        array(
            'id'      => 'h_social_twitter_url',
            'type'    => 'text',
            'title'   => esc_html__('Twitter URL', 'alico'),
            'default' => '#',
        ),
        array(
            'id'      => 'h_social_inkedin_url',
            'type'    => 'text',
            'title'   => esc_html__('Linkedin URL', 'alico'),
            'default' => '',
        ),
        array(
            'id'      => 'h_social_instagram_url',
            'type'    => 'text',
            'title'   => esc_html__('Instagram URL', 'alico'),
            'default' => '#',
        ),
        array(
            'id'      => 'h_social_google_url',
            'type'    => 'text',
            'title'   => esc_html__('Google URL', 'alico'),
            'default' => '',
        ),
        array(
            'id'      => 'h_social_skype_url',
            'type'    => 'text',
            'title'   => esc_html__('Skype URL', 'alico'),
            'default' => '',
        ),
        array(
            'id'      => 'h_social_pinterest_url',
            'type'    => 'text',
            'title'   => esc_html__('Pinterest URL', 'alico'),
            'default' => '',
        ),
        array(
            'id'      => 'h_social_vimeo_url',
            'type'    => 'text',
            'title'   => esc_html__('Vimeo URL', 'alico'),
            'default' => '',
        ),
        array(
            'id'      => 'h_social_youtube_url',
            'type'    => 'text',
            'title'   => esc_html__('Youtube URL', 'alico'),
            'default' => '',
        ),
        array(
            'id'      => 'h_social_yelp_url',
            'type'    => 'text',
            'title'   => esc_html__('Yelp URL', 'alico'),
            'default' => '',
        ),
        array(
            'id'      => 'h_social_tumblr_url',
            'type'    => 'text',
            'title'   => esc_html__('Tumblr URL', 'alico'),
            'default' => '',
        ),
        array(
            'id'      => 'h_social_tripadvisor_url',
            'type'    => 'text',
            'title'   => esc_html__('Tripadvisor URL', 'alico'),
            'default' => '#',
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => esc_html__('Top Bar', 'alico'),
    'icon'       => 'el el-credit-card',
    'subsection' => true,
    'fields'     => array(
        array(
            'id' => 'wellcome',
            'type' => 'text',
            'title' => esc_html__('Short Description', 'alico'),
            'default' => '',
        ),
        array(
            'id' => 'h_info',
            'type' => 'text',
            'title' => esc_html__('Info', 'alico'),
            'default' => '',
            'desc'           => esc_html__('Apply header layout 1.', 'alico'),
        ),
        array(
            'id' => 'h_phone_label',
            'type' => 'text',
            'title' => esc_html__('Phone Number Label', 'alico'),
            'default' => '',
        ),
        array(
            'id' => 'h_phone',
            'type' => 'text',
            'title' => esc_html__('Phone Number', 'alico'),
            'default' => '',
        ),
        array(
            'id' => 'h_phone_link',
            'type' => 'text',
            'title' => esc_html__('Phone Link', 'alico'),
            'default' => '',
        ),
        array(
            'id' => 'h_email_label',
            'type' => 'text',
            'title' => esc_html__('Email Label', 'alico'),
            'default' => '',
        ),
        array(
            'id' => 'h_email',
            'type' => 'text',
            'title' => esc_html__('Email', 'alico'),
            'default' => '',
        ),
        array(
            'id' => 'h_email_link',
            'type' => 'text',
            'title' => esc_html__('Email Link', 'alico'),
            'default' => '',
        ),
        array(
            'id' => 'h_address_label',
            'type' => 'text',
            'title' => esc_html__('Address Label', 'alico'),
            'default' => '',
        ),
        array(
            'id' => 'h_address',
            'type' => 'text',
            'title' => esc_html__('Address', 'alico'),
            'default' => '',
        ),
        array(
            'id' => 'h_address_link',
            'type' => 'text',
            'title' => esc_html__('Address Link', 'alico'),
            'default' => '',
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => esc_html__('Logo', 'alico'),
    'icon'       => 'el el-picture',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'logo',
            'type'     => 'media',
            'title'    => esc_html__('Logo Dark', 'alico'),
             'default' => array(
                'url'=>get_template_directory_uri().'/assets/images/logo-dark.png'
            )
        ),
        array(
            'id'       => 'logo_mobile',
            'type'     => 'media',
            'title'    => esc_html__('Logo Tablet & Mobile', 'alico'),
             'default' => array(
                'url'=>get_template_directory_uri().'/assets/images/logo-dark.png'
            )
        ),
        array(
            'id'       => 'logo_maxh',
            'type'     => 'dimensions',
            'title'    => esc_html__('Logo Max Height', 'alico'),
            'subtitle' => esc_html__('Enter number.', 'alico'),
            'width'    => false,
            'unit'     => 'px'
        ),
        array(
            'id'       => 'logo_maxh_sm',
            'type'     => 'dimensions',
            'title'    => esc_html__('Logo Max Height for Tablet & Mobile', 'alico'),
            'subtitle' => esc_html__('Enter number.', 'alico'),
            'width'    => false,
            'unit'     => 'px'
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => esc_html__('Navigation', 'alico'),
    'icon'       => 'el el-lines',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'          => 'font_menu',
            'type'        => 'typography',
            'title'       => esc_html__('Custom Google Font', 'alico'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'font-style'  => false,
            'font-weight'  => true,
            'text-align'  => false,
            'font-size'  => false,
            'line-height'  => false,
            'color'  => false,
            'output'      => array('.ct-main-menu > li > a, body .ct-main-menu .sub-menu li a'),
            'units'       => 'px',
        ),
        array(
            'title' => esc_html__('Main Menu', 'alico'),
            'type'  => 'section',
            'id' => 'main_menu',
            'indent' => true
        ),
        array(
            'id'      => 'main_menu_color',
            'type'    => 'link_color',
            'title'   => esc_html__('Item Color', 'alico'),
            'default' => array(
                'regular' => '',
                'hover'   => '',
                'active'   => '',
            ),
        ),
        array(
            'id'          => 'menu_icon_color',
            'type'        => 'color',
            'title'       => esc_html__('Icon Color', 'alico'),
            'transparent' => false,
        ),
        array(
            'title' => esc_html__('Sticky Menu', 'alico'),
            'type'  => 'section',
            'id' => 'sticky_menu',
            'indent' => true
        ),
        array(
            'id'      => 'sticky_menu_color',
            'type'    => 'link_color',
            'title'   => esc_html__('Item Color', 'alico'),
            'default' => array(
                'regular' => '',
                'hover'   => '',
                'active'   => '',
            ),
        ),
        array(
            'title' => esc_html__('Sub Menu', 'alico'),
            'type'  => 'section',
            'id' => 'sub_menu',
            'indent' => true
        ),
        array(
            'id'      => 'sub_menu_color',
            'type'    => 'link_color',
            'title'   => esc_html__('Item Color', 'alico'),
            'default' => array(
                'regular' => '',
                'hover'   => '',
                'active'   => '',
            ),
        ),
        array(
            'title' => esc_html__('Button Navigation One', 'alico'),
            'type'  => 'section',
            'id' => 'button_navigation',
            'indent' => true
        ),
        array(
            'id'       => 'h_btn_on',
            'type'     => 'button_set',
            'title'    => esc_html__('Show/Hide Button', 'alico'),
            'options'  => array(
                'show'  => esc_html__('Show', 'alico'),
                'hide'  => esc_html__('Hide', 'alico')
            ),
            'default'  => 'hide',
        ),
        array(
            'id' => 'h_btn_text',
            'type' => 'text',
            'title' => esc_html__('Button Text', 'alico'),
            'default' => '',
            'required' => array( 0 => 'h_btn_on', 1 => 'equals', 2 => 'show' ),
            'force_output' => true
        ),
        array(
            'id'       => 'h_btn_link_type',
            'type'     => 'button_set',
            'title'    => esc_html__('Button Link Type', 'alico'),
            'options'  => array(
                'page'  => esc_html__('Page', 'alico'),
                'custom'  => esc_html__('Custom', 'alico')
            ),
            'default'  => 'page',
            'required' => array( 0 => 'h_btn_on', 1 => 'equals', 2 => 'show' ),
            'force_output' => true
        ),
        array(
            'id'    => 'h_btn_link',
            'type'  => 'select',
            'title' => esc_html__( 'Page Link', 'alico' ), 
            'data'  => 'page',
            'args'  => array(
                'post_type'      => 'page',
                'posts_per_page' => -1,
                'orderby'        => 'title',
                'order'          => 'ASC',
            ),
            'required' => array( 0 => 'h_btn_link_type', 1 => 'equals', 2 => 'page' ),
            'force_output' => true
        ),
        array(
            'id' => 'h_btn_link_custom',
            'type' => 'text',
            'title' => esc_html__('Custom Link', 'alico'),
            'default' => '',
            'required' => array( 0 => 'h_btn_link_type', 1 => 'equals', 2 => 'custom' ),
            'force_output' => true
        ),
        array(
            'id'       => 'h_btn_target',
            'type'     => 'button_set',
            'title'    => esc_html__('Button Target', 'alico'),
            'options'  => array(
                '_self'  => esc_html__('Self', 'alico'),
                '_blank'  => esc_html__('Blank', 'alico')
            ),
            'default'  => '_self',
            'required' => array( 0 => 'h_btn_on', 1 => 'equals', 2 => 'show' ),
            'force_output' => true
        ),
        array(
            'id'       => 'h_btn_icon',
            'type'     => 'ct_iconpicker',
            'title'    => esc_html__('Icon', 'alico'),
            'required' => array( 0 => 'h_btn_on', 1 => 'equals', 2 => 'show' ),
            'force_output' => true
        ),

        array(
            'title' => esc_html__('Button Navigation Two', 'alico'),
            'type'  => 'section',
            'id' => 'button_navigation2',
            'indent' => true,
            'desc'  => esc_html__('Apply header layout 2.', 'alico'),
        ),
        array(
            'id'       => 'h_btn_on2',
            'type'     => 'button_set',
            'title'    => esc_html__('Show/Hide Button', 'alico'),
            'options'  => array(
                'show'  => esc_html__('Show', 'alico'),
                'hide'  => esc_html__('Hide', 'alico')
            ),
            'default'  => 'hide',
        ),
        array(
            'id' => 'h_btn_text2',
            'type' => 'text',
            'title' => esc_html__('Button Text', 'alico'),
            'default' => '',
            'required' => array( 0 => 'h_btn_on2', 1 => 'equals', 2 => 'show' ),
            'force_output' => true
        ),
        array(
            'id'       => 'h_btn_link_type2',
            'type'     => 'button_set',
            'title'    => esc_html__('Button Link Type', 'alico'),
            'options'  => array(
                'page'  => esc_html__('Page', 'alico'),
                'custom'  => esc_html__('Custom', 'alico')
            ),
            'default'  => 'page',
            'required' => array( 0 => 'h_btn_on2', 1 => 'equals', 2 => 'show' ),
            'force_output' => true
        ),
        array(
            'id'    => 'h_btn_link2',
            'type'  => 'select',
            'title' => esc_html__( 'Page Link', 'alico' ), 
            'data'  => 'page',
            'args'  => array(
                'post_type'      => 'page',
                'posts_per_page' => -1,
                'orderby'        => 'title',
                'order'          => 'ASC',
            ),
            'required' => array( 0 => 'h_btn_link_type2', 1 => 'equals', 2 => 'page' ),
            'force_output' => true
        ),
        array(
            'id' => 'h_btn_link_custom2',
            'type' => 'text',
            'title' => esc_html__('Custom Link', 'alico'),
            'default' => '',
            'required' => array( 0 => 'h_btn_link_type2', 1 => 'equals', 2 => 'custom' ),
            'force_output' => true
        ),
        array(
            'id'       => 'h_btn_target2',
            'type'     => 'button_set',
            'title'    => esc_html__('Button Target', 'alico'),
            'options'  => array(
                '_self'  => esc_html__('Self', 'alico'),
                '_blank'  => esc_html__('Blank', 'alico')
            ),
            'default'  => '_self',
            'required' => array( 0 => 'h_btn_on2', 1 => 'equals', 2 => 'show' ),
            'force_output' => true
        ),
        array(
            'id'       => 'h_btn_icon2',
            'type'     => 'ct_iconpicker',
            'title'    => esc_html__('Icon', 'alico'),
            'required' => array( 0 => 'h_btn_on2', 1 => 'equals', 2 => 'show' ),
            'force_output' => true
        ),
    )
));

/*--------------------------------------------------------------
# Page Title area
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title'  => esc_html__('Page Title', 'alico'),
    'icon'   => 'el-icon-map-marker',
    'fields' => array(

        array(
            'id'           => 'pagetitle',
            'type'         => 'button_set',
            'title'        => esc_html__( 'Page Title', 'alico' ),
            'options'      => array(
                'show'  => esc_html__( 'Show', 'alico' ),
                'hide'  => esc_html__( 'Hide', 'alico' ),
            ),
            'default'      => 'show',
        ),

        array(
            'id'       => 'ptitle_bg',
            'type'     => 'background',
            'title'    => esc_html__('Background', 'alico'),
            'subtitle' => esc_html__('Page title background.', 'alico'),
            'output'   => array('body #pagetitle'),
            'required' => array( 0 => 'pagetitle', 1 => 'equals', 2 => 'show' ),
            'force_output' => true,
            'background-image' => true,
            'background-color' => false,
            'background-position' => false,
            'background-repeat' => false,
            'background-size' => false,
            'background-attachment' => false,
            'transparent' => false,
        ),
        array(
            'id'             => 'page_title_padding',
            'type'           => 'spacing',
            'output'         => array('body #pagetitle'),
            'right'   => false,
            'left'    => false,
            'mode'           => 'padding',
            'units'          => array('px'),
            'units_extended' => 'false',
            'title'          => esc_html__('Page Title Padding', 'alico'),
            'desc'           => esc_html__('Default: Top-126px, Bottom-116px', 'alico'),
            'default'            => array(
                'padding-top'   => '',
                'padding-bottom'   => '',
                'units'          => 'px',
            ),
            'required' => array( 0 => 'pagetitle', 1 => 'equals', 2 => 'show' ),
            'force_output' => true
        ),
        array(
            'id'       => 'ptitle_breadcrumb_on',
            'type'     => 'button_set',
            'title'    => esc_html__('Breadcrumb', 'alico'),
            'options'  => array(
                'show'  => esc_html__('Show', 'alico'),
                'hidden'  => esc_html__('Hidden', 'alico'),
            ),
            'default'  => 'show',
            'required' => array( 0 => 'pagetitle', 1 => 'equals', 2 => 'show' ),
            'force_output' => true
        ),
    )
));

/*--------------------------------------------------------------
# WordPress default content
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title' => esc_html__('Content', 'alico'),
    'icon'  => 'el-icon-pencil',
    'fields'     => array(
        array(
            'id'       => 'content_bg',
            'type'     => 'background',
            'title'    => esc_html__('Background', 'alico'),
            'subtitle' => esc_html__('Content background.', 'alico'),
            'output'   => array( 'background-color' => '.site-content' ),
            'force_output' => true,
            'background-image' => true,
            'background-color' => true,
            'background-position' => true,
            'background-repeat' => true,
            'background-size' => true,
            'background-attachment' => true,
            'transparent' => false,
        ),
        array(
            'id'             => 'content_padding',
            'type'           => 'spacing',
            'output'         => array('#content'),
            'right'   => false,
            'left'    => false,
            'mode'           => 'padding',
            'units'          => array('px'),
            'units_extended' => 'false',
            'title'          => esc_html__('Content Padding', 'alico'),
            'desc'           => esc_html__('Default: Top-80px, Bottom-80px', 'alico'),
            'default'            => array(
                'padding-top'   => '',
                'padding-bottom'   => '',
                'units'          => 'px',
            )
        ),
        array(
            'id'      => 'search_field_placeholder',
            'type'    => 'text',
            'title'   => esc_html__('Search Form - Text Placeholder', 'alico'),
            'default' => '',
            'desc'           => esc_html__('Default: Search Keywords...', 'alico'),
        ),
    )
));


Redux::setSection($opt_name, array(
    'title'      => esc_html__('Archive', 'alico'),
    'icon'       => 'el-icon-list',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'archive_sidebar_pos',
            'type'     => 'button_set',
            'title'    => esc_html__('Sidebar Position', 'alico'),
            'subtitle' => esc_html__('Select a sidebar position for blog home, archive, search...', 'alico'),
            'options'  => array(
                'left'  => esc_html__('Left', 'alico'),
                'right' => esc_html__('Right', 'alico'),
                'none'  => esc_html__('Disabled', 'alico')
            ),
            'default'  => 'right'
        ),
        array(
            'id'       => 'archive_date_on',
            'title'    => esc_html__('Date', 'alico'),
            'subtitle' => esc_html__('Show date posted on each post.', 'alico'),
            'type'     => 'switch',
            'default'  => true,
        ),
        array(
            'id'       => 'archive_author_on',
            'title'    => esc_html__('Author', 'alico'),
            'subtitle' => esc_html__('Show author name on each post.', 'alico'),
            'type'     => 'switch',
            'default'  => true,
        ),
        array(
            'id'       => 'archive_categories_on',
            'title'    => esc_html__('Categories', 'alico'),
            'subtitle' => esc_html__('Show category names on each post.', 'alico'),
            'type'     => 'switch',
            'default'  => false,
        ),
        array(
            'id'       => 'archive_comments_on',
            'title'    => esc_html__('Comments', 'alico'),
            'subtitle' => esc_html__('Show comments count on each post.', 'alico'),
            'type'     => 'switch',
            'default'  => false,
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => esc_html__('Single Post', 'alico'),
    'icon'       => 'el-icon-file-edit',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'post_sidebar_pos',
            'type'     => 'button_set',
            'title'    => esc_html__('Sidebar Position', 'alico'),
            'subtitle' => esc_html__('Select a sidebar position', 'alico'),
            'options'  => array(
                'left'  => esc_html__('Left', 'alico'),
                'right' => esc_html__('Right', 'alico'),
                'none'  => esc_html__('Disabled', 'alico')
            ),
            'default'  => 'right'
        ),
        array(
            'id'       => 'post_date_on',
            'title'    => esc_html__('Date', 'alico'),
            'subtitle' => esc_html__('Show date on single post.', 'alico'),
            'type'     => 'switch',
            'default'  => true
        ),
        array(
            'id'       => 'post_author_on',
            'title'    => esc_html__('Author', 'alico'),
            'subtitle' => esc_html__('Show author name on single post.', 'alico'),
            'type'     => 'switch',
            'default'  => true
        ),
        array(
            'id'       => 'post_comment_on',
            'title'    => esc_html__('Comment', 'alico'),
            'subtitle' => esc_html__('Show comment name on single post.', 'alico'),
            'type'     => 'switch',
            'default'  => true
        ),
        array(
            'id'       => 'post_categories_on',
            'title'    => esc_html__('Categories', 'alico'),
            'subtitle' => esc_html__('Show category names on single post.', 'alico'),
            'type'     => 'switch',
            'default'  => true
        ),
        array(
            'id'       => 'post_tags_on',
            'title'    => esc_html__('Tags', 'alico'),
            'subtitle' => esc_html__('Show tag names on single post.', 'alico'),
            'type'     => 'switch',
            'default'  => true
        ),
        array(
            'id'       => 'post_social_share_on',
            'title'    => esc_html__('Social Share', 'alico'),
            'subtitle' => esc_html__('Show social share on single post.', 'alico'),
            'type'     => 'switch',
            'default'  => false,
        ),
        array(
            'id'       => 'post_navigation_on',
            'title'    => esc_html__('Navigation', 'alico'),
            'subtitle' => esc_html__('Show navigation on single post.', 'alico'),
            'type'     => 'switch',
            'default'  => false,
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => esc_html__('Extra Post Type', 'alico'),
    'icon'       => 'el el-briefcase',
    'subsection' => true,
    'fields'     => array(
        array(
            'title' => esc_html__('Portfolio', 'alico'),
            'type'  => 'section',
            'id' => 'post_portfolio',
            'indent' => true,
        ),
        array(
            'id'      => 'portfolio_slug',
            'type'    => 'text',
            'title'   => esc_html__('Portfolio Slug', 'alico'),
            'default' => '',
            'desc'     => 'Default: portfolio',
        ),
        array(
            'id'      => 'portfolio_name',
            'type'    => 'text',
            'title'   => esc_html__('Portfolio Name', 'alico'),
            'default' => '',
            'desc'     => 'Default: Portfolio',
        ),
        array(
            'id'      => 'portfolio_category_slug',
            'type'    => 'text',
            'title'   => esc_html__('Portfolio Category Slug', 'alico'),
            'default' => '',
            'desc'     => 'Default: portfolio-category',
        ),
        array(
            'id'      => 'portfolio_category_name',
            'type'    => 'text',
            'title'   => esc_html__('Portfolio Category Name', 'alico'),
            'default' => '',
            'desc'     => 'Default: Portfolio Categories',
        ),
        array(
            'title' => esc_html__('Service', 'alico'),
            'type'  => 'section',
            'id' => 'post_service',
            'indent' => true,
        ),
        array(
            'id'      => 'service_slug',
            'type'    => 'text',
            'title'   => esc_html__('Service Slug', 'alico'),
            'default' => '',
            'desc'     => 'Default: service',
        ),
        array(
            'id'      => 'service_name',
            'type'    => 'text',
            'title'   => esc_html__('Service Name', 'alico'),
            'default' => '',
            'desc'     => 'Default: Service',
        ),
        array(
            'id'      => 'service_category_slug',
            'type'    => 'text',
            'title'   => esc_html__('Service Category Slug', 'alico'),
            'default' => '',
            'desc'     => 'Default: service-category',
        ),
        array(
            'id'      => 'service_category_name',
            'type'    => 'text',
            'title'   => esc_html__('Service Category Name', 'alico'),
            'default' => '',
            'desc'     => 'Default: Service Categories',
        ),
    )
));

/*--------------------------------------------------------------
# Shop
--------------------------------------------------------------*/
if(class_exists('Woocommerce')) {
    Redux::setSection($opt_name, array(
        'title'  => esc_html__('Shop', 'alico'),
        'icon'   => 'el el-shopping-cart',
        'fields' => array(
            array(
                'id'       => 'sidebar_shop',
                'type'     => 'button_set',
                'title'    => esc_html__('Sidebar Position', 'alico'),
                'subtitle' => esc_html__('Select a sidebar position for archive shop.', 'alico'),
                'options'  => array(
                    'left'  => esc_html__('Left', 'alico'),
                    'right' => esc_html__('Right', 'alico'),
                    'none'  => esc_html__('Disabled', 'alico')
                ),
                'default'  => 'right'
            ),
            array(
                'title' => esc_html__('Products displayed per page', 'alico'),
                'id' => 'product_per_page',
                'type' => 'slider',
                'subtitle' => esc_html__('Number product to show', 'alico'),
                'default' => 8,
                'min'  => 4,
                'step' => 1,
                'max' => 50,
                'display_value' => 'text'
            ),
        )
    ));
}

/*--------------------------------------------------------------
# Footer
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title'  => esc_html__('Footer', 'alico'),
    'icon'   => 'el el-website',
    'fields' => array(
        array(
            'id'          => 'footer_layout_custom',
            'type'        => 'select',
            'title'       => esc_html__('Layout', 'alico'),
            'desc'        => sprintf(esc_html__('To use this Option please %sClick Here%s to add your custom footer layout first.','alico'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=footer' ) ) . '">','</a>'),
            'options'     =>alico_list_post('footer'),
            'default'     => '',
        ),
        array(
            'id'       => 'back_totop_on',
            'type'     => 'switch',
            'title'    => esc_html__('Back to Top Button', 'alico'),
            'subtitle' => esc_html__('Show back to top button when scrolled down.', 'alico'),
            'default'  => false,
        ),
        array(
            'id'       => 'fixed_footer',
            'type'     => 'switch',
            'title'    => esc_html__('Fixed Footer', 'alico'),
            'default'  => false,
        ),
    )
));

/* 404 Page /--------------------------------------------------------- */
Redux::setSection($opt_name, array(
    'title'  => esc_html__('404 Page', 'alico'),
    'icon'   => 'el-cog-alt el',
    'fields' => array(
        array(
            'id'       => 'page_404',
            'type'     => 'button_set',
            'title'    => esc_html__('Select 404 Page', 'alico'),
            'options'  => array(
                'default'  => esc_html__('Default', 'alico'),
                'custom'  => esc_html__('Custom', 'alico'),
            ),
            'default'  => 'default'
        ),
        array(
            'id'          => 'page_custom_404',
            'type'        => 'select',
            'title'       => esc_html__('Page', 'alico'),
            'options'     => alico_list_post('page'),
            'default'     => '',
            'required' => array( 0 => 'page_404', 1 => 'equals', 2 => 'custom' ),
            'force_output' => true
        ),
    ),
));

/*--------------------------------------------------------------
# Colors
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title'  => esc_html__('Colors', 'alico'),
    'icon'   => 'el-icon-file-edit',
    'fields' => array(
        array(
            'id'          => 'primary_color',
            'type'        => 'color',
            'title'       => esc_html__('Primary Color', 'alico'),
            'transparent' => false,
            'default'     => '#09a223'
        ),
        array(
            'id'          => 'secondary_color',
            'type'        => 'color',
            'title'       => esc_html__('Secondary Color', 'alico'),
            'transparent' => false,
            'default'     => '#89c709'
        ),
        array(
            'id'          => 'third_color',
            'type'        => 'color',
            'title'       => esc_html__('Third Color', 'alico'),
            'transparent' => false,
            'default'     => '#6C9C07'
        ),
        array(
            'id'      => 'link_color',
            'type'    => 'link_color',
            'title'   => esc_html__('Link Colors', 'alico'),
            'default' => array(
                'regular' => '#09a223',
                'hover'   => '#89c709',
                'active'  => '#89c709'
            ),
            'output'  => array('a')
        ),
        array(
            'id'          => 'dark_color',
            'type'        => 'color',
            'title'       => esc_html__('Dark Color', 'alico'),
            'transparent' => false,
            'default'     => '#000000'
        ),
        array(
            'id'          => 'gradient_color',
            'type'        => 'color_gradient',
            'title'       => esc_html__('Gradient Color One', 'alico'),
            'transparent' => false,
            'default'  => array(
                'from' => '#0c3ef8',
                'to'   => '#6a84ff', 
            ),
        ),
        array(
            'id'          => 'gradient_color2',
            'type'        => 'color_gradient',
            'title'       => esc_html__('Gradient Color Two', 'alico'),
            'transparent' => false,
            'default'  => array(
                'from' => '#9fd712',
                'to'   => '#cbf855', 
            ),
        ),
        array(
            'id'          => 'gradient_color3',
            'type'        => 'color_gradient',
            'title'       => esc_html__('Gradient Color Three', 'alico'),
            'transparent' => false,
            'default'  => array(
                'from' => '#1c7cff',
                'to'   => '#a3ff12', 
            ),
        ),
        array(
            'id'          => 'gradient_color4',
            'type'        => 'color_gradient',
            'title'       => esc_html__('Gradient Color Four', 'alico'),
            'transparent' => false,
            'default'  => array(
                'from' => '#006acc',
                'to'   => '#01d5ff', 
            ),
        ),
    )
));

/*--------------------------------------------------------------
# Typography
--------------------------------------------------------------*/
$custom_font_selectors_1 = Redux::getOption($opt_name, 'custom_font_selectors_1');
$custom_font_selectors_1 = !empty($custom_font_selectors_1) ? explode(',', $custom_font_selectors_1) : array();
Redux::setSection($opt_name, array(
    'title'  => esc_html__('Typography', 'alico'),
    'icon'   => 'el-icon-text-width',
    'fields' => array(
        array(
            'id'       => 'body_default_font',
            'type'     => 'select',
            'title'    => esc_html__('Body Default Font', 'alico'),
            'options'  => array(
                'Roboto'  => esc_html__('Default', 'alico'),
                'Google-Font'  => esc_html__('Google Font', 'alico'),
            ),
            'default'  => 'Roboto',
        ),
        array(
            'id'          => 'font_main',
            'type'        => 'typography',
            'title'       => esc_html__('Body Google Font', 'alico'),
            'subtitle'    => esc_html__('This will be the default font of your website.', 'alico'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'line-height'  => true,
            'font-size'  => true,
            'text-align'  => false,
            'output'      => array('body'),
            'units'       => 'px',
            'required' => array( 0 => 'body_default_font', 1 => 'equals', 2 => 'Google-Font' ),
            'force_output' => true
        ),
        array(
            'id'       => 'heading_default_font',
            'type'     => 'select',
            'title'    => esc_html__('Heading Default Font', 'alico'),
            'options'  => array(
                'Poppins'  => esc_html__('Default', 'alico'),
                'Google-Font'  => esc_html__('Google Font', 'alico'),
            ),
            'default'  => 'Poppins',
        ),
        array(
            'id'          => 'font_h1',
            'type'        => 'typography',
            'title'       => esc_html__('H1', 'alico'),
            'subtitle'    => esc_html__('This will be the default font for all H1 tags of your website.', 'alico'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'text-align'  => false,
            'output'      => array('h1', '.h1', '.text-heading'),
            'units'       => 'px',
            'required' => array( 0 => 'heading_default_font', 1 => 'equals', 2 => 'Google-Font' ),
            'force_output' => true
        ),
        array(
            'id'          => 'font_h2',
            'type'        => 'typography',
            'title'       => esc_html__('H2', 'alico'),
            'subtitle'    => esc_html__('This will be the default font for all H2 tags of your website.', 'alico'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'text-align'  => false,
            'output'      => array('h2', '.h2'),
            'units'       => 'px',
            'required' => array( 0 => 'heading_default_font', 1 => 'equals', 2 => 'Google-Font' ),
            'force_output' => true
        ),
        array(
            'id'          => 'font_h3',
            'type'        => 'typography',
            'title'       => esc_html__('H3', 'alico'),
            'subtitle'    => esc_html__('This will be the default font for all H3 tags of your website.', 'alico'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'text-align'  => false,
            'output'      => array('h3', '.h3'),
            'units'       => 'px',
            'required' => array( 0 => 'heading_default_font', 1 => 'equals', 2 => 'Google-Font' ),
            'force_output' => true
        ),
        array(
            'id'          => 'font_h4',
            'type'        => 'typography',
            'title'       => esc_html__('H4', 'alico'),
            'subtitle'    => esc_html__('This will be the default font for all H4 tags of your website.', 'alico'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'text-align'  => false,
            'output'      => array('h4', '.h4'),
            'units'       => 'px',
            'required' => array( 0 => 'heading_default_font', 1 => 'equals', 2 => 'Google-Font' ),
            'force_output' => true
        ),
        array(
            'id'          => 'font_h5',
            'type'        => 'typography',
            'title'       => esc_html__('H5', 'alico'),
            'subtitle'    => esc_html__('This will be the default font for all H5 tags of your website.', 'alico'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'text-align'  => false,
            'output'      => array('h5', '.h5'),
            'units'       => 'px',
            'required' => array( 0 => 'heading_default_font', 1 => 'equals', 2 => 'Google-Font' ),
            'force_output' => true
        ),
        array(
            'id'          => 'font_h6',
            'type'        => 'typography',
            'title'       => esc_html__('H6', 'alico'),
            'subtitle'    => esc_html__('This will be the default font for all H6 tags of your website.', 'alico'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'text-align'  => false,
            'output'      => array('h6', '.h6'),
            'units'       => 'px',
            'required' => array( 0 => 'heading_default_font', 1 => 'equals', 2 => 'Google-Font' ),
            'force_output' => true
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => esc_html__('Fonts Selectors', 'alico'),
    'icon'       => 'el el-fontsize',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'          => 'custom_font_1',
            'type'        => 'typography',
            'title'       => esc_html__('Custom Font', 'alico'),
            'subtitle'    => esc_html__('This will be the font that applies to the class selector.', 'alico'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'text-align'  => false,
            'output'      => $custom_font_selectors_1,
            'units'       => 'px',

        ),
        array(
            'id'       => 'custom_font_selectors_1',
            'type'     => 'textarea',
            'title'    => esc_html__('CSS Selectors', 'alico'),
            'subtitle' => esc_html__('Add class selectors to apply above font.', 'alico'),
            'validate' => 'no_html'
        )
    )
));

/* Google Maps /--------------------------------------------------------- */
Redux::setSection($opt_name, array(
    'title'  => esc_html__('Google Maps', 'alico'),
    'icon'   => 'el el-map-marker',
    'fields' => array(
        array(
            'id'       => 'gm_api_key',
            'type'     => 'text',
            'title'    => esc_html__('API Key', 'alico'),
            'default' => 'AIzaSyA1rF9bttCxRmsNdZYjW7FzIoyrul5jb-s',
            'desc' => esc_html__('Register a Google Maps Api key then put it in here.', 'alico')
        ),
    ),
));

/* Custom Code /--------------------------------------------------------- */
Redux::setSection($opt_name, array(
    'title'  => esc_html__('Custom Code', 'alico'),
    'icon'   => 'el-icon-edit',
    'fields' => array(

        array(
            'id'       => 'site_header_code',
            'type'     => 'textarea',
            'theme'    => 'chrome',
            'title'    => esc_html__('Header Custom Codes', 'alico'),
            'subtitle' => esc_html__('It will insert the code to wp_head hook.', 'alico'),
        ),
        array(
            'id'       => 'site_footer_code',
            'type'     => 'textarea',
            'theme'    => 'chrome',
            'title'    => esc_html__('Footer Custom Codes', 'alico'),
            'subtitle' => esc_html__('It will insert the code to wp_footer hook.', 'alico'),
        ),

    ),
));

/* Custom CSS /--------------------------------------------------------- */
Redux::setSection($opt_name, array(
    'title'  => esc_html__('Custom CSS', 'alico'),
    'icon'   => 'el-icon-adjust-alt',
    'fields' => array(

        array(
            'id'   => 'customcss',
            'type' => 'info',
            'desc' => esc_html__('Custom CSS', 'alico')
        ),

        array(
            'id'       => 'site_css',
            'type'     => 'ace_editor',
            'title'    => esc_html__('CSS Code', 'alico'),
            'subtitle' => esc_html__('Advanced CSS Options. You can paste your custom CSS Code here.', 'alico'),
            'mode'     => 'css',
            'validate' => 'css',
            'theme'    => 'chrome',
            'default'  => ""
        ),

    ),
));