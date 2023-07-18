<?php

add_filter('wpseo_metadesc', 'belingo_city_meta', 99);
add_filter('wpseo_metakeywords', 'belingo_city_meta', 99);
add_filter('wpseo_title', 'belingo_city_meta', 99);
add_filter('wpseo_opengraph_desc', 'belingo_city_meta', 99);
add_filter('wpseo_opengraph_title', 'belingo_city_meta', 99);

function belingo_city_meta($s) {

	if(preg_match('/\[belingogeo_city_field field="([^"]*)"\]/', $s, $matches)) {
		$shortcode_replace = do_shortcode('[belingogeo_city_field field="'.$matches[1].'"]');
		$s = preg_replace('/\[belingogeo_city_field field="([^"]*)"\]/', $shortcode_replace, $s);
	}

	if(preg_match('/\[belingogeo_city_content\]([^\[]*)\[\/belingogeo_city_content\]/', $s, $matches)) {
		$shortcode_replace = do_shortcode('[belingogeo_city_content]'.$matches[1].'[/belingogeo_city_content]');
		$s = preg_replace('/\[belingogeo_city_content\]([^\[]*)\[\/belingogeo_city_content\]/', $shortcode_replace, $s);
	}

	if(preg_match('/\[belingogeo_city_content city="([^"]*)"\]([^\[]*)\[\/belingogeo_city_content\]/', $s, $matches)) {
		$shortcode_replace = do_shortcode('[belingogeo_city_content city="'.$matches[1].'"]'.$matches[2].'[/belingogeo_city_content]');
		$s = preg_replace('/\[belingogeo_city_content city="([^"]*)"\]([^\[]*)\[\/belingogeo_city_content\]/', $shortcode_replace, $s);
	}

	// deprecated shortcodes
	$s = str_replace('[city]', do_shortcode('[city]'), $s);
	$s = str_replace('[city_padej1]', do_shortcode('[city_padej1]'), $s);
	$s = str_replace('[city_padej2]', do_shortcode('[city_padej2]'), $s);
	$s = str_replace('[city_padej3]', do_shortcode('[city_padej3]'), $s);
	$s = str_replace('[city_phone]', do_shortcode('[city_phone]'), $s);
	$s = str_replace('[city_address]', do_shortcode('[city_address]'), $s);

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

?>