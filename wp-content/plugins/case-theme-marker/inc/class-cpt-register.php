<?php

/**
 * 
 */
class CAT_CPT_Register{

	private static $_instance = null;

	public static function instance() {

        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;

    }

	function __construct(){
		add_action('init', array($this, 'init'));
	}

	function init(){
		$labels = apply_filters('cat_cpt_label_register', array(
	        'name'                  => __( 'Marker', CAT_TEXT_DOMAIN ),
	        'singular_name'         => __( 'Marker', CAT_TEXT_DOMAIN ),
	        'menu_name'             => __( 'Markers', CAT_TEXT_DOMAIN ),
	        'name_admin_bar'        => __( 'Marker', CAT_TEXT_DOMAIN ),
	        'add_new'               => __( 'Add New', CAT_TEXT_DOMAIN ),
	        'add_new_item'          => __( 'Add New Marker', CAT_TEXT_DOMAIN ),
	        'new_item'              => __( 'New Marker', CAT_TEXT_DOMAIN ),
	        'edit_item'             => __( 'Edit Marker', CAT_TEXT_DOMAIN ),
	        'view_item'             => __( 'View Marker', CAT_TEXT_DOMAIN ),
	        'all_items'             => __( 'All Markers', CAT_TEXT_DOMAIN ),
	        'search_items'          => __( 'Search Markers', CAT_TEXT_DOMAIN ),
	        'parent_item_colon'     => __( 'Parent Markers:', CAT_TEXT_DOMAIN ),
	        'not_found'             => __( 'No markers found.', CAT_TEXT_DOMAIN ),
	        'not_found_in_trash'    => __( 'No markers found in Trash.', CAT_TEXT_DOMAIN ),
	        'featured_image'        => __( 'Marker Cover Image', CAT_TEXT_DOMAIN ),
	        'set_featured_image'    => __( 'Set cover image', CAT_TEXT_DOMAIN ),
	        'remove_featured_image' => __( 'Remove cover image', CAT_TEXT_DOMAIN ),
	        'use_featured_image'    => __( 'Use as cover image', CAT_TEXT_DOMAIN ),
	        'archives'              => __( 'Marker archives', CAT_TEXT_DOMAIN ),
	        'insert_into_item'      => __( 'Insert into marker', CAT_TEXT_DOMAIN ),
	        'uploaded_to_this_item' => __( 'Uploaded to this marker', CAT_TEXT_DOMAIN ),
	        'filter_items_list'     => __( 'Filter markers list', CAT_TEXT_DOMAIN ),
	        'items_list_navigation' => __( 'Markers list navigation', CAT_TEXT_DOMAIN ),
	        'items_list'            => __( 'Markers list', CAT_TEXT_DOMAIN ),
	    ));

	    $args = apply_filters('cat_cpt_args_register', array(
	        'labels'             => $labels,
	        'public'             => true,
	        'publicly_queryable' => true,
	        'show_ui'            => true,
	        'show_in_menu'       => true,
	        'menu_icon' 		 => 'dashicons-location-alt',
	        'query_var'          => true,
	        'rewrite'            => array( 'slug' => 'marker' ),
	        'capability_type'    => 'post',
	        'has_archive'        => true,
	        'hierarchical'       => false,
	        'menu_position'      => null,
	        'supports'           => array( 'title' ),
	    ));

	    register_post_type( 'marker', $args );
	}
}

CAT_CPT_Register::instance();