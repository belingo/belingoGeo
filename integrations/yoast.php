<?php

add_filter('wpseo_metadesc', 'belingo_city_meta', 99);
add_filter('wpseo_metakeywords', 'belingo_city_meta', 99);
add_filter('wpseo_title', 'belingo_city_meta', 99);
add_filter('wpseo_opengraph_site_name', 'belingo_city_meta', 99);
add_filter('wpseo_opengraph_desc', 'belingo_city_meta', 99);
add_filter('wpseo_opengraph_title', 'belingo_city_meta', 99);
add_filter('wpseo_twitter_description', 'belingo_city_meta', 99);
add_filter('wpseo_twitter_title', 'belingo_city_meta', 99);

function belingo_city_meta($s) {

	$s = do_shortcode($s);

	return $s;

}

// filter on add do_shortcode for og:url
// filter on add city in canonical
add_filter('wpseo_prev_rel_link', 'belingoGeo_wpseo_opengraph_urls', 9999, 1);
add_filter('wpseo_next_rel_link', 'belingoGeo_wpseo_opengraph_urls', 9999, 1);
add_filter('wpseo_opengraph_url', 'belingoGeo_wpseo_opengraph_urls', 9999, 1);
add_filter('wpseo_canonical', 'belingoGeo_wpseo_opengraph_urls', 9999, 1);
function belingoGeo_wpseo_opengraph_urls($u) {

	$current_city = belingogeo_is_city_in_url($u);
	if($current_city) {
		$u = belingogeo_remove_city_url($u, $current_city->get_slug());
	}

	if(get_query_var('geo_city')) {
		$u = belingoGeo_append_city_url($u, get_query_var('geo_city'));
	}

	return $u;

}

add_filter( 'wpseo_schema_webpage', 'belingogeo_wpseo_schema_webpage', 10, 1 );
function belingogeo_wpseo_schema_webpage( $data ) {

	$allow = true;
	$allow = apply_filters('belingogeo_allow_generate_links', $allow, '', '');
	$disable_urls = get_option('belingo_geo_basic_disable_url');

	if($allow && !$disable_urls) {
		if(isset($data['@id'])) {
			$data['@id'] = belingoGeo_append_city_url($data['@id'], get_query_var('geo_city'));
		}

		if(isset($data['url'])) {
			$data['url'] = belingoGeo_append_city_url($data['url'], get_query_var('geo_city'));
		}

		if(isset($data['breadcrumb']['@id'])) {
			$data['breadcrumb']['@id'] = belingoGeo_append_city_url($data['breadcrumb']['@id'], get_query_var('geo_city'));
		}

		if(isset($data['potentialAction'][0]['target'][0])) {
			$data['potentialAction'][0]['target'][0] = belingoGeo_append_city_url($data['potentialAction'][0]['target'][0], get_query_var('geo_city'));
		}
	}

	if(isset($data['name'])) {
		$data['name'] = do_shortcode($data['name']);
	}

	if(isset($data['description'])) {
		$data['description'] = do_shortcode($data['description']);
	}

	return $data;

}

add_filter( 'wpseo_breadcrumb_links', 'belingogeo_rewrite_yoast_breadcrumbs' );
function belingogeo_rewrite_yoast_breadcrumbs( $crumbs ) {

	$allow = apply_filters( 'belingogeo_rewrite_yoast_breadcrumbs', true );

	if( !$allow ) {
		return $crumbs;
	}

	if( is_admin() ) {
		return $crumbs;
	}

	$disable_urls = get_option( 'belingo_geo_basic_disable_url' );
	if( $disable_urls ) {
		return $crumbs;
	}

	$city = belingoGeo_get_current_city();

	if( !$city ) {
		return $crumbs;
	}

	$is_exclude = belingogeo_is_exclude();

	if( is_array( $crumbs ) ) {
		foreach ( $crumbs as $key => $crumb ) {
			if( !$is_exclude ) {
				$crumbs[$key]['url'] = belingoGeo_append_city_url( $crumb['url'], $city->get_slug() );
			}
		}
	}

	if( get_option( 'belingo_geo_basic_show_in_breadcrumbs' ) ) {
		foreach ( $crumbs as $key => $crumb ) {
			if( $key == 1 ) {
				if( !$is_exclude ) {
					$city_crumbs[] = [
						'text' => $city->get_name(),
						'url' => apply_filters( 'belingogeo_yoast_bredcrumbs_city_url', belingoGeo_append_city_url( home_url(), $city->get_slug() ) )
					];
				}
			}
			$city_crumbs[] = $crumb;
		}
		$crumbs = $city_crumbs;
	}

	return $crumbs;
}

add_filter( 'wpseo_sitemap_url', 'belingogeo_wpseo_sitemap_url', 10, 2 );
function belingogeo_wpseo_sitemap_url( $output, $url ) {

	if( empty( $url['loc'] ) ) {
		$output = '';
	}

	return $output;

}

?>