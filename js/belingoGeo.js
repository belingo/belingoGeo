function show_popup_window(window_id) {
	var window_width = jQuery(window).width();
	var margin_top = parseInt(jQuery(window_id).height())/2;
	var margin_left = parseInt(jQuery(window_id).width())/2;
	jQuery(window_id).css('margin-top', -margin_top);
	if(window_width >= 787) {
		jQuery(window_id).css('margin-left', -margin_left);
	}else{
		jQuery(window_id).css('left', 'auto');
	}
	jQuery(window_id).show();
	jQuery('.popup-window-overlay').show();
}

jQuery(document).ready(function() {

	var data = { 
		action: 'get_widget_city'
	}
	jQuery.post(belingoGeo.ajaxurl, data, function(response) {
		jQuery('#geolocation__value').html(response);
	});

	var data = { 
		action: 'show_city_question',
		back_url: belingoGeo.backurl
	}
	jQuery.post(belingoGeo.ajaxurl, data, function(question) {
		jQuery('#geolocationChangeCity').after(question);
	});

	jQuery(document).on('click','.select_geo_city', function(e) {

		e.preventDefault();

		city_name = jQuery(this).data('name');
		city_name_orig = jQuery(this).data('name-orig');

		var data = { 
			action: 'write_city_cookie',
			city_name: city_name,
			city_name_orig: city_name_orig,
			object_id: belingoGeo.object_id,
			object: belingoGeo.object,
			back_url: belingoGeo.backurl
		}
		jQuery.post(belingoGeo.ajaxurl, data, function(response) {
			location.href = response.redirect;
		});
	});

	jQuery(document).on('click','.continue-without-geo', function(e) {
		e.preventDefault();
		var data = { 
			action: 'write_nogeo_cookie',
			back_url: belingoGeo.backurl
		}
		jQuery.post(belingoGeo.ajaxurl, data, function(response) {
			location.href = response.redirect;
		});
	});

	jQuery(document).on('click','#geolocationChangeCity, .geolocationChangeCity', function() {
		show_popup_window('#cityChange');
		var data = {
			action: 'load_cities'
		}
		jQuery.post(belingoGeo.ajaxurl, data, function(response) {
			jQuery('.quick-locations__values__container').html(response);
		});
	});

	jQuery(document).on('click','.popup-window-close-icon', function() {
    	jQuery('.popup-window').hide();
    	jQuery('.popup-window-overlay').hide();
	});

});