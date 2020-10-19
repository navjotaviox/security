<?php

/**
 * 
 */
class CAT_CTAX_Register{

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
	    $labels = apply_filters('cat_ctax_label_register', array(
	        'name'              => __( 'Categories', CAT_TEXT_DOMAIN ),
	        'singular_name'     => __( 'Category', CAT_TEXT_DOMAIN ),
	        'search_items'      => __( 'Search Categories', CAT_TEXT_DOMAIN ),
	        'all_items'         => __( 'All Categories', CAT_TEXT_DOMAIN ),
	        'parent_item'       => __( 'Parent Category', CAT_TEXT_DOMAIN ),
	        'parent_item_colon' => __( 'Parent Category:', CAT_TEXT_DOMAIN ),
	        'edit_item'         => __( 'Edit Category', CAT_TEXT_DOMAIN ),
	        'update_item'       => __( 'Update Category', CAT_TEXT_DOMAIN ),
	        'add_new_item'      => __( 'Add New Category', CAT_TEXT_DOMAIN ),
	        'new_item_name'     => __( 'New Category Name', CAT_TEXT_DOMAIN ),
	        'menu_name'         => __( 'Category', CAT_TEXT_DOMAIN ),
	    ));

	    $args = apply_filters('cat_ctax_args_register', array(
	        'hierarchical'      => true,
	        'labels'            => $labels,
	        'show_ui'           => true,
	        'show_admin_column' => true,
	        'query_var'         => true,
	        'rewrite'           => array( 'slug' => 'marker-category' ),
	    ));
	 
	    register_taxonomy( 'marker-category', array( 'marker' ), $args );
	}
}

CAT_CTAX_Register::instance();