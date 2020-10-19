<?php

/**
 * 
 */
class CAT_Shortcode{

	private static $_instance = null;

	public static function instance() {

        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;

    }

	function __construct(){
		add_action('init', array($this, 'init'));
		add_action( 'wp_ajax_get_search_result_ajax', [$this, 'get_search_result_ajax'] );
		add_action( 'wp_ajax_nopriv_get_search_result_ajax', [$this, 'get_search_result_ajax'] );
	}

	function init(){
		add_shortcode( 'cat_marker_search_form', array($this, 'add_cat_marker_search_form') );
		add_shortcode( 'cat_marker_search_result', array($this, 'add_cat_marker_search_result') );
	}

	function add_cat_marker_search_form($args, $content){
		$args = is_array($args)?$args:[];
		cat_get_template_file_e('marker-search-form.php', $args);
	}

	function add_cat_marker_search_result($args, $content){
		$args = is_array($args)?$args:[];
		cat_get_template_file_e('marker-search-result.php', $args);
	}

	function get_search_result_ajax(){
		try{
            if(isset($_POST['cat_marker_search_lat']) && !empty($_POST['cat_marker_search_lat']) && isset($_POST['cat_marker_search_lng']) && !empty($_POST['cat_marker_search_lng'])){
				$coordinate = [
					$_POST['cat_marker_search_lat'],
					$_POST['cat_marker_search_lng']
				];
				$radius_options = CAT_Settings::get_option('search_within_radius_options', '500,1000,2000,3000,5000');
				$radius_options = explode(',', $radius_options);
				$radius = isset($_REQUEST['radius'])?floatval($_REQUEST['radius']):floatval($radius_options[0]);
				
				$term_id = isset($_POST['marker_category'])?intval($_POST['marker_category']):0;

				$filters = [
					'coordinate' => $coordinate,
					'radius' => $radius,
					'term_id' => $term_id,
				];

				$total = intval(self::get_search_total_result($filters));

				if($total > 0){
					// $markers = self::get_search_result($page, $limit, $filters);

					setcookie("cat_marker_filters", serialize($filters), time() + 1800, COOKIEPATH, COOKIE_DOMAIN);

					$search_result_page = CAT_Settings::get_option('search_result_page', '');
					wp_send_json(array('status' => true, 'url' => get_permalink($search_result_page)));
				}
				else{
					setcookie("cat_marker_filters", null, -1, COOKIEPATH, COOKIE_DOMAIN);

					$search_result_page_not_found_id = CAT_Settings::get_option('search_result_page_not_found', '');
					wp_send_json(array('status' => true, 'url' => get_permalink($search_result_page_not_found_id)));
				}
			}
			else{
				wp_send_json(array('status' => false, 'message' => __("Something went wrong. Please research again!", CAT_TEXT_DOMAIN)));
			}
        }
        catch (Exception $e){
            wp_send_json(array('status' => false, 'message' => $e->getMessage()));
        }
        die;
	}

	public static function get_search_total_result($filters){
		global $wpdb;

		$coordinate = $filters['coordinate'];
		$lat = floatval($coordinate[0]);
		$lng = floatval($coordinate[1]);
		$radius = $filters['radius'];
		$term_id = $filters['term_id'];
		// $query = $wpdb->prepare();
		$query = "SELECT COUNT(*)
					FROM {$wpdb->prefix}posts as p
					INNER JOIN {$wpdb->prefix}postmeta as pm1 ON pm1.post_id = p.id AND pm1.meta_key = 'marker_lat'
					INNER JOIN {$wpdb->prefix}postmeta as pm2 ON pm2.post_id = p.id AND pm2.meta_key = 'marker_lng'
					LEFT JOIN {$wpdb->prefix}term_relationships as tr ON tr.object_id = p.id
					LEFT JOIN {$wpdb->prefix}term_taxonomy as tt ON tt.term_taxonomy_id = tr.term_taxonomy_id
					LEFT JOIN {$wpdb->prefix}terms as t ON t.term_id = tt.term_id
					WHERE (111.111 * DEGREES(ACOS(LEAST(1.0, COS(RADIANS(pm1.meta_value)) * COS(RADIANS({$lat})) * COS(RADIANS(pm2.meta_value - ({$lng}))) + SIN(RADIANS(pm1.meta_value)) * SIN(RADIANS({$lat})))))) < {$radius} AND INSTR(CONCAT(t.term_id), '{$term_id}') > 0";
	 	return $wpdb->get_var($query);
	}

	public static function get_search_result($page = 1, $limit = 10, $filters = []){
		global $wpdb;

		$coordinate = $filters['coordinate'];
		$lat = floatval($coordinate[0]);
		$lng = floatval($coordinate[1]);
		$radius = $filters['radius'];
		$term_id = $filters['term_id'];
		$offset = $limit * ($page - 1);
		$query = "SELECT p.ID, pm1.meta_value as marker_lat, pm2.meta_value as marker_lng, GROUP_CONCAT(t.term_id) as term_ids,
									111.111 *
								    DEGREES(ACOS(LEAST(1.0, COS(RADIANS(pm1.meta_value))
								         * COS(RADIANS({$lat}))
								         * COS(RADIANS(pm2.meta_value - ({$lng})))
								         + SIN(RADIANS(pm1.meta_value))
								         * SIN(RADIANS({$lat}))))) AS distance_in_km
								FROM {$wpdb->prefix}posts as p
								INNER JOIN {$wpdb->prefix}postmeta as pm1 ON pm1.post_id = p.id AND pm1.meta_key = 'marker_lat'
								INNER JOIN {$wpdb->prefix}postmeta as pm2 ON pm2.post_id = p.id AND pm2.meta_key = 'marker_lng'
								LEFT JOIN {$wpdb->prefix}term_relationships as tr ON tr.object_id = p.id
								LEFT JOIN {$wpdb->prefix}term_taxonomy as tt ON tt.term_taxonomy_id = tr.term_taxonomy_id
								LEFT JOIN {$wpdb->prefix}terms as t ON t.term_id = tt.term_id
								GROUP BY p.ID
								HAVING distance_in_km < {$radius} AND INSTR(term_ids, '{$term_id}') > 0
								ORDER BY distance_in_km
								LIMIT {$limit}
								OFFSET {$offset}";
	 	return $wpdb->get_results($query, ARRAY_A);
	}
}

CAT_Shortcode::instance();