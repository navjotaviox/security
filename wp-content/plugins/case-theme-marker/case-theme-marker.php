<?php
/**
 * Plugin Name: Case Theme Marker
 * Description: Find Marker
 * Plugin URI:  https://themeforest.net/user/case-themes/portfolio
 * Version:     1.0.0
 * Author:      Case-Themes
 * Author URI:  https://themeforest.net/user/case-themes/portfolio
 * Text Domain: case-theme-marker
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

define('CAT_TEXT_DOMAIN', 'case-theme-marker');
define('CAT_PATH', plugin_dir_path(__FILE__));
define('CAT_URL', plugin_dir_url(__FILE__));
define('CAT_PLUGIN_TEMPLATES_PATH', plugin_dir_path(__FILE__) . '/templates');
define('CAT_THEME_TEMPLATES_DIR', 'sw_marker/');

final class CAT_Marker{
	
	private static $_instance = null;
	private $settings = null;

    public static function instance() {

        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;

    }

    public function __construct() {
        add_action( 'init', [ $this, 'i18n' ] );
        add_action( 'plugins_loaded', [ $this, 'init' ] );

        add_action('wp_enqueue_scripts', array($this, 'enqueue'));
        add_action('admin_enqueue_scripts', array($this, 'admin_enqueue'));
    }

    public function i18n() {
        load_plugin_textdomain( CAT_TEXT_DOMAIN );
    }

    public function init() {
    	require_once CAT_PATH . 'inc/helper.php';

    	if (!class_exists('CAT_CPT_Register')) {
            require_once CAT_PATH . 'inc/class-cpt-register.php';
        }
        if (!class_exists('CAT_CTAX_Register')) {
            require_once CAT_PATH . 'inc/class-ctax-register.php';
        }
        if (!class_exists('CAT_Metaboxes')) {
            require_once CAT_PATH . 'inc/class-metaboxes.php';
        }
        if (!class_exists('CAT_Settings')) {
            require_once CAT_PATH . 'inc/class-settings.php';
            $this->settings = CAT_Settings::instance();
        }
        if (!class_exists('CAT_Shortcode')) {
            require_once CAT_PATH . 'inc/class-shortcode.php';
        }
    }

    public function enqueue(){

        /* Scripts */
        if (!wp_script_is ( 'google-map' )) {
            $googleapis = 'https://maps.googleapis.com/maps/api/js?libraries=places';
            if($api_key = $this->settings->get_option('google_maps_api_key')){
                $googleapis = add_query_arg('key', $api_key, $googleapis);
            }

            /* load scripts. */
            wp_enqueue_script( 'google-map', $googleapis, array(), time(), true);
        }
        wp_enqueue_script('cat-uri-js', CAT_URL . 'assets/js/uri.js', [ 'jquery' ], '1.14.1');
        wp_enqueue_script('cat-main-js', CAT_URL . 'assets/js/main.js', [ 'jquery' ], '1.0.0');
        wp_localize_script('cat-main-js', 'cat_ajax_url', admin_url( 'admin-ajax.php' ) );
    }

    public function admin_enqueue(){
        if (!wp_script_is ( 'google-map' )) {
            $googleapis = 'https://maps.googleapis.com/maps/api/js?libraries=places';
            if($api_key = $this->settings->get_option('google_maps_api_key')){
                $googleapis = add_query_arg('key', $api_key, $googleapis);
            }

            /* load scripts. */
            wp_enqueue_script( 'google-map', $googleapis, array(), time(), true);
        }
        wp_enqueue_script( 'markerclusterer', CAT_URL . 'assets/js/markerclusterer.js', array('google-map'), time(), true);
        wp_enqueue_script('rc-map-js', CAT_URL . 'assets/js/geo-location.js', array('google-map'), time(), true);
    }
}

CAT_Marker::instance();