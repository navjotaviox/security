<?php
/**
 * Plugin Name: Case Theme Core
 * Description: Elementor Page Builder Extension.
 * Plugin URI:  http://casethemes.net/
 * Version:     1.0.0
 * Author:      Case-Themes
 * Author URI:  https://themeforest.net/user/case-themes/portfolio
 * Text Domain: case-theme-core
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

define('CT_TEXT_DOMAIN', 'case-theme-core');
define('CT_PATH', plugin_dir_path(__FILE__));
define('CT_URL', plugin_dir_url(__FILE__));

final class Case_Theme_Core {

    const VERSION = '1.0.0';

    const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

    const MINIMUM_PHP_VERSION = '7.0';

    const CT_CATEGORY_NAME = 'case-theme-core';

    const CT_CATEGORY_TITLE = 'Case Theme Core';

    const EMOJI_CONTROL = 'emojionearea';

    const LAYOUT_CONTROL = 'layoutcontrol';

    const ICONS_CONTROL = 'ct_icons';

    const LIST_CONTROL = 'ct_lists';

    const PROGRESSBAR_CONTROL = 'ct_progressbar';

    public $post_metabox = null;

    private static $_instance = null;

    public static function instance() {

        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;

    }

    public function __construct() {
        add_action( 'init', [ $this, 'load_scss_lib' ], 2 );
        add_action( 'init', [ $this, 'i18n' ] );
        add_action( 'plugins_loaded', [ $this, 'init' ] );

        add_action('wp_enqueue_scripts', array($this, 'enqueue'));
        add_action('admin_enqueue_scripts', array($this, 'admin_enqueue'));

        if (!class_exists('EFramework_CPT_Register')) {
            require_once CT_PATH . 'inc/class-cpt-register.php';
            EFramework_CPT_Register::get_instance();
        }

        if (!class_exists('EFramework_CTax_Register')) {
            require_once CT_PATH . 'inc/class-ctax-register.php';
            EFramework_CTax_Register::get_instance();
        }

        if (!class_exists('EFramework_MegaMenu_Register')) {
            require_once CT_PATH . 'inc/mega-menu/class-megamenu.php';
            EFramework_MegaMenu_Register::get_instance();
        }

        if (!class_exists('EFramework_menu_handle')) {
            require_once CT_PATH . 'inc/class-menu-hanlde.php';
        }

        if(!class_exists('CT_Ajax_Handle')){
            require_once CT_PATH . 'inc/class-ajax-handle.php';
        }
    }

    public function i18n() {
        load_plugin_textdomain( CT_TEXT_DOMAIN );

        if (!class_exists('ReduxFramework')) {
            add_action('admin_notices', array($this, 'redux_framework_notice'));
        } else {
            $redux = new ReduxFramework();
            if (!class_exists('CT_Post_Metabox')) {
                require_once CT_PATH . 'inc/class-post-metabox.php';

                if (empty($this->post_metabox)) {
                    $this->post_metabox = new CT_Post_Metabox($redux);
                }
            }
            if (!class_exists('CT_Taxonomy_Meta')) {
                require_once CT_PATH . 'inc/class-taxonomy-meta.php';

                if (empty($this->taxonomy_meta)) {
                    $this->taxonomy_meta = new CT_Taxonomy_Meta($redux);
                }
            }
        }
    }

    public function init() {

        // Check if Elementor installed and activated
        if ( ! did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
            return;
        }

        // Check for required Elementor version
        if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
            return;
        }

        // Check for required PHP version
        if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
            return;
        }

        if (class_exists('ReduxFramework') && !class_exists('CT_Redux_Extensions')) {
            require_once CT_PATH . 'inc/class-redux-extensions.php';
        }

        // Include Helper
        require_once( __DIR__ . '/inc/helpers/resize-image.php' );
        require_once( __DIR__ . '/inc/helpers/common.php' );
        require_once( __DIR__ . '/inc/helpers/widget.php' );

        // Widget Categories
        add_action( 'elementor/elements/categories_registered', [ $this, 'add_elementor_widget_categories' ] );

        // Add Plugin actions
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
        add_action( 'elementor/controls/controls_registered', [ $this, 'init_controls' ] );
    }

    public function load_scss_lib(){
        if (apply_filters('ct_scssc_on', false)) {
            // scss compiler library v0.0.12
            if (!class_exists('scssc')) {
                require_once __DIR__ . '/lib/scss.inc.php';
            }
        }
        if (apply_filters('ct_scss_on', false)) {
            // scss compiler library v0.7.5
            if (!class_exists('\Leafo\ScssPhp\Compiler')) {
                require_once __DIR__ . '/lib/scss/scss.inc.php';
            }
        }
    }

    public function enqueue(){
        /* Scripts */
        wp_register_script('chart-js', CT_URL . 'assets/js/lib/chart.min.js', [ 'jquery' ], '2.9.3');
        wp_register_script('waypoints-lib-js', CT_URL . 'assets/js/lib/waypoints.min.js', [ 'jquery' ], '2.0.5');
        wp_register_script('imagesloaded', CT_URL . 'assets/js/lib/imagesloaded.pkgd.min.js', [ 'jquery' ], '3.1.8');
        wp_register_script('isotope', CT_URL . 'assets/js/lib/isotope.pkgd.min.js', [ 'jquery' ], '3.0.5');
        wp_register_script('counter-lib-js', CT_URL . 'assets/js/lib/counter.min.js', [ 'jquery' ], '');
        wp_register_script('oc-js', CT_URL . 'assets/js/lib/owl.carousel.min.js', [ 'jquery' ], '2.2.1');
        wp_register_script('progressbar-lib-js', CT_URL . 'assets/js/lib/progressbar.min.js', ['jquery'], '0.7.1');
        wp_register_script('easy-pie-chart-lib-js', CT_URL . 'assets/js/lib/easy-pie-chart.js', ['jquery'], '2.1.7');
        wp_enqueue_script('ct-main-js', CT_URL . 'assets/js/main.js', [ 'jquery' ], '1.0.0');
    }

    public function admin_enqueue(){
        wp_enqueue_style('ct-admin-css', CT_URL . 'assets/css/admin.css', [], '1.0.0');
    }

    public function admin_notice_missing_main_plugin() {

        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

        $message = sprintf(
            esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', CT_TEXT_DOMAIN ),
            '<strong>' . esc_html__( 'Elementor Theme Extension', CT_TEXT_DOMAIN ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor Plugin', CT_TEXT_DOMAIN ) . '</strong>'
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

    }

    public function admin_notice_minimum_elementor_version() {

        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

        $message = sprintf(
            esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', CT_TEXT_DOMAIN ),
            '<strong>' . esc_html__( 'Elementor Theme Extension', CT_TEXT_DOMAIN ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor Plugin', CT_TEXT_DOMAIN ) . '</strong>',
            self::MINIMUM_ELEMENTOR_VERSION
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

    }

    public function admin_notice_minimum_php_version() {

        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

        $message = sprintf(
            esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', CT_TEXT_DOMAIN ),
            '<strong>' . esc_html__( 'Elementor Theme Extension', CT_TEXT_DOMAIN ) . '</strong>',
            '<strong>' . esc_html__( 'PHP', CT_TEXT_DOMAIN ) . '</strong>',
            self::MINIMUM_PHP_VERSION
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

    }

    /**
     * Redux Framework notices
     *
     * @since 1.0
     * @access public
     */
    function redux_framework_notice()
    {
        $plugin_name = '<strong>' . esc_html__("Case Theme Core", CT_TEXT_DOMAIN) . '</strong>';
        $redux_name = '<strong>' . esc_html__("Redux Framework", CT_TEXT_DOMAIN) . '</strong>';

        echo '<div class="notice notice-warning is-dismissible">';
        echo '<p>';
        printf(
            esc_html__('%1$s require %2$s installed and activated. Please active %3$s plugin', CT_TEXT_DOMAIN),
            $plugin_name,
            $redux_name,
            $redux_name
        );
        echo '</p>';
        printf('<button type="button" class="notice-dismiss"><span class="screen-reader-text">%s</span></button>', esc_html__('Dismiss this notice.', CT_TEXT_DOMAIN));
        echo '</div>';
    }

    public function init_widgets() {

        // Include Widget files
        require_once( __DIR__ . '/inc/widgets/abstract-class-widget-base.php' );

        if(is_file(get_template_directory() . '/elementor/core/elementor.php')){
            require_once get_template_directory() . '/elementor/core/elementor.php';
        }
    }

    public function init_controls() {

        // Include Control files
        require_once( __DIR__ . '/inc/controls/class-control-emoji.php' );
        require_once( __DIR__ . '/inc/controls/class-control-layout.php' );
        require_once( __DIR__ . '/inc/controls/class-control-icons.php' );
        require_once( __DIR__ . '/inc/controls/class-control-list.php' );
        require_once( __DIR__ . '/inc/controls/class-control-progressbar.php' );

        $controls_manager = \Elementor\Plugin::$instance->controls_manager;

        // Register control
        $controls_manager->register_control( self::EMOJI_CONTROL, new Case_Theme_Core_EmojiOneArea_Control() );
        $controls_manager->register_control( self::LAYOUT_CONTROL, new Case_Theme_Core_Layout_Control() );
        $controls_manager->register_control( self::ICONS_CONTROL, new Case_Theme_Core_Icons_Control() );
        $controls_manager->register_control( self::LIST_CONTROL, new Case_Theme_Core_List_Control() );
        $controls_manager->register_control( self::PROGRESSBAR_CONTROL, new Case_Theme_Core_Progressbar_Control() );
    }

    function add_elementor_widget_categories( $elements_manager ) {

        $categories = apply_filters('ct_add_custom_categories', array(
            array(
                'name' => self::CT_CATEGORY_NAME,
                'title' => __( self::CT_CATEGORY_TITLE, CT_TEXT_DOMAIN ),
                'icon' => 'fa fa-plug',
            ),
        ));

        foreach ($categories as $cat){
            $elements_manager->add_category(
                $cat['name'],
                array(
                    'title' => $cat['title'],
                    'icon' => $cat['icon'],
                )
            );
        }
    }
}

function ct_add_year() { 
    $year = the_date('Y'); 
    return $year;
}
add_shortcode('ct_year', 'ct_add_year'); 

Case_Theme_Core::instance();