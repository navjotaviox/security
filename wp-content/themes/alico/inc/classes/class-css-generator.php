<?php
if ( ! class_exists( 'ReduxFrameworkInstances' ) ) {
	return;
}

if(!function_exists('alico_hex_to_rgba')){
    function alico_hex_to_rgba($hex,$opacity = 1) {
        $hex = str_replace("#",null, $hex);
        $color = array();
        if(strlen($hex) == 3) {
            $color['r'] = hexdec(substr($hex,0,1).substr($hex,0,1));
            $color['g'] = hexdec(substr($hex,1,1).substr($hex,1,1));
            $color['b'] = hexdec(substr($hex,2,1).substr($hex,2,1));
            $color['a'] = $opacity;
        }
        else if(strlen($hex) == 6) {
            $color['r'] = hexdec(substr($hex, 0, 2));
            $color['g'] = hexdec(substr($hex, 2, 2));
            $color['b'] = hexdec(substr($hex, 4, 2));
            $color['a'] = $opacity;
        }
        $color = "rgba(".implode(', ', $color).")";
        return $color;
    }
}

class CSS_Generator {
	/**
     * scssc class instance
     *
     * @access protected
     * @var scssc
     */
    protected $scssc = null;

    /**
     * ReduxFramework class instance
     *
     * @access protected
     * @var ReduxFramework
     */
    protected $redux = null;

    /**
     * Debug mode is turn on or not
     *
     * @access protected
     * @var boolean
     */
    protected $dev_mode = true;

    /**
     * opt_name of ReduxFramework
     *
     * @access protected
     * @var string
     */
    protected $opt_name = '';

	/**
	 * Constructor
	 */
	function __construct() {
		$this->opt_name = alico_get_opt_name();

		if ( empty( $this->opt_name ) ) {
			return;
		}
		$this->dev_mode = alico_get_opt( 'dev_mode', '0' ) === '1' ? true : false;
		add_filter( 'ct_scssc_on', '__return_true' );
		add_action( 'init', array( $this, 'init' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ), 20 );
	}

	/**
	 * init hook - 10
	 */
	function init() {
		if ( ! class_exists( 'scssc' ) ) {
			return;
		}

		$this->redux = ReduxFrameworkInstances::get_instance( $this->opt_name );

		if ( empty( $this->redux ) || ! $this->redux instanceof ReduxFramework ) {
			return;
		}
		add_action( 'wp', array( $this, 'generate_with_dev_mode' ) );
		add_action( "redux/options/{$this->opt_name}/saved", function () {
			$this->generate_file();
		} );
	}

	function generate_with_dev_mode() {
		if ( $this->dev_mode === true ) {
			$this->generate_file();
		}
	}

	/**
	 * Generate options and css files
	 */
	function generate_file() {
		$scss_dir = get_template_directory() . '/assets/scss/';
		$css_dir  = get_template_directory() . '/assets/css/';

		$this->scssc = new scssc();
		$this->scssc->setImportPaths( $scss_dir );

		$_options = $scss_dir . 'variables.scss';

		$this->redux->filesystem->execute( 'put_contents', $_options, array(
			'content' => preg_replace( "/(?<=[^\r]|^)\n/", "\r\n", $this->options_output() )
		) );
		$css_file = $css_dir . 'theme.css';

		$this->scssc->setFormatter( 'scss_formatter' );
		$this->redux->filesystem->execute( 'put_contents', $css_file, array(
			'content' => preg_replace( "/(?<=[^\r]|^)\n/", "\r\n", $this->scssc->compile( '@import "theme.scss"' ) )
		) );
	}

	/**
	 * Output options to _variables.scss
	 *
	 * @access protected
	 * @return string
	 */
	protected function options_output() {
		ob_start();

		$primary_color = alico_get_opt( 'primary_color', '#09a223' );
		if ( ! alico_is_valid_color( $primary_color ) ) {
			$primary_color = '#09a223';
		}
		printf( '$primary_color: %s;', esc_attr( $primary_color ) );

		$secondary_color = alico_get_opt( 'secondary_color', '#000000' );
		if ( ! alico_is_valid_color( $secondary_color ) ) {
			$secondary_color = '#000000';
		}
		printf( '$secondary_color: %s;', esc_attr( $secondary_color ) );

		$third_color = alico_get_opt( 'third_color', '#ff05ff' );
        if ( !alico_is_valid_color( $third_color ) )
        {
            $third_color = '#ff05ff';
        }
        printf( '$third_color: %s;', esc_attr( $third_color ) );

        $dark_color = alico_get_opt( 'dark_color', '#000' );
        if ( !alico_is_valid_color( $dark_color ) )
        {
            $dark_color = '#000';
        }
        printf( '$dark_color: %s;', esc_attr( $dark_color ) );

		$link_color = alico_get_opt( 'link_color', '#09a223' );
		if ( ! empty( $link_color['regular'] ) && isset( $link_color['regular'] ) ) {
			printf( '$link_color: %s;', esc_attr( $link_color['regular'] ) );
		} else {
			echo '$link_color: #09a223;';
		}

		$link_color_hover = alico_get_opt( 'link_color', '#09a223' );
		if ( ! empty( $link_color['hover'] ) && isset( $link_color['hover'] ) ) {
			printf( '$link_color_hover: %s;', esc_attr( $link_color['hover'] ) );
		} else {
			echo '$link_color_hover: #09a223;';
		}

		$link_color_active = alico_get_opt( 'link_color', '#09a223' );
		if ( ! empty( $link_color['active'] ) && isset( $link_color['active'] ) ) {
			printf( '$link_color_active: %s;', esc_attr( $link_color['active'] ) );
		} else {
			echo '$link_color_active: #09a223;';
		}

		/* Gradient Color 1 */
        $gradient_color = alico_get_opt( 'gradient_color' );
        if ( !empty($gradient_color['from']) && isset($gradient_color['from']) )
        {
            printf( '$gradient_color_from: %s;', esc_attr( $gradient_color['from'] ) );
        } else {
            echo '$gradient_color_from: '.$primary_color.';';
        }
        if ( !empty($gradient_color['to']) && isset($gradient_color['to']) )
        {
            printf( '$gradient_color_to: %s;', esc_attr( $gradient_color['to'] ) );
        } else {
            echo '$gradient_color_to: '.$primary_color.';';
        }

        /* Gradient Color 2 */
        $gradient_color2 = alico_get_opt( 'gradient_color2' );
        if ( !empty($gradient_color2['from']) && isset($gradient_color2['from']) )
        {
            printf( '$gradient_color_from2: %s;', esc_attr( $gradient_color2['from'] ) );
        } else {
            echo '$gradient_color_from2: '.$primary_color.';';
        }
        if ( !empty($gradient_color2['to']) && isset($gradient_color2['to']) )
        {
            printf( '$gradient_color_to2: %s;', esc_attr( $gradient_color2['to'] ) );
        } else {
            echo '$gradient_color_to2: '.$primary_color.';';
        }

        /* Gradient Color 3 */
        $gradient_color3 = alico_get_opt( 'gradient_color3' );
        if ( !empty($gradient_color3['from']) && isset($gradient_color3['from']) )
        {
            printf( '$gradient_color_from3: %s;', esc_attr( $gradient_color3['from'] ) );
        } else {
            echo '$gradient_color_from3: '.$primary_color.';';
        }
        if ( !empty($gradient_color3['to']) && isset($gradient_color3['to']) )
        {
            printf( '$gradient_color_to3: %s;', esc_attr( $gradient_color3['to'] ) );
        } else {
            echo '$gradient_color_to3: '.$primary_color.';';
        }

        /* Gradient Color 4 */
        $gradient_color4 = alico_get_opt( 'gradient_color4' );
        if ( !empty($gradient_color4['from']) && isset($gradient_color4['from']) )
        {
            printf( '$gradient_color_from4: %s;', esc_attr( $gradient_color4['from'] ) );
        } else {
            echo '$gradient_color_from4: '.$primary_color.';';
        }
        if ( !empty($gradient_color4['to']) && isset($gradient_color4['to']) )
        {
            printf( '$gradient_color_to4: %s;', esc_attr( $gradient_color4['to'] ) );
        } else {
            echo '$gradient_color_to4: '.$primary_color.';';
        }

		/* Font */
		$body_default_font = alico_get_opt( 'body_default_font', 'Roboto' );
		if ( isset( $body_default_font ) ) {
			echo '
                $body_default_font: ' . esc_attr( $body_default_font ) . ';
            ';
		}

		$heading_default_font = alico_get_opt( 'heading_default_font', 'Poppins' );
		if ( isset( $heading_default_font ) ) {
			echo '
                $heading_default_font: ' . esc_attr( $heading_default_font ) . ';
            ';
		}

		return ob_get_clean();
	}

	/**
	 * Hooked wp_enqueue_scripts - 20
	 * Make sure that the handle is enqueued from earlier wp_enqueue_scripts hook.
	 */
	function enqueue() {
		$css = $this->inline_css();
		if ( ! empty( $css ) ) {
			wp_add_inline_style( 'alico-theme', $this->dev_mode ? $css : alico_css_minifier( $css ) );
		}
	}

	/**
	 * Generate inline css based on theme options
	 */
	protected function inline_css() {
		ob_start();

		/* Logo */
		$logo_maxh = alico_get_opt( 'logo_maxh' );

		if ( ! empty( $logo_maxh['height'] ) && $logo_maxh['height'] != 'px' ) {
			printf( '#ct-header-wrap .ct-header-branding a img { max-height: %s !important; }', esc_attr( $logo_maxh['height'] ) );
		} ?>
        @media screen and (max-width: 1199px) {
		<?php
			$logo_maxh_sm = alico_get_opt( 'logo_maxh_sm' );
			if ( ! empty( $logo_maxh_sm['height'] ) && $logo_maxh_sm['height'] != 'px' ) {
				printf( '#ct-header-wrap .ct-header-branding a img { max-height: %s !important; }', esc_attr( $logo_maxh_sm['height'] ) );
			} ?>
        }
        <?php /* End Logo */

		/* Menu */ ?>
		@media screen and (min-width: 1200px) {
		<?php  $main_menu_color = alico_get_opt( 'main_menu_color' );
			if ( ! empty( $main_menu_color['regular'] ) ) {
				printf( '.ct-main-menu > li > a { color: %s !important; }', esc_attr( $main_menu_color['regular'] ) );
			}
			if ( ! empty( $main_menu_color['hover'] ) ) {
				printf( '.ct-main-menu > li > a:hover { color: %s !important; }', esc_attr( $main_menu_color['hover'] ) );
			}
			if ( ! empty( $main_menu_color['active'] ) ) {
				printf( '.ct-main-menu > li.current_page_item > a, .ct-main-menu > li.current-menu-item > a, .ct-main-menu > li.current_page_ancestor > a, .ct-main-menu > li.current-menu-ancestor > a { color: %s !important; }', esc_attr( $main_menu_color['active'] ) );
			}
			$sticky_menu_color = alico_get_opt( 'sticky_menu_color' );
			if ( ! empty( $sticky_menu_color['regular'] ) ) {
				printf( '#ct-header.h-fixed .ct-main-menu > li > a { color: %s !important; }', esc_attr( $sticky_menu_color['regular'] ) );
			}
			if ( ! empty( $sticky_menu_color['hover'] ) ) {
				printf( '#ct-header.h-fixed .ct-main-menu > li > a:hover { color: %s !important; }', esc_attr( $sticky_menu_color['hover'] ) );
			}
			if ( ! empty( $sticky_menu_color['active'] ) ) {
				printf( '#ct-header.h-fixed .ct-main-menu > li.current_page_item > a, #ct-header.h-fixed .ct-main-menu > li.current-menu-item > a, #ct-header.h-fixed .ct-main-menu > li.current_page_ancestor > a, #ct-header.h-fixed .ct-main-menu > li.current-menu-ancestor > a { color: %s !important; }', esc_attr( $sticky_menu_color['active'] ) );
			}
			$sub_menu_color = alico_get_opt( 'sub_menu_color' );
			if ( ! empty( $sub_menu_color['regular'] ) ) {
				printf( '#ct-header .ct-main-menu .sub-menu > li > a { color: %s !important; }', esc_attr( $sub_menu_color['regular'] ) );
			}
			if ( ! empty( $sub_menu_color['hover'] ) ) {
				printf( '#ct-header .ct-main-menu .sub-menu > li > a:hover { color: %s !important; }', esc_attr( $sub_menu_color['hover'] ) );
				printf( '#ct-header .ct-main-menu .sub-menu > li > a:before { background-color: %s !important; }', esc_attr( $sub_menu_color['hover'] ) );
			}
			if ( ! empty( $sub_menu_color['active'] ) ) {
				printf( '#ct-header .ct-main-menu .sub-menu > li.current_page_item > a, #ct-header .ct-main-menu .sub-menu > li.current-menu-item > a, #ct-header .ct-main-menu .sub-menu > li.current_page_ancestor > a, #ct-header .ct-main-menu .sub-menu > li.current-menu-ancestor > a { color: %s !important; }', esc_attr( $sub_menu_color['active'] ) );
				printf( '#ct-header .ct-main-menu .sub-menu > li.current_page_item > a:before, #ct-header .ct-main-menu .sub-menu > li.current-menu-item > a:before, #ct-header .ct-main-menu .sub-menu > li.current_page_ancestor > a:before, #ct-header .ct-main-menu .sub-menu > li.current-menu-ancestor > a:before { background-color: %s !important; }', esc_attr( $sub_menu_color['active'] ) );
			}
			$menu_icon_color = alico_get_opt( 'menu_icon_color' );
			if ( ! empty( $menu_icon_color ) ) {
				printf( '.ct-main-menu .link-icon { color: %s !important; }', esc_attr( $menu_icon_color ) );
			}
			?>
		}
		<?php /* End Menu */

		/* Page Title */
		$ptitle_bg = alico_get_page_opt( 'ptitle_bg' );
		$custom_pagetitle = alico_get_page_opt( 'custom_pagetitle', 'themeoption' );
		if ( $custom_pagetitle == 'show' && ! empty( $ptitle_bg['background-image'] ) ) {
			echo 'body .site #pagetitle.page-title {
                background-image: url(' . esc_attr( $ptitle_bg['background-image'] ) . ');
            }';
		}
		if ( $custom_pagetitle == 'show' && ! empty( $ptitle_bg['background-color'] ) ) {
			echo 'body .site #pagetitle.page-title {
                background-color: '. esc_attr( $ptitle_bg['background-color'] ) .';
            }';
		}

		/* Preset */
		$p_primary_color = alico_get_page_opt( 'primary_color' );
		if ( ! empty( $p_primary_color ) ) {
			echo '#ct-header-wrap .ct-header-topbar1 .ct-header-welcome cite,
			#ct-header-wrap.ct-header-layout2 .ct-main-menu > li:hover > a, 
			#ct-header-wrap.ct-header-layout2 .ct-main-menu > li.current_page_item > a, 
			#ct-header-wrap.ct-header-layout2 .ct-main-menu > li.current-menu-item > a, 
			#ct-header-wrap.ct-header-layout2 .ct-main-menu > li.current_page_ancestor > a, 
			#ct-header-wrap.ct-header-layout2 .ct-main-menu > li.current-menu-ancestor > a,
			.ct-main-menu .sub-menu li > a:hover, 
			.ct-main-menu .children li > a:hover, 
			.ct-main-menu .sub-menu li.current_page_item > a, 
			.ct-main-menu .children li.current_page_item > a, 
			.ct-main-menu .sub-menu li.current-menu-item > a, 
			.ct-main-menu .children li.current-menu-item > a, 
			.ct-main-menu .sub-menu li.current_page_ancestor > a, 
			.ct-main-menu .children li.current_page_ancestor > a, 
			.ct-main-menu .sub-menu li.current-menu-ancestor > a, 
			.ct-main-menu .children li.current-menu-ancestor > a,
			.ct-heading .item--title b, .btn-text:hover, .color-primary,
			.ct-contact-form-layout1 .ct-range-footer a:hover,
			.ct-blog-carousel-layout2 .grid-item-inner:hover .item--title a,
			#ct-header-wrap.ct-header-layout3 #ct-header .ct-main-menu > li > a::after,
			.ct-service-grid3 .grid-item-inner:hover .item--title a,
			.ct-counter-layout1 .item--icon i,
			#ct-loadding.style11 .loading-spinner,
			.ct-getintouch .ct-getintouch-item .ct-getintouch-icon i {
                color: ' . esc_attr( $p_primary_color ) . ';
            }';

            echo '.ct-contact-form-layout1 .ct-range-meta .ct-range-result {
                color: ' . esc_attr( $p_primary_color ) . ' !important;
            }';

            echo '.scroll-top, .ct-main-menu .sub-menu li a::before, .ct-main-menu .children li a::before, .btn, .btn.btn-secondary:hover, .btn.btn-secondary:focus, .btn.btn-secondary2:hover, .btn.btn-secondary2:focus,
            .ct-tabs--layout1 .ct-tabs-title .ct-tab-title.active, 
            .ct-mailchimp1.style2 .mc4wp-form .mc4wp-form-fields input[type="submit"]:hover, .ct-mailchimp1.style2 .mc4wp-form .mc4wp-form-fields input[type="submit"]:focus,
            .ct-header-layout3 .ct-main-menu > li > a::before, .ct-heading .item--sub-title.style-line span::before,
            .ct-spinner3 .double-bounce1, .ct-spinner3 .double-bounce2, .ct-spinner5 > div,
            .site-h3 .ct-blog-carousel-layout2 .ct-slick-carousel[data-arrows="true"] .slick-arrow:hover,
            .btn.btn-dark.btn-icon:hover, .btn.btn-dark.btn-icon:focus, 
            .ct-testimonial-carousel2 .ct-slick-carousel .slick-arrow:hover, .ct-social a,
            .ct-blog-carousel-layout2 .item--featured .item--overlay-more a:hover {
                background-color: ' . esc_attr( $p_primary_color ) . ';
            }';

            echo '.ct-testimonial-carousel2 .item-effect, .ct-testimonial-carousel2 .item-effect span {
                background-color: ' .alico_hex_to_rgba( $p_primary_color, 0.5 ). ';
            }';

            echo '.btn-text:hover span, .ct-tabs--layout1 .ct-tabs-title .ct-tab-title.active,
            .ct-tab-form .wpcf7-form .wpcf7-form-control:not(.wpcf7-submit):focus {
                border-color: ' . esc_attr( $p_primary_color ) . ';
            }';

            echo '.ct-tabs--layout1 .ct-tabs-title .ct-tab-title::before {
                border-color: ' . esc_attr( $p_primary_color ) . ' transparent transparent;
            }';
		} ?>
		@media screen and (max-width: 1199px) {
			<?php if ( ! empty( $p_primary_color ) ) {
				echo '.ct-main-menu > li > a:hover, .ct-main-menu > li > a.current, .ct-main-menu > li.current_page_item > a, .ct-main-menu > li.current-menu-item > a, .ct-main-menu > li.current_page_ancestor > a, .ct-main-menu > li.current-menu-ancestor > a {
	                color: ' . esc_attr( $p_primary_color ) . ';
	            }';

	            echo '.scroll-top, .ct-main-menu .sub-menu li a::before, .ct-main-menu .children li a::before, .btn, .btn.btn-secondary:hover, .btn.btn-secondary:focus, .btn.btn-secondary2:hover, .btn.btn-secondary2:focus,
	            .ct-tabs--layout1 .ct-tabs-title .ct-tab-title.active, 
	            .ct-mailchimp1.style2 .mc4wp-form .mc4wp-form-fields input[type="submit"]:hover, .ct-mailchimp1.style2 .mc4wp-form .mc4wp-form-fields input[type="submit"]:focus,
	            .ct-header-layout3 .ct-main-menu > li > a::before {
	                background-color: ' . esc_attr( $p_primary_color ) . ';
	            }';

	            echo '.btn-text:hover span, .ct-tabs--layout1 .ct-tabs-title .ct-tab-title.active {
	                border-color: ' . esc_attr( $p_primary_color ) . ';
	            }';

	            echo '.ct-tabs--layout1 .ct-tabs-title .ct-tab-title::before {
	                border-color: ' . esc_attr( $p_primary_color ) . ' transparent transparent;
	            }';
			} ?>
		}

		<?php $p_secondary_color = alico_get_page_opt( 'secondary_color' );
		if ( ! empty( $p_secondary_color ) ) {
			echo '#ct-header-wrap .ct-header-topbar1 .ct-header-top-info i, .ct-heading .item--title cite,
			.ct-fancy-box-layout1.style1 .item--title cite,
			.ct-testimonial-grid1 .item-icon i, .ct-testimonial-carousel1 .item-icon i {
                color: ' . esc_attr( $p_secondary_color ) . ';
            }';

			echo '.scroll-top:hover, .scroll-top:focus, .btn:hover, .btn:focus, .btn.btn-secondary, .btn.btn-secondary2,
			.ct-mailchimp1.style2 .mc4wp-form .mc4wp-form-fields input[type="submit"],
			.ct-blog-carousel-layout2 .ct-slick-carousel[data-arrows="true"] .slick-arrow:hover,
			.ct-contact-form-layout1 .ct-range-slider .ui-slider-range,
			.ct-contact-form-layout1 .ct-range-slider .ui-slider-handle {
                background-color: ' . esc_attr( $p_secondary_color ) . ';
            }';
		}

		$p_third_color = alico_get_page_opt( 'third_color' );
		if ( ! empty( $p_third_color ) ) {
			echo '.ct-fancy-box-layout4 .item--title, .ct-offer-carousel1 .item--title,
			.ct-blog-carousel-layout2 .item--title, 
			.ct-contact-form-layout1 .form-title,
			.form-custom-color .ct-contact-form-layout1.style2 .form-icon,
			.form-custom-color .ct-contact-form-layout1 .ct-range-meta label {
                color: ' . esc_attr( $p_third_color ) . ';
            }';

            echo '.rev_slider cite, .revslider-initialised cite, .revslider-initialised cite .rs_splitted_chars {
                color: ' . esc_attr( $p_third_color ) . ' !important;
            }';

            echo '#ct-header-wrap.ct-header-layout2 .ct-main-menu > li > a::before,
            .ct-offer-carousel1 .ct-slick-carousel[data-arrows="true"] .slick-arrow:hover,
            .ct-testimonial-carousel1 .slick-dots li.slick-active button, .ct-testimonial-carousel1 .slick-dots li.slick-active button:focus {
                background-color: ' . esc_attr( $p_third_color ) . ';
            }';

            echo '.ct-testimonial-carousel1 .slick-dots li.slick-active button, .ct-testimonial-carousel1 .slick-dots li.slick-active button:focus {
                box-shadow: 0 0 10px ' .alico_hex_to_rgba( $p_third_color, 0.48 ). ';
            }';

            echo '.revslider-initialised .tp-leftarrow.custom:hover, .revslider-initialised .tp-rightarrow.custom:hover {
                background-color: ' . esc_attr( $p_third_color ) . ' !important;
            }';
          
		}
		/* End Preset */

		/* Custom Css */
		$custom_css = alico_get_opt( 'site_css' );
		if ( ! empty( $custom_css ) ) {
			echo esc_attr( $custom_css );
		}

		return ob_get_clean();
	}
}

new CSS_Generator();