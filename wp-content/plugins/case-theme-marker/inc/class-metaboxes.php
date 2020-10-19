<?php

/**
 * 
 */
class CAT_Metaboxes{

	private static $_instance = null;

	public static function instance() {

        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;

    }

	function __construct(){
		add_action('init', array($this, 'init'));
		add_action('add_meta_boxes', array($this, 'add_meta_boxes'), 5);
		add_action('save_post', array($this, 'save_marker_meta'));
	}

	function init(){
		
	}

	function add_meta_boxes(){
		add_meta_box('single-marker-settings', esc_html__('Settings', CAT_TEXT_DOMAIN), array($this, 'single_marker_settings'), 'marker');
	}

	function single_marker_settings(){
		global $post;
        cat_get_template_file_e('admin/single-marker-settings.php', array('marker' => $post));
	}

	function save_marker_meta($post_id){
		if ( !current_user_can( 'edit_post', $post_id ))
    		return;

		if ( isset($_POST['marker_lat']) ) {
			update_post_meta($post_id, 'marker_lat', sanitize_text_field( $_POST['marker_lat']));
		}

		if ( isset($_POST['marker_lng']) ) {
			update_post_meta($post_id, 'marker_lng', sanitize_text_field( $_POST['marker_lng']));
		}

		if ( isset($_POST['marker_zoom']) ) {
			update_post_meta($post_id, 'marker_zoom', sanitize_text_field( $_POST['marker_zoom']));
		}

		if ( isset($_POST['marker_full_address']) ) {
			update_post_meta($post_id, 'marker_full_address', sanitize_text_field( $_POST['marker_full_address']));
		}

		if ( isset($_POST['marker_email']) ) {
			update_post_meta($post_id, 'marker_email', sanitize_text_field( $_POST['marker_email']));
		}
		
		if ( isset($_POST['marker_phone']) ) {
			update_post_meta($post_id, 'marker_phone', sanitize_text_field( $_POST['marker_phone']));
		}

		if ( isset($_POST['marker_hour']) ) {
			update_post_meta($post_id, 'marker_hour', sanitize_text_field( $_POST['marker_hour']));
		}
	}
}

CAT_Metaboxes::instance();