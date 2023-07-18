<?php

add_shortcode('belingogeo_city_field', 'belingogeo_city_field_shortcode');
function belingogeo_city_field_shortcode($atts) {

	$atts = shortcode_atts( [
		'field' => 'city_padej1',
	], $atts );

	$result = '';

	$city = belingoGeo_get_current_city();

	if(!$city) {
		$city = belingogeo_get_default_city();
	}

	if(!$city) {
		$city = belingoGeo_get_city_by('slug', 'default');
	}

	if($city) {
		if($atts['field'] == 'city_name') {
			$result = $city->get_name();
		}elseif($atts['field'] == 'city_slug') {
			$result = $city->get_slug();
		}else{
			$meta = $city->get_meta();
			if(isset($meta[$atts['field']])) {
				$result = $meta[$atts['field']][0];
			}
		}
	}
	
	return apply_filters( 'belingogeo_city_field', $result );

}

add_shortcode("belingogeo_city_content", "belingogeo_city_content_shortcode");
function belingogeo_city_content_shortcode($atts, $content) {

	$atts = shortcode_atts( [
		'city' => '',
	], $atts );

	$result = '';

	$city = belingoGeo_get_current_city();
	$default_city = belingogeo_get_default_city();
	if($city) {
		if($atts['city'] != '' && $atts['city'] == get_query_var('geo_city')) {
			$result = $content;
		}
		if($atts['city'] != '' && !get_query_var('geo_city') && $default_city && $atts['city'] = $default_city->get_slug()) {
			$result = $content;
		}
	}elseif($atts['city'] == '' && !get_query_var('geo_city')) {
		$result = $content;
	}

	return apply_filters( 'belingogeo_city_content', $result );

}

add_shortcode("belingogeo_select_city", "belingoGeo_select_city_shortcode");
function belingoGeo_select_city_shortcode($atts) {

	$atts = shortcode_atts( [
		'show' => '',
	], $atts );

	if(!empty($atts['show'])) {
		if($atts['show'] == 'mobile' && !wp_is_mobile()) {
			return;
		}
		if($atts['show'] == 'desktop' && wp_is_mobile()) {
			return;
		}
	}

	$data = [];

	$args = [
        'posts_per_page' => -1,
        'orderby' => 'name',
        'order' => 'asc'
    ];

    $args = apply_filters('belingogeo_popup_cities_args', $args);

    $data['cities'] = belingoGeo_get_cities($args);

	ob_start();
	belingogeo_load_template('select_city.php', $data);
	$content = ob_get_contents();
	ob_end_clean();
	return $content;

}

/**
*
* Next are deprecated shortcodes, they will be removed soon
*
*/

add_shortcode("city", "belingoGeo_city_shortcode");
function belingoGeo_city_shortcode() {
	return do_shortcode('[belingogeo_city_field field="city_name"]');
}

add_shortcode("widget_city", "belingoGeo_widget_city_shortcode");
function belingoGeo_widget_city_shortcode() {
	return do_shortcode('[belingogeo_city_field field="city_name"]');
}

add_shortcode("city_field", "belingoGeo_city_field_shortcode_deprecated");
function belingoGeo_city_field_shortcode_deprecated($atts) {
	return belingogeo_city_field_shortcode($atts);
}

add_shortcode("city_content", "belingoGeo_city_content_shortcode_deprecated");
function belingoGeo_city_content_shortcode_deprecated($atts, $content) {
	return belingogeo_city_content_shortcode($atts, $content);
}

add_shortcode("city_padej1", "belingoGeo_city_padej1_shortcode");
function belingoGeo_city_padej1_shortcode() {
	return do_shortcode('[belingogeo_city_field field="city_padej1"]');
}

add_shortcode("city_padej2", "belingoGeo_city_padej2_shortcode");
function belingoGeo_city_padej2_shortcode() {
	return do_shortcode('[belingogeo_city_field field="city_padej2"]');
}

add_shortcode("city_padej3", "belingoGeo_city_padej3_shortcode");
function belingoGeo_city_padej3_shortcode() {
	return do_shortcode('[belingogeo_city_field field="city_padej3"]');
}

add_shortcode("city_phone", "belingoGeo_city_phone_shortcode");
function belingoGeo_city_phone_shortcode() {
	return do_shortcode('[belingogeo_city_field field="city_phone"]');
}

add_shortcode("city_address", "belingoGeo_city_address_shortcode");
function belingoGeo_city_address_shortcode() {
	return do_shortcode('[belingogeo_city_field field="city_address"]');
}

add_shortcode("cities_addon_contacts", "belingoGeo_cities_addon_contacts_shortcode");
function belingoGeo_cities_addon_contacts_shortcode() {
	
	$city = belingoGeo_get_current_city();

	if($city) {
		$city_addon_contacts = json_decode(get_post_meta($city->get_id(),'city_addon_contacts',true));

		foreach ($city_addon_contacts as $key => $value) {
			$result[] = [
				"addon_contact_name" => base64_decode($value->addon_contact_name),
				"addon_contact_phone" => base64_decode($value->addon_contact_phone),
				"addon_contact_address" => base64_decode($value->addon_contact_address),
				"addon_contact_time" => base64_decode($value->addon_contact_time)
			];
		}

		ob_start();

		if(file_exists(get_template_directory() . '/belingogeo/cities_addon_contacts.php')) {
			include_once( get_template_directory() . '/belingogeo/cities_addon_contacts.php' );
		}else{
			include_once( WP_PLUGIN_DIR . '/belingogeo/templates/cities_addon_contacts.php' );
		}

		$result = ob_get_contents();
		ob_end_clean();
		
		return $result;

	}
	return '';
}

add_shortcode("select_city", "belingoGeo_select_city_shortcode_deprecated");
function belingoGeo_select_city_shortcode_deprecated() {
	return do_shortcode('[belingogeo_select_city]');
}

?>