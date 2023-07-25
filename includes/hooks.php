<?php

add_filter('the_title', 'belingogeo_city_title', 99, 1);
add_filter('wp_title', 'belingogeo_city_title', 99, 1);
function belingogeo_city_title( $title ) {

	if(!is_admin()) {
		$title = do_shortcode($title);
	}
	
	return $title;

}

remove_filter('template_redirect','redirect_canonical');

add_action( 'wp_enqueue_scripts', 'belingogeo_ajax_data', 99 );
function belingogeo_ajax_data() {

	if(isset($_SERVER['REQUEST_URI'])) {
		$request_uri = sanitize_url($_SERVER['REQUEST_URI']);
	}else{
		$request_uri = '';
	}

    $object = get_queried_object();
    if(is_object($object)) {
    	$object = get_class($object);
    }else{
    	$object = false;
    }

    $back_url = $request_uri;

    $city = belingoGeo_get_current_city();
    if($city) {
    	$back_url = belingogeo_remove_city_url($request_uri, $city->get_slug());
    }

	wp_localize_script( 'belingo-geo-scripts', 'belingoGeo',
		array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'object_id' => get_queried_object_id(),
			'object' => $object,
			'backurl' => $back_url
		)
	);

}

add_action( 'wp_enqueue_scripts', 'belingo_geo_scripts' );
function belingo_geo_scripts() {

	wp_enqueue_style('belingo-geo', BELINGO_GEO_PLUGIN_URL . '/css/belingoGeo.css', array(), BELINGO_GEO_VERSION);

	if(!wp_script_is('jquery', 'enqueued')) {
        wp_enqueue_script('jquery');
    }
	wp_enqueue_script('belingo-geo-scripts', BELINGO_GEO_PLUGIN_URL . '/js/belingoGeo.js', array('jquery'), BELINGO_GEO_VERSION, true);

}

add_filter( 'rewrite_rules_array', 'belingogeo_rewrite_rules_array' );
function belingogeo_rewrite_rules_array( $rules ) {

	$allow = true;
	$allow = apply_filters('belingogeo_allow_rewrite_rules', $allow, $rules);

	if(!$allow) {
		return $rules;
	}

	$disable_urls = get_option('belingo_geo_basic_disable_url');

	if($disable_urls && $disable_urls == 1) {
		return $rules;
	}

	$belingoGeo_rules = [];
	$belingoGeo_rules_woo_categories = [];
	$belingoGeo_rules_last_woo_rule = 0;

	$args = [
		'posts_per_page' => -1
	];

	$default_city = belingogeo_get_default_city();
	if($default_city) {
		$exclude_default_city = array($default_city->get_id());
		$args['post__not_in'] = $exclude_default_city;
	}

	$cities = belingoGeo_get_cities($args);
	$i = 1;
	foreach($rules as $key => $rule) {
		if(belingogeo_check_disallow_rule($key)) {
			foreach($cities as $city) {
				if($rule == 'index.php?product_cat=$matches[1]' || $rule == 'index.php?product_cat=$matches[1]&paged=$matches[2]') {
					$belingoGeo_rules_woo_categories[$city->get_slug().'/'.$key] = $rule.'&geo_city='.$city->get_slug();
				}else{
					if($rule == 'index.php?product_cat=$matches[1]&cpage=$matches[2]') {
						$belingoGeo_rules_last_woo_rule = $i;
					}
					$belingoGeo_rules[$city->get_slug().'/'.$key] = $rule.'&geo_city='.$city->get_slug();
				}
				$i++;
			}
		}
	}

	if(count($belingoGeo_rules_woo_categories) > 0) {
		$belingoGeo_rules = array_slice($belingoGeo_rules, 0, $belingoGeo_rules_last_woo_rule, true) +
				   $belingoGeo_rules_woo_categories +
				   array_slice($belingoGeo_rules, $belingoGeo_rules_last_woo_rule, count($belingoGeo_rules) - 1, true);
	}

	$belingoGeo_frontpage_rules = belingogeo_rewrite_frontpage($cities);
	$belingoGeo_sitemaps_rules = belingogeo_rewrite_sitemaps($cities);

	$rules = array_merge($belingoGeo_sitemaps_rules,$belingoGeo_frontpage_rules, $belingoGeo_rules, $rules);

	$rules = apply_filters('belingogeo_rewrite_rules_array', $rules);

	return $rules;

}

function belingogeo_generate_links($url, $object) {

	$allow = true;
	$allow = apply_filters('belingogeo_allow_generate_links', $allow, $url, $object);

	if(!$allow) {
		return $url;
	}

	$disable_urls = get_option('belingo_geo_basic_disable_url');
	if($disable_urls) {
		return $url;
	}

	if(is_object($object)) {
		$object_name = get_class($object);
		if($object_name == 'WP_Term') {
			$object_id = $object->term_id;
		}elseif($object_name == 'WP_Post') {
			$object_id = $object->ID;
		}
	}else{
		$object_name = 'WP_Post';
		$object_id = $object;
	}

	$belingo_geo_basic_filter_links_by_url = get_option('belingo_geo_basic_filter_links_by_url');

	if($belingo_geo_basic_filter_links_by_url) {
		if(!get_query_var('geo_city')) {
			return $url;
		}
		$city_slug = get_query_var('geo_city');
	}else{
		$city = belingoGeo_get_current_city();
		if(!$city) {
			return $url;
		}
		$city_slug = $city->get_slug();
	}

	if(!belingogeo_is_exclude($object_id, $object_name)) {
		$url = belingoGeo_append_city_url($url, $city_slug);
	}

	return $url;

}
add_filter( 'page_link', 'belingogeo_generate_links', 10, 2 );
add_filter( 'post_link', 'belingogeo_generate_links', 10, 2 );
add_filter( 'term_link', 'belingogeo_generate_links', 10, 2 );
add_filter( 'post_type_link', 'belingogeo_generate_links', 10, 2 );

?>