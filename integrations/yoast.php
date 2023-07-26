<?php

add_filter('wpseo_metadesc', 'belingo_city_meta', 99);
add_filter('wpseo_metakeywords', 'belingo_city_meta', 99);
add_filter('wpseo_title', 'belingo_city_meta', 99);
add_filter('wpseo_opengraph_desc', 'belingo_city_meta', 99);
add_filter('wpseo_opengraph_title', 'belingo_city_meta', 99);

function belingo_city_meta($s) {

	$s = do_shortcode($s);

	return $s;

}

// filter on add do_shortcode for og:url
// filter on add city in canonical
add_filter('wpseo_opengraph_url', 'belingoGeo_wpseo_opengraph_urls' );
add_filter('wpseo_canonical', 'belingoGeo_wpseo_opengraph_urls');
function belingoGeo_wpseo_opengraph_urls($u) {
	if(get_query_var('geo_city')) {
		return belingoGeo_append_city_url($u, get_query_var('geo_city'));
	}else{
		return $u;
	}
}

add_filter( 'wpseo_schema_webpage', 'belingogeo_wpseo_schema_webpage', 10, 1 );
function belingogeo_wpseo_schema_webpage( $data ) {

	if(isset($data['name'])) {
		$data['name'] = do_shortcode($data['name']);
	}

	if(isset($data['description'])) {
		$data['description'] = do_shortcode($data['description']);
	}

	return $data;

}

?>