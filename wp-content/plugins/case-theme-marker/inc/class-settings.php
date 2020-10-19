<?php

/**
 * 
 */
class CAT_Settings{

	private static $_instance = null;

	public static function instance() {

        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;

    }

	function __construct(){
		add_action('init', array($this, 'init'));
		add_action( 'admin_menu', [$this, 'settings'] );
	}

	function init(){
		if(is_admin() && isset($_POST['marker_settings'])){
			update_option('marker_settings', $_POST['marker_settings']);
		}
	}

	function settings(){
		add_submenu_page(
			"edit.php?post_type=marker",
			__("Settings", CAT_TEXT_DOMAIN),
			__("Settings", CAT_TEXT_DOMAIN),
			"manage_options",
			"marker-settings",
			[$this, 'settings_page'],
			9999
		);
	}

	function settings_page(){
		cat_get_template_file_e('admin/settings.php', ['settings' => $this]);
	}

	public static function get_option( $name, $default = false ) {
		$option = get_option( 'marker_settings' );

		if ( false === $option ) {
			return $default;
		}

		if ( isset( $option[$name] ) ) {
			return $option[$name];
		} else {
			return $default;
		}
	}
}