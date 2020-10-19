<?php
/**
 * Register metabox for posts based on Redux Framework. Supported methods:
 *     isset_args( $post_type )
 *     set_args( $post_type, $redux_args, $metabox_args )
 *     add_section( $post_type, $sections )
 * Each post type can contains only one metabox. Pease note that each field id
 * leads by an underscore sign ( _ ) in order to not show that into Custom Field
 * Metabox from WordPress core feature.
 *
 * @param  CT_Post_Metabox $metabox
 */

add_action( 'ct_post_metabox_register', 'alico_page_options_register' );

function alico_page_options_register( $metabox ) {

	if ( ! $metabox->isset_args( 'post' ) ) {
		$metabox->set_args( 'post', array(
			'opt_name'            => 'post_option',
			'display_name'        => esc_html__( 'Post Settings', 'alico' ),
			'show_options_object' => false,
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'product' ) ) {
		$metabox->set_args( 'product', array(
			'opt_name'            => 'product_option',
			'display_name'        => esc_html__( 'Product Settings', 'alico' ),
			'show_options_object' => false,
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'page' ) ) {
		$metabox->set_args( 'page', array(
			'opt_name'            => alico_get_page_opt_name(),
			'display_name'        => esc_html__( 'Page Settings', 'alico' ),
			'show_options_object' => false,
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'ct_pf_audio' ) ) {
		$metabox->set_args( 'ct_pf_audio', array(
			'opt_name'     => 'post_format_audio',
			'display_name' => esc_html__( 'Audio', 'alico' ),
			'class'        => 'fully-expanded',
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'ct_pf_link' ) ) {
		$metabox->set_args( 'ct_pf_link', array(
			'opt_name'     => 'post_format_link',
			'display_name' => esc_html__( 'Link', 'alico' )
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'ct_pf_quote' ) ) {
		$metabox->set_args( 'ct_pf_quote', array(
			'opt_name'     => 'post_format_quote',
			'display_name' => esc_html__( 'Quote', 'alico' )
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'ct_pf_video' ) ) {
		$metabox->set_args( 'ct_pf_video', array(
			'opt_name'     => 'post_format_video',
			'display_name' => esc_html__( 'Video', 'alico' ),
			'class'        => 'fully-expanded',
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'ct_pf_gallery' ) ) {
		$metabox->set_args( 'ct_pf_gallery', array(
			'opt_name'     => 'post_format_gallery',
			'display_name' => esc_html__( 'Gallery', 'alico' ),
			'class'        => 'fully-expanded',
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	/* Extra Post Type */

	if ( ! $metabox->isset_args( 'service' ) ) {
		$metabox->set_args( 'service', array(
			'opt_name'            => 'service_option',
			'display_name'        => esc_html__( 'Service Settings', 'alico' ),
			'show_options_object' => false,
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'portfolio' ) ) {
		$metabox->set_args( 'portfolio', array(
			'opt_name'            => 'portfolio_option',
			'display_name'        => esc_html__( 'Portfolio Settings', 'alico' ),
			'show_options_object' => false,
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'case-study' ) ) {
		$metabox->set_args( 'case-study', array(
			'opt_name'            => 'case_study_option',
			'display_name'        => esc_html__( 'Case Study Settings', 'alico' ),
			'show_options_object' => false,
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	/**
	 * Config post meta options
	 *
	 */
	$metabox->add_section( 'post', array(
		'title'  => esc_html__( 'Post Settings', 'alico' ),
		'icon'   => 'el el-refresh',
		'fields' => array(
			array(
				'id'             => 'post_content_padding',
				'type'           => 'spacing',
				'output'         => array( '.single-post #content' ),
				'right'          => false,
				'left'           => false,
				'mode'           => 'padding',
				'units'          => array( 'px' ),
				'units_extended' => 'false',
				'title'          => esc_html__( 'Content Padding', 'alico' ),
				'subtitle'     => esc_html__( 'Content site paddings.', 'alico' ),
				'desc'           => esc_html__( 'Default: Theme Option.', 'alico' ),
				'default'        => array(
					'padding-top'    => '',
					'padding-bottom' => '',
					'units'          => 'px',
				)
			),
			array(
				'id'      => 'show_sidebar_post',
				'type'    => 'switch',
				'title'   => esc_html__( 'Custom Sidebar', 'alico' ),
				'default' => false,
				'indent'  => true
			),
			array(
				'id'           => 'sidebar_post_pos',
				'type'         => 'button_set',
				'title'        => esc_html__( 'Sidebar Position', 'alico' ),
				'options'      => array(
					'left'  => esc_html__('Left', 'alico'),
	                'right' => esc_html__('Right', 'alico'),
	                'none'  => esc_html__('Disabled', 'alico')
				),
				'default'      => 'right',
				'required'     => array( 0 => 'show_sidebar_post', 1 => '=', 2 => '1' ),
				'force_output' => true
			),
			array(
				'id'           => 'video_url',
				'type'         => 'text',
				'title'        => esc_html__( 'Video Url', 'alico' ),
			),
		)
	) );

	/**
	 * Config page meta options
	 *
	 */
	$metabox->add_section( 'page', array(
		'title'  => esc_html__( 'Header', 'alico' ),
		'desc'   => esc_html__( 'Header settings for the page.', 'alico' ),
		'icon'   => 'el-icon-website',
		'fields' => array(
			array(
				'id'      => 'custom_header',
				'type'    => 'switch',
				'title'   => esc_html__( 'Custom Layout', 'alico' ),
				'default' => false,
				'indent'  => true
			),
			array(
				'id'           => 'header_layout',
				'type'         => 'image_select',
				'title'        => esc_html__( 'Layout', 'alico' ),
				'subtitle'     => esc_html__( 'Select a layout for header.', 'alico' ),
				'options'      => array(
					'0' => get_template_directory_uri() . '/assets/images/header-layout/h0.jpg',
					'1' => get_template_directory_uri() . '/assets/images/header-layout/h1.jpg',
					'2' => get_template_directory_uri() . '/assets/images/header-layout/h2.jpg',
					'3' => get_template_directory_uri() . '/assets/images/header-layout/h3.jpg',
					'4' => get_template_directory_uri() . '/assets/images/header-layout/h4.jpg',
					'5' => get_template_directory_uri() . '/assets/images/header-layout/h5.jpg',
					'6' => get_template_directory_uri() . '/assets/images/header-layout/h6.jpg',
				),
				'default'      => alico_get_option_of_theme_options( 'header_layout' ),
				'required'     => array( 0 => 'custom_header', 1 => 'equals', 2 => '1' ),
				'force_output' => true
			),
			array(
	            'id'       => 'p_logo_dark',
	            'type'     => 'media',
	            'title'    => esc_html__('Custom Logo Dark', 'alico'),
	            'default' => '',
	            'required'     => array( 0 => 'custom_header', 1 => 'equals', 2 => '1' ),
				'force_output' => true
	        ),
	        array(
	            'id'       => 'p_logo_light',
	            'type'     => 'media',
	            'title'    => esc_html__('Custom Logo Light', 'alico'),
	            'default' => '',
	            'required'     => array( 0 => 'custom_header', 1 => 'equals', 2 => '1' ),
				'force_output' => true
	        ),
	        array(
	            'id'       => 'p_logo_mobile',
	            'type'     => 'media',
	            'title'    => esc_html__('Custom Logo Mobile', 'alico'),
	            'default' => '',
	            'required'     => array( 0 => 'custom_header', 1 => 'equals', 2 => '1' ),
				'force_output' => true
	        ),
	        array(
				'id'      => 'navigation_hide_icon',
				'type'    => 'switch',
				'title'   => esc_html__( 'Navigation Hide Icon', 'alico' ),
				'default' => false,
				'indent'  => true
			),
			array(
	            'id' => 'custom_wellcome_text',
	            'type' => 'text',
	            'title' => esc_html__('Custom Short Description', 'alico'),
	            'default' => '',
	            'required'     => array( 0 => 'header_layout', 1 => 'equals', 2 => '6' ),
				'force_output' => true
	        ),
	        array(
	            'id' => 'custom_phone',
	            'type' => 'text',
	            'title' => esc_html__('Custom Phone', 'alico'),
	            'default' => '',
	            'required'     => array( 0 => 'header_layout', 1 => 'equals', 2 => '6' ),
				'force_output' => true
	        ),
	        array(
	            'id' => 'custom_phone_label',
	            'type' => 'text',
	            'title' => esc_html__('Custom Phone Label', 'alico'),
	            'default' => '',
	            'required'     => array( 0 => 'header_layout', 1 => 'equals', 2 => '6' ),
				'force_output' => true
	        ),
		)
	) );

	$metabox->add_section( 'page', array(
		'title'  => esc_html__( 'Page Title', 'alico' ),
		'icon'   => 'el el-indent-left',
		'fields' => array(
			array(
				'id'           => 'custom_pagetitle',
				'type'         => 'button_set',
				'title'        => esc_html__( 'Page Title', 'alico' ),
				'options'      => array(
					'themeoption'  => esc_html__( 'Theme Option', 'alico' ),
					'show'  => esc_html__( 'Custom', 'alico' ),
					'hide'  => esc_html__( 'Hide', 'alico' ),
				),
				'default'      => 'themeoption',
			),
			array(
				'id'           => 'custom_title',
				'type'         => 'textarea',
				'title'        => esc_html__( 'Title', 'alico' ),
				'subtitle'     => esc_html__( 'Use custom title for this page. The default title will be used on document title.', 'alico' ),
				'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => 'show' ),
				'force_output' => true
			),
			array(
	            'id'       => 'ptitle_bg',
	            'type'     => 'background',
	            'background-color'     => true,
	            'background-repeat'     => false,
	            'background-size'     => false,
	            'background-attachment'     => false,
	            'background-position'     => false,
	            'transparent'     => false,
	            'title'    => esc_html__('Background', 'alico'),
	            'subtitle' => esc_html__('Page title background image.', 'alico'),
	            'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => 'show' ),
				'force_output' => true
	        ),
	        array(
				'id'       => 'ptitle_bg_overlay',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Background Color Overlay', 'alico' ),
				'subtitle' => esc_html__( 'Page title background color overlay.', 'alico' ),
				'output'   => array( 'background-color' => 'body #pagetitle:before' ),
				'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => 'show' ),
				'force_output' => true
			),
	        array(
	            'id'             => 'ptitle_padding',
	            'type'           => 'spacing',
	            'output'         => array('.site #pagetitle.page-title'),
	            'right'   => false,
	            'left'    => false,
	            'mode'           => 'padding',
	            'units'          => array('px'),
	            'units_extended' => 'false',
	            'title'          => esc_html__('Page Title Padding', 'alico'),
	            'default'            => array(
	                'padding-top'   => '',
	                'padding-bottom'   => '',
	                'units'          => 'px',
	            ),
	            'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => 'show' ),
				'force_output' => true
	        ),
		)
	) );

	$metabox->add_section( 'page', array(
		'title'  => esc_html__( 'Content', 'alico' ),
		'desc'   => esc_html__( 'Settings for content area.', 'alico' ),
		'icon'   => 'el-icon-pencil',
		'fields' => array(
			array(
	            'id'          => 'primary_color',
	            'type'        => 'color',
	            'title'       => esc_html__('Primary Color', 'alico'),
	            'transparent' => false,
	        ),
	        array(
	            'id'          => 'secondary_color',
	            'type'        => 'color',
	            'title'       => esc_html__('Secondary Color', 'alico'),
	            'transparent' => false,
	        ),
	        array(
	            'id'          => 'third_color',
	            'type'        => 'color',
	            'title'       => esc_html__('Third Color', 'alico'),
	            'transparent' => false,
	        ),
	        array(
				'id'           => 'loading_page',
				'type'         => 'button_set',
				'title'        => esc_html__( 'Loading', 'alico' ),
				'options'      => array(
					'themeoption'  => esc_html__( 'Theme Option', 'alico' ),
					'custom' => esc_html__( 'Cuttom', 'alico' ),
				),
				'default'      => 'themeoption',
			),
			array(
	            'id'       => 'loading_type',
	            'type'     => 'select',
	            'title'    => esc_html__('Loading Type', 'alico'),
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
	            'required'     => array( 0 => 'loading_page', 1 => '=', 2 => 'custom' ),
				'force_output' => true
	        ),
			array(
				'id'       => 'content_bg_color',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Background Color', 'alico' ),
				'subtitle' => esc_html__( 'Content background color.', 'alico' ),
				'output'   => array( 'background-color' => 'body .site-content' )
			),
			array(
				'id'      => 'hide_bg_image',
				'type'    => 'switch',
				'title'   => esc_html__( 'Hide Background Image', 'alico' ),
				'default' => false,
				'indent'  => true
			),
			array(
				'id'             => 'content_padding',
				'type'           => 'spacing',
				'output'         => array( '#content' ),
				'right'          => false,
				'left'           => false,
				'mode'           => 'padding',
				'units'          => array( 'px' ),
				'units_extended' => 'false',
				'title'          => esc_html__( 'Content Padding', 'alico' ),
				'desc'           => esc_html__( 'Default: Theme Option.', 'alico' ),
				'default'        => array(
					'padding-top'    => '',
					'padding-bottom' => '',
					'units'          => 'px',
				)
			),
			array(
				'id'      => 'show_sidebar_page',
				'type'    => 'switch',
				'title'   => esc_html__( 'Show Sidebar', 'alico' ),
				'default' => false,
				'indent'  => true
			),
			array(
				'id'           => 'sidebar_page_pos',
				'type'         => 'button_set',
				'title'        => esc_html__( 'Sidebar Position', 'alico' ),
				'options'      => array(
					'left'  => esc_html__( 'Left', 'alico' ),
					'right' => esc_html__( 'Right', 'alico' ),
				),
				'default'      => 'right',
				'required'     => array( 0 => 'show_sidebar_page', 1 => '=', 2 => '1' ),
				'force_output' => true
			),
		)
	) );

	$metabox->add_section( 'page', array(
		'title'  => esc_html__( 'Footer', 'alico' ),
		'desc'   => esc_html__( 'Settings for footer area.', 'alico' ),
		'icon'   => 'el el-website',
		'fields' => array(
			array(
				'id'      => 'custom_footer',
				'type'    => 'switch',
				'title'   => esc_html__( 'Custom Layout', 'alico' ),
				'default' => false,
				'indent'  => true
			),
	        array(
	            'id'          => 'footer_layout_custom',
	            'type'        => 'select',
	            'title'       => esc_html__('Layout', 'alico'),
	            'desc'        => sprintf(esc_html__('To use this Option please %sClick Here%s to add your custom footer layout first.','alico'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=footer' ) ) . '">','</a>'),
	            'options'     =>alico_list_post('footer'),
	            'default'     => '',
	            'required' => array( 0 => 'custom_footer', 1 => 'equals', 2 => '1' ),
	            'force_output' => true
	        ),
	    )
	) );	

	/**
	 * Config post format meta options
	 *
	 */

	$metabox->add_section( 'ct_pf_video', array(
		'title'  => esc_html__( 'Video', 'alico' ),
		'fields' => array(
			array(
				'id'    => 'post-video-url',
				'type'  => 'text',
				'title' => esc_html__( 'Video URL', 'alico' ),
				'desc'  => esc_html__( 'YouTube or Vimeo video URL', 'alico' )
			),

			array(
				'id'    => 'post-video-file',
				'type'  => 'editor',
				'title' => esc_html__( 'Video Upload', 'alico' ),
				'desc'  => esc_html__( 'Upload video file', 'alico' )
			),

			array(
				'id'    => 'post-video-html',
				'type'  => 'textarea',
				'title' => esc_html__( 'Embadded video', 'alico' ),
				'desc'  => esc_html__( 'Use this option when the video does not come from YouTube or Vimeo', 'alico' )
			)
		)
	) );

	$metabox->add_section( 'ct_pf_gallery', array(
		'title'  => esc_html__( 'Gallery', 'alico' ),
		'fields' => array(
			array(
				'id'       => 'post-gallery-lightbox',
				'type'     => 'switch',
				'title'    => esc_html__( 'Lightbox?', 'alico' ),
				'subtitle' => esc_html__( 'Enable lightbox for gallery images.', 'alico' ),
				'default'  => true
			),
			array(
				'id'       => 'post-gallery-images',
				'type'     => 'gallery',
				'title'    => esc_html__( 'Gallery Images ', 'alico' ),
				'subtitle' => esc_html__( 'Upload images or add from media library.', 'alico' )
			)
		)
	) );

	$metabox->add_section( 'ct_pf_audio', array(
		'title'  => esc_html__( 'Audio', 'alico' ),
		'fields' => array(
			array(
				'id'          => 'post-audio-url',
				'type'        => 'text',
				'title'       => esc_html__( 'Audio URL', 'alico' ),
				'description' => esc_html__( 'Audio file URL in format: mp3, ogg, wav.', 'alico' ),
				'validate'    => 'url',
				'msg'         => 'Url error!'
			)
		)
	) );

	$metabox->add_section( 'ct_pf_link', array(
		'title'  => esc_html__( 'Link', 'alico' ),
		'fields' => array(
			array(
				'id'       => 'post-link-url',
				'type'     => 'text',
				'title'    => esc_html__( 'URL', 'alico' ),
				'validate' => 'url',
				'msg'      => 'Url error!'
			)
		)
	) );

	$metabox->add_section( 'ct_pf_quote', array(
		'title'  => esc_html__( 'Quote', 'alico' ),
		'fields' => array(
			array(
				'id'    => 'post-quote-cite',
				'type'  => 'text',
				'title' => esc_html__( 'Cite', 'alico' )
			)
		)
	) );

	/**
	 * Config service meta options
	 *
	 */
	$metabox->add_section( 'service', array(
		'title'  => esc_html__( 'General', 'alico' ),
		'icon'   => 'el-icon-website',
		'fields' => array(
			array(
	            'id'       => 'icon_type',
	            'type'     => 'button_set',
	            'title'    => esc_html__('Icon Type', 'alico'),
	            'options'  => array(
	                'icon'  => esc_html__('Icon', 'alico'),
	                'image'  => esc_html__('Image', 'alico'),
	            ),
	            'default'  => 'icon'
	        ),
			array(
	            'id'       => 'service_icon',
	            'type'     => 'ct_iconpicker',
	            'title'    => esc_html__('Icon', 'alico'),
	            'required' => array( 0 => 'icon_type', 1 => 'equals', 2 => 'icon' ),
            	'force_output' => true
	        ),
	        array(
	            'id'       => 'service_icon_img',
	            'type'     => 'media',
	            'title'    => esc_html__('Icon Image', 'alico'),
	            'default' => '',
	            'required' => array( 0 => 'icon_type', 1 => 'equals', 2 => 'image' ),
            	'force_output' => true
	        ),
			array(
				'id'       => 'service_except',
				'type'     => 'textarea',
				'title'    => esc_html__( 'Excerpt', 'alico' ),
				'validate' => 'no_html'
			),
			array(
				'id'             => 'service_content_padding',
				'type'           => 'spacing',
				'output'         => array( '.single-service #content' ),
				'right'          => false,
				'left'           => false,
				'mode'           => 'padding',
				'units'          => array( 'px' ),
				'units_extended' => 'false',
				'title'          => esc_html__( 'Content Padding', 'alico' ),
				'subtitle'     => esc_html__( 'Content site paddings.', 'alico' ),
				'desc'           => esc_html__( 'Default: Theme Option.', 'alico' ),
				'default'        => array(
					'padding-top'    => '',
					'padding-bottom' => '',
					'units'          => 'px',
				)
			),
		)
	) );

	/**
	 * Config portfolio meta options
	 *
	 */
	$metabox->add_section( 'portfolio', array(
		'title'  => esc_html__( 'General', 'alico' ),
		'icon'   => 'el-icon-website',
		'fields' => array(
			array(
				'id'             => 'portfolio_content_padding',
				'type'           => 'spacing',
				'output'         => array( '.single-portfolio #content' ),
				'right'          => false,
				'left'           => false,
				'mode'           => 'padding',
				'units'          => array( 'px' ),
				'units_extended' => 'false',
				'title'          => esc_html__( 'Content Padding', 'alico' ),
				'subtitle'     => esc_html__( 'Content site paddings.', 'alico' ),
				'desc'           => esc_html__( 'Default: Theme Option.', 'alico' ),
				'default'        => array(
					'padding-top'    => '',
					'padding-bottom' => '',
					'units'          => 'px',
				)
			),
		)
	) );

	/**
	 * Config case study meta options
	 *
	 */
	$metabox->add_section( 'case-study', array(
		'title'  => esc_html__( 'General', 'alico' ),
		'icon'   => 'el-icon-website',
		'fields' => array(
			array(
				'id'             => 'case_study_content_padding',
				'type'           => 'spacing',
				'output'         => array( '.single-case-study #content' ),
				'right'          => false,
				'left'           => false,
				'mode'           => 'padding',
				'units'          => array( 'px' ),
				'units_extended' => 'false',
				'title'          => esc_html__( 'Content Padding', 'alico' ),
				'subtitle'     => esc_html__( 'Content site paddings.', 'alico' ),
				'desc'           => esc_html__( 'Default: Theme Option.', 'alico' ),
				'default'        => array(
					'padding-top'    => '',
					'padding-bottom' => '',
					'units'          => 'px',
				)
			),
		)
	) );

	/**
     * Config product meta options
     *
     */
    $metabox->add_section('product', array(
        'title'  => esc_html__('Product Settings', 'alico'),
        'icon'   => 'el el-briefcase',
        'fields' => array(
            array(
                'id'       => 'product_feature',
                'type'     => 'multi_text',
                'title'    => esc_html__('Feature', 'alico'),
                'validate' => 'html',
            ),
        )
    ));

}

function alico_get_option_of_theme_options( $key, $default = '' ) {
	if ( empty( $key ) ) {
		return '';
	}
	$options = get_option( alico_get_opt_name(), array() );
	$value   = isset( $options[ $key ] ) ? $options[ $key ] : $default;

	return $value;
}