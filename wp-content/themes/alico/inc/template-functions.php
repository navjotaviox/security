<?php
/**
 * Helper functions for the theme
 *
 * @package Alico
 */

/**
 * Get Post List 
*/
if(!function_exists('alico_list_post')){
    function alico_list_post($post_type = 'post', $default = false){
        $post_list = array();
        $posts = get_posts(array('post_type' => $post_type,'posts_per_page' => '-1'));
        foreach($posts as $post){
            $post_list[$post->ID] = $post->post_title;
        }
        return $post_list;
    }
}

/**
 * Get theme option based on its id.
 *
 * @param  string $opt_id Required. the option id.
 * @param  mixed $default Optional. Default if the option is not found or not yet saved.
 *                         If not set, false will be used
 *
 * @return mixed
 */
function alico_get_opt( $opt_id, $default = false ) {
	$opt_name = alico_get_opt_name();
	if ( empty( $opt_name ) ) {
		return $default;
	}

	global ${$opt_name};
	if ( ! isset( ${$opt_name} ) || ! isset( ${$opt_name}[ $opt_id ] ) ) {
		$options = get_option( $opt_name );
	} else {
		$options = ${$opt_name};
	}
	if ( ! isset( $options ) || ! isset( $options[ $opt_id ] ) || $options[ $opt_id ] === '' ) {
		return $default;
	}
	if ( is_array( $options[ $opt_id ] ) && is_array( $default ) ) {
		foreach ( $options[ $opt_id ] as $key => $value ) {
			if ( isset( $default[ $key ] ) && $value === '' ) {
				$options[ $opt_id ][ $key ] = $default[ $key ];
			}
		}
	}

	return $options[ $opt_id ];
}

/**
 * Get theme option based on its id.
 *
 * @param  string $opt_id Required. the option id.
 * @param  mixed $default Optional. Default if the option is not found or not yet saved.
 *                         If not set, false will be used
 *
 * @return mixed
 */
function alico_get_page_opt( $opt_id, $default = false ) {
	$page_opt_name = alico_get_page_opt_name();
	if ( empty( $page_opt_name ) ) {
		return $default;
	}
	$id = get_the_ID();
	if ( ! is_archive() && is_home() ) {
		if ( ! is_front_page() ) {
			$page_for_posts = get_option( 'page_for_posts' );
			$id             = $page_for_posts;
		}
	}

	// Get page option for Shop Page
    if(class_exists('WooCommerce') && is_shop()){
        $id = get_option( 'woocommerce_shop_page_id' );
    }

	return $options = ! empty($id) ? get_post_meta( intval( $id ), $opt_id, true ) : $default;
}

/**
 *
 * Get post format values.
 *
 * @param $post_format_key
 * @param bool $default
 *
 * @return bool|mixed
 */
function alico_get_post_format_value( $post_format_key, $default = false ) {
	global $post;

	return $value = ! empty( $post->ID ) ? get_post_meta( $post->ID, $post_format_key, true ) : $default;
}


/**
 * Get opt_name for Redux Framework options instance args and for
 * getting option value.
 *
 * @return string
 */
function alico_get_opt_name_default(){
	return apply_filters( 'alico_opt_name', 'ct_theme_options' );
}

function alico_get_opt_name() {
	if(isset($_POST['opt_name']) && !empty($_POST['opt_name'])){
		return $_POST['opt_name'];
	}
	$opt_name = alico_get_opt_name_default();
	if(defined('ICL_LANGUAGE_CODE')){
		if(ICL_LANGUAGE_CODE != 'all' && !empty(ICL_LANGUAGE_CODE)){
			$opt_name = $opt_name.'_'.ICL_LANGUAGE_CODE;
		}
	}
	return $opt_name;
}

/**
 * Get opt_name for Redux Framework options instance args and for
 * getting option value.
 *
 * @return string
 */
function alico_get_page_opt_name() {
	return apply_filters( 'alico_page_opt_name', 'ct_page_options' );
}

/**
 * Get opt_name for Redux Framework options instance args and for
 * getting option value.
 *
 * @return string
 */
function alico_get_post_opt_name() {
	return apply_filters( 'alico_post_opt_name', 'alico_post_options' );
}

/**
 * Get page title and description.
 *
 * @return array Contains 'title'
 */
function alico_get_page_titles() {
	$title = '';

	// Default titles
	if ( ! is_archive() ) {
		// Posts page view
		if ( is_home() ) {
			// Only available if posts page is set.
			if ( ! is_front_page() && $page_for_posts = get_option( 'page_for_posts' ) ) {
				$title = get_post_meta( $page_for_posts, 'custom_title', true );
				if ( empty( $title ) ) {
					$title = get_the_title( $page_for_posts );
				}
			}
			if ( is_front_page() ) {
				$title = esc_html__( 'Blog', 'alico' );
			}
		} // Single page view
        elseif ( is_page() ) {
			$title = get_post_meta( get_the_ID(), 'custom_title', true );
			if ( ! $title ) {
				$title = get_the_title();
			}
		} elseif ( is_404() ) {
			$title = esc_html__( '404', 'alico' );
		} elseif ( is_search() ) {
			$title = esc_html__( 'Search results', 'alico' );
		} else {
			$title = get_post_meta( get_the_ID(), 'custom_title', true );
			if ( ! $title ) {
				$title = get_the_title();
			}
		}
	} else {
		$title = get_the_archive_title();
		if( (class_exists( 'WooCommerce' ) && is_shop()) ) {
			$title = get_post_meta( wc_get_page_id('shop'), 'custom_title', true );
			if(!$title) {
				$title = get_the_title( get_option( 'woocommerce_shop_page_id' ) );
			}
		}
	}

	return array(
		'title' => $title,
	);
}

add_filter( 'get_the_archive_title', 'alico_archive_title_remove_label' );
function alico_archive_title_remove_label( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = get_the_author();
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	} elseif ( is_tax() ) {
		$title = single_term_title( '', false );
	} elseif ( is_home() ) {
		$title = single_post_title( '', false );
	}

	return $title;
}

/**
 * Generates an excerpt from the post content with custom length.
 * Default length is 55 words, same as default the_excerpt()
 *
 * The excerpt words amount will be 55 words and if the amount is greater than
 * that, then the string '&hellip;' will be appended to the excerpt. If the string
 * is less than 55 words, then the content will be returned as it is.
 *
 * @param int $length Optional. Custom excerpt length, default to 55.
 * @param int|WP_Post $post Optional. You will need to provide post id or post object if used outside loops.
 *
 * @return string           The excerpt with custom length.
 */
function alico_get_the_excerpt( $length = 55, $post = null ) {
	$post = get_post( $post );

	if ( empty( $post ) || 0 >= $length ) {
		return '';
	}

	if ( post_password_required( $post ) ) {
		return esc_html__( 'Post password required.', 'alico' );
	}

	$content = apply_filters( 'the_content', strip_shortcodes( $post->post_content ) );
	$content = str_replace( ']]>', ']]&gt;', $content );

	$excerpt_more = apply_filters( 'alico_excerpt_more', '&hellip;' );
	$excerpt      = wp_trim_words( $content, $length, $excerpt_more );

	return $excerpt;
}


/**
 * Check if provided color string is valid color.
 * Only supports 'transparent', HEX, RGB, RGBA.
 *
 * @param  string $color
 *
 * @return boolean
 */
function alico_is_valid_color( $color ) {
	$color = preg_replace( "/\s+/m", '', $color );

	if ( $color === 'transparent' ) {
		return true;
	}

	if ( '' == $color ) {
		return false;
	}

	// Hex format
	if ( preg_match( "/(?:^#[a-fA-F0-9]{6}$)|(?:^#[a-fA-F0-9]{3}$)/", $color ) ) {
		return true;
	}

	// rgb or rgba format
	if ( preg_match( "/(?:^rgba\(\d+\,\d+\,\d+\,(?:\d*(?:\.\d+)?)\)$)|(?:^rgb\(\d+\,\d+\,\d+\)$)/", $color ) ) {
		preg_match_all( "/\d+\.*\d*/", $color, $matches );
		if ( empty( $matches ) || empty( $matches[0] ) ) {
			return false;
		}

		$red   = empty( $matches[0][0] ) ? $matches[0][0] : 0;
		$green = empty( $matches[0][1] ) ? $matches[0][1] : 0;
		$blue  = empty( $matches[0][2] ) ? $matches[0][2] : 0;
		$alpha = empty( $matches[0][3] ) ? $matches[0][3] : 1;

		if ( $red < 0 || $red > 255 || $green < 0 || $green > 255 || $blue < 0 || $blue > 255 || $alpha < 0 || $alpha > 1.0 ) {
			return false;
		}
	} else {
		return false;
	}

	return true;
}

/**
 * Minify css
 *
 * @param  string $css
 *
 * @return string
 */
function alico_css_minifier( $css ) {
	// Normalize whitespace
	$css = preg_replace( '/\s+/', ' ', $css );
	// Remove spaces before and after comment
	$css = preg_replace( '/(\s+)(\/\*(.*?)\*\/)(\s+)/', '$2', $css );
	// Remove comment blocks, everything between /* and */, unless
	// preserved with /*! ... */ or /** ... */
	$css = preg_replace( '~/\*(?![\!|\*])(.*?)\*/~', '', $css );
	// Remove ; before }
	$css = preg_replace( '/;(?=\s*})/', '', $css );
	// Remove space after , : ; { } */ >
	$css = preg_replace( '/(,|:|;|\{|}|\*\/|>) /', '$1', $css );
	// Remove space before , ; { } ( ) >
	$css = preg_replace( '/ (,|;|\{|}|\(|\)|>)/', '$1', $css );
	// Strips leading 0 on decimal values (converts 0.5px into .5px)
	$css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );
	// Strips units if value is 0 (converts 0px to 0)
	$css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );
	// Converts all zeros value into short-hand
	$css = preg_replace( '/0 0 0 0/', '0', $css );
	// Shortern 6-character hex color codes to 3-character where possible
	$css = preg_replace( '/#([a-f0-9])\\1([a-f0-9])\\2([a-f0-9])\\3/i', '#\1\2\3', $css );

	return trim( $css );
}

/**
 * Header Tracking Code to wp_head hook.
 */
function alico_header_code() {
	$site_header_code = alico_get_opt( 'site_header_code' );
	if ( $site_header_code !== '' ) {
		print wp_kses( $site_header_code, wp_kses_allowed_html() );
	}
}

add_action( 'wp_head', 'alico_header_code' );

/**
 * Footer Tracking Code to wp_footer hook.
 */
function alico_footer_code() {
	$site_footer_code = alico_get_opt( 'site_footer_code' );
	if ( $site_footer_code !== '' ) {
		print wp_kses( $site_footer_code, wp_kses_allowed_html() );
	}
}

add_action( 'wp_footer', 'alico_footer_code' );

/**
 * Custom Comment List
 */
function alico_comment_list( $comment, $args, $depth ) {
	if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
	?>
    <<?php echo ''.$tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
		<?php endif; ?>
		    <div class="comment-inner">
		        <?php if ($args['avatar_size'] != 0) echo get_avatar($comment, 90); ?>
		        <div class="comment-content">
		            <h4 class="comment-title">
		            	<?php printf( '%s', get_comment_author_link() ); ?>
		            </h4>
		            <div class="comment-meta">
		            	<span class="comment-date">
	                        <?php echo get_comment_date().' - '.get_comment_time(); ?>
	                    </span>
		            </div>
		            <div class="comment-text"><?php comment_text(); ?></div>
		            <div class="comment-reply">
						<?php comment_reply_link( array_merge( $args, array(
							'add_below' => $add_below,
							'depth'     => $depth,
							'max_depth' => $args['max_depth']
						) ) ); ?>
		            </div>
		        </div>
		    </div>
		<?php if ( 'div' != $args['style'] ) : ?>
        </div>
	<?php endif;
}

function alico_comment_reply_text( $link ) {
$link = str_replace( 'Reply', '<span>'.esc_attr__('Reply', 'alico').'</span>', $link );
return $link;
}
add_filter( 'comment_reply_link', 'alico_comment_reply_text' );

/**
 * Add field subtitle to post.
 */
function alico_add_subtitle_field() {
	global $post;

	$screen = get_current_screen();

	if ( in_array( $screen->id, array( 'acm-post' ) ) ) {

		$value = get_post_meta( $post->ID, 'post_subtitle', true );

		echo '<div class="subtitle"><input type="text" name="post_subtitle" value="' . esc_attr( $value ) . '" id="subtitle" placeholder = "' . esc_attr__( 'Subtitle', 'alico' ) . '" style="width: 100%;margin-top: 4px;"></div>';
	}
}

add_action( 'edit_form_after_title', 'alico_add_subtitle_field' );

/**
 * Save custom theme meta
 */
function alico_save_meta_boxes( $post_id ) {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( isset( $_POST['post_subtitle'] ) ) {
		update_post_meta( $post_id, 'post_subtitle', $_POST['post_subtitle'] );
	}
}

add_action( 'save_post', 'alico_save_meta_boxes' );


add_filter( 'ct_extra_post_types', 'alico_add_posttype' );
function alico_add_posttype( $postypes ) {
	$portfolio_slug = alico_get_opt( 'portfolio_slug', 'portfolio' );
	$portfolio_name = alico_get_opt( 'portfolio_name', esc_html__('Portfolio', 'alico') );
	$postypes['portfolio'] = array(
		'status' => true,
		'item_name'  => $portfolio_name,
		'items_name' => $portfolio_name,
		'args'       => array(
			'rewrite'             => array(
                'slug'       => $portfolio_slug,
 		 	),
		),
	);

	$service_slug = alico_get_opt( 'service_slug', 'service' );
	$service_name = alico_get_opt( 'service_name', esc_html__('Services', 'alico') );
	$postypes['service'] = array(
		'status'     => true,
		'item_name'  => $service_name,
		'items_name' => $service_name,
		'args'       => array(
			'menu_icon'          => 'dashicons-hammer',
			'supports'           => array(
				'title',
				'thumbnail',
				'editor',
			),
			'public'             => true,
			'publicly_queryable' => true,
			'rewrite'             => array(
                'slug'       => $service_slug
 		 	),
		),
		'labels'     => array()
	);

	$postypes['footer'] = array(
		'status'     => true,
		'item_name'  => esc_html__( 'Footers', 'alico' ),
		'items_name' => esc_html__( 'Footers', 'alico' ),
		'args'       => array(
			'menu_icon'          => 'dashicons-editor-insertmore',
			'supports'           => array(
				'title',
				'editor',
			),
			'public'             => true,
			'publicly_queryable' => true,
		),
		'labels'     => array()
	);

	return $postypes;
}

add_filter( 'ct_extra_taxonomies', 'alico_add_tax' );
function alico_add_tax( $taxonomies ) {

	$portfolio_category_slug = alico_get_opt( 'portfolio_category_slug', 'portfolio-category' );
	$portfolio_category_name = alico_get_opt( 'portfolio_category_name', esc_html__('Portfolio Categories', 'alico') );
	$taxonomies['portfolio-category'] = array(
		'status'     => true,
		'post_type'  => array( 'portfolio' ),
		'taxonomy'   => $portfolio_category_name,
		'taxonomies' => $portfolio_category_name,
		'args'       => array(
			'rewrite'             => array(
                'slug'       => $portfolio_category_slug
 		 	),
		),
		'labels'     => array()
	);

	$service_category_slug = alico_get_opt( 'service_category_slug', 'service-category' );
	$service_category_name = alico_get_opt( 'service_category_name', esc_html__('Service Categories', 'alico') );
	$taxonomies['service-category'] = array(
		'status'     => true,
		'post_type'  => array( 'service' ),
		'taxonomy' => $service_category_name,
		'taxalicomy'   => $service_category_name,
		'taxonomies' => $service_category_name,
		'args'       => array(
			'rewrite'             => array(
                'slug'       => $service_category_slug
 		 	),
		),
		'labels'     => array()
	);
	
	return $taxonomies;
}

add_filter( 'ct_enable_megamenu', 'alico_enable_megamenu' );
function alico_enable_megamenu() {
	return false;
}
add_filter( 'ct_enable_onepage', 'alico_enable_onepage' );
function alico_enable_onepage() {
	return false;
}

/* Add default pagram Carousel */
function alico_get_param_carousel( $atts ) {
	$default  = array(
		'col_xs'           => '1',
		'col_sm'           => '2',
		'col_md'           => '3',
		'col_lg'           => '4',
		'col_xl'           => '4',
		'col_xxl'           => '4',
		'margin'           => '30',
		'loop'             => 'false',
		'autoplay'         => 'false',
		'autoplay_timeout' => '5000',
		'smart_speed'      => '250',
		'center'           => 'false',
		'stage_padding'    => '0',
		'arrows'           => 'false',
		'bullets'          => 'false',
	);
	$new_data = array_merge( $default, $atts );
	extract( $new_data );
	$carousel      = array(
		'data-item-xs' => $col_xs,
		'data-item-sm' => $col_sm,
		'data-item-md' => $col_md,
		'data-item-lg' => $col_lg,
		'data-item-xl' => $col_xl,
		'data-item-xxl' => $col_xxl,

		'data-margin'          => $margin,
		'data-loop'            => $loop,
		'data-autoplay'        => $autoplay,
		'data-autoplaytimeout' => $autoplay_timeout,
		'data-smartspeed'      => $smart_speed,
		'data-center'          => $center,
		'data-arrows'          => $arrows,
		'data-bullets'         => $bullets,
		'data-stagepadding'    => $stage_padding,
		'data-rtl'             => is_rtl() ? 'true' : 'false',
	);
	$carousel_data = '';
	foreach ( $carousel as $key => $value ) {
		if ( isset( $value ) ) {
			$carousel_data .= $key . '=' . $value . ' ';
		}
	}
	$new_data['carousel_data'] = $carousel_data;

	return $new_data;
}

/* Show/hide CMS Carousel */
add_filter( 'enable_ct_carousel', 'alico_enable_ct_carousel' );
function alico_enable_ct_carousel() {
	return false;
}

/*
 * Set post views count using post meta
 */
function alico_set_post_views( $postID ) {
	$countKey = 'post_views_count';
	$count    = get_post_meta( $postID, $countKey, true );
	if ( $count == '' ) {
		$count = 0;
		delete_post_meta( $postID, $countKey );
		add_post_meta( $postID, $countKey, '0' );
	} else {
		$count ++;
		update_post_meta( $postID, $countKey, $count );
	}
}

/* Create Demo Data */
add_filter('ct_ie_export_mode', 'alico_enable_export_mode');
function alico_enable_export_mode()
{
    return false;
}
/* Dashboard Theme */
add_filter('ct_documentation_link',function(){
     return 'http://casethemes.net/docs/alico/';
});
add_filter('ct_video_tutorial_link',function(){
     return 'https://www.youtube.com/watch?v=Rn01dtgefP0';
});

add_action( 'elementor/editor/before_enqueue_scripts', function() {
    wp_enqueue_style( 'alico-elementor-custom-editor', get_template_directory_uri() . '/assets/css/elementor-custom-editor.css', array(), '1.0.0' );
} );

if(class_exists("Case_Theme_Core")){
	if(!function_exists("alico_add_icons_to_ct_iconpicker_field")){
		add_filter("redux_ct_iconpicker_field/get_icons", "alico_add_icons_to_ct_iconpicker_field");
		function alico_add_icons_to_ct_iconpicker_field($icons){
			$custom_icons = [
				'Flaticon' => array(
                    array('flaticon-home' => 'flaticon-home'),
                    array('flaticon-umbrella' => 'flaticon-umbrella'),
                    array('flaticon-menu' => 'flaticon-menu'),
                    array('flaticon-portfolio' => 'flaticon-portfolio'),
                    array('flaticon-newspaper' => 'flaticon-newspaper'),
                    array('flaticon-letter' => 'flaticon-letter'),
                    array('flaticon-sheet' => 'flaticon-sheet'),
                    array('flaticon-icon-56763' => 'flaticon-icon-56763'),
                    array('flaticon-icon-25283' => 'flaticon-icon-25283'),
                    array('flaticon-shield' => 'flaticon-shield'),
                    array('flaticon-get-money' => 'flaticon-get-money'),
                    array('flaticon-credit-card' => 'flaticon-credit-card'),
                    array('flaticon-value' => 'flaticon-value'),
                    array('flaticon-start-button' => 'flaticon-start-button'),
                    array('flaticon-target' => 'flaticon-target'),
                    array('flaticon-group' => 'flaticon-group'),
                    array('flaticon-refresh' => 'flaticon-refresh'),
                    array('flaticon-tick' => 'flaticon-tick'),
                    array('flaticon-home-2' => 'flaticon-home-2'),
                    array('flaticon-car' => 'flaticon-car'),
                    array('flaticon-walk' => 'flaticon-walk'),
                    array('flaticon-statistics' => 'flaticon-statistics'),
                    array('flaticon-icon-user' => 'flaticon-icon-user'),
                    array('flaticon-telephone-call' => 'flaticon-telephone-call'),
                    array('flaticon-envelope' => 'flaticon-envelope'),
                    array('flaticon-square-box' => 'flaticon-square-box'),
                    array('flaticon-telephone' => 'flaticon-telephone'),
                    array('flaticon-garage' => 'flaticon-garage'),
                    array('flaticon-insurance' => 'flaticon-insurance'),
                    array('flaticon-insurance-1' => 'flaticon-insurance-1'),
                    array('flaticon-lifesaver' => 'flaticon-lifesaver'),
                    array('flaticon-umbrella-1' => 'flaticon-umbrella-1'),
                    array('flaticon-diamond-ring' => 'flaticon-diamond-ring'),
                    array('flaticon-water-1' => 'flaticon-water-1'),
                    array('flaticon-analytics' => 'flaticon-analytics'),
                    array('flaticon-analytics-1' => 'flaticon-analytics-1'),
                    array('flaticon-company' => 'flaticon-company'),
                    array('flaticon-customer' => 'flaticon-customer'),
                    array('flaticon-presentation' => 'flaticon-presentation'),
                    array('flaticon-quality' => 'flaticon-quality'),
                    array('flaticon-settings' => 'flaticon-settings'),
                    array('flaticon-maps-and-flags' => 'flaticon-maps-and-flags'),
                    array('flaticon-phone' => 'flaticon-phone'),
                    array('flaticon-plus' => 'flaticon-plus'),
                    array('flaticon-external-link-symbol' => 'flaticon-external-link-symbol'),
                    array('flaticon-login' => 'flaticon-login'),
                    array('flaticon-claim' => 'flaticon-claim'),
                    array('flaticon-tracking' => 'flaticon-tracking'),
                    array('flaticon-pen-tool' => 'flaticon-pen-tool'),
                    array('flaticon-icon-684872' => 'flaticon-icon-684872'),
                    array('flaticon-save-money' => 'flaticon-save-money'),
                    array('flaticon-dot' => 'flaticon-dot'),
                ),
			];
			$icons = array_merge($custom_icons, $icons);
			return $icons;
		}
	}

	if(!function_exists("alico_add_icons_to_megamenu")){
		add_filter("ct_mega_menu/get_icons", "alico_add_icons_to_megamenu");
		function alico_add_icons_to_megamenu($icons){
			$custom_icons = [
				'Flaticon' => array(
                    array('flaticon-home' => 'flaticon-home'),
                    array('flaticon-umbrella' => 'flaticon-umbrella'),
                    array('flaticon-menu' => 'flaticon-menu'),
                    array('flaticon-portfolio' => 'flaticon-portfolio'),
                    array('flaticon-newspaper' => 'flaticon-newspaper'),
                    array('flaticon-letter' => 'flaticon-letter'),
                    array('flaticon-sheet' => 'flaticon-sheet'),
                    array('flaticon-icon-56763' => 'flaticon-icon-56763'),
                    array('flaticon-icon-25283' => 'flaticon-icon-25283'),
                    array('flaticon-shield' => 'flaticon-shield'),
                    array('flaticon-get-money' => 'flaticon-get-money'),
                    array('flaticon-credit-card' => 'flaticon-credit-card'),
                    array('flaticon-value' => 'flaticon-value'),
                    array('flaticon-start-button' => 'flaticon-start-button'),
                    array('flaticon-target' => 'flaticon-target'),
                    array('flaticon-group' => 'flaticon-group'),
                    array('flaticon-refresh' => 'flaticon-refresh'),
                    array('flaticon-tick' => 'flaticon-tick'),
                    array('flaticon-home-2' => 'flaticon-home-2'),
                    array('flaticon-car' => 'flaticon-car'),
                    array('flaticon-walk' => 'flaticon-walk'),
                    array('flaticon-statistics' => 'flaticon-statistics'),
                    array('flaticon-icon-user' => 'flaticon-icon-user'),
                    array('flaticon-telephone-call' => 'flaticon-telephone-call'),
                    array('flaticon-envelope' => 'flaticon-envelope'),
                    array('flaticon-square-box' => 'flaticon-square-box'),
                    array('flaticon-telephone' => 'flaticon-telephone'),
                    array('flaticon-garage' => 'flaticon-garage'),
                    array('flaticon-insurance' => 'flaticon-insurance'),
                    array('flaticon-insurance-1' => 'flaticon-insurance-1'),
                    array('flaticon-lifesaver' => 'flaticon-lifesaver'),
                    array('flaticon-umbrella-1' => 'flaticon-umbrella-1'),
                    array('flaticon-diamond-ring' => 'flaticon-diamond-ring'),
                    array('flaticon-water-1' => 'flaticon-water-1'),
                    array('flaticon-analytics' => 'flaticon-analytics'),
                    array('flaticon-analytics-1' => 'flaticon-analytics-1'),
                    array('flaticon-company' => 'flaticon-company'),
                    array('flaticon-customer' => 'flaticon-customer'),
                    array('flaticon-presentation' => 'flaticon-presentation'),
                    array('flaticon-quality' => 'flaticon-quality'),
                    array('flaticon-settings' => 'flaticon-settings'),
                    array('flaticon-maps-and-flags' => 'flaticon-maps-and-flags'),
                    array('flaticon-phone' => 'flaticon-phone'),
                    array('flaticon-plus' => 'flaticon-plus'),
                    array('flaticon-external-link-symbol' => 'flaticon-external-link-symbol'),
                    array('flaticon-login' => 'flaticon-login'),
                    array('flaticon-claim' => 'flaticon-claim'),
                    array('flaticon-tracking' => 'flaticon-tracking'),
                    array('flaticon-pen-tool' => 'flaticon-pen-tool'),
                    array('flaticon-icon-684872' => 'flaticon-icon-684872'),
                    array('flaticon-save-money' => 'flaticon-save-money'),
                    array('flaticon-dot' => 'flaticon-dot'),
                ),
			];
			$icons = array_merge($custom_icons, $icons);
			return $icons;
		}
	}
}