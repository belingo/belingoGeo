function belingogeo_show_popup_window(window_id) {
	var popup_window = document.getElementById(window_id);
	if( !popup_window.classList.contains('bg-popup-visible') ) {
		popup_window.style.top = (window.pageYOffset) + 'px';
		popup_window.classList.add('bg-popup-visible');
	}else{
		popup_window.classList.remove('bg-popup-visible');
	}
}

function belingogeo_preloader_city_list() {
	document.querySelector('.quick-locations__values__container').innerHTML = '<div style="padding:30px 0;text-align:center;"><svg xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" width="100px" height="100px" viewBox="0 0 128 128" xml:space="preserve"><path fill="#a0a1a7" d="M64.4 16a49 49 0 0 0-50 48 51 51 0 0 0 50 52.2 53 53 0 0 0 54-52c-.7-48-45-55.7-45-55.7s45.3 3.8 49 55.6c.8 32-24.8 59.5-58 60.2-33 .8-61.4-25.7-62-60C1.3 29.8 28.8.6 64.3 0c0 0 8.5 0 8.7 8.4 0 8-8.6 7.6-8.6 7.6z"><animateTransform attributeName="transform" type="rotate" from="0 64 64" to="360 64 64" dur="1800ms" repeatCount="indefinite"></animateTransform></path></svg></div>';
}

function belingogeo_preloadCities() {
	belingogeo_show_popup_window('cityChange');
	belingogeo_preloader_city_list();
	belingogeo_loadCities();
}

function belingogeo_register_events() {
	var bg_close_popup_btns = document.querySelectorAll('.popup-window-close-icon');
	bg_close_popup_btns.forEach(el => {
		el.addEventListener('click', function(e) {
			e.preventDefault();
			belingogeo_show_popup_window(el.parentElement.id);
		});
	});

	var geoChangeCity = document.querySelector('#geolocationChangeCity');
	if( geoChangeCity ) {
		geoChangeCity.addEventListener('click', function(e) {
			e.preventDefault();
			belingogeo_preloadCities();
		});
	}

	var geoChangeCityClass = document.querySelector('.geolocationChangeCity');
	if( geoChangeCityClass ) {
		geoChangeCityClass.addEventListener('click', function(e) {
			e.preventDefault();
			belingogeo_preloadCities();
		});
	}
	var geoChangeCityLink = document.querySelector('.geolocation__link');
	if( geoChangeCityLink ) {
		geoChangeCityLink.addEventListener('click', function(e) {
			e.preventDefault();
			belingogeo_preloadCities();
		});
	}

}

async function belingogeo_getWidgetCity() {
  try {
    const response = await fetch(belingoGeo.ajaxurl, {
	  method: "post",
	  headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
	  body: 'action=get_widget_city'
	});
    if (!response.ok) {
      throw new Error('Response status: ' + response.status);
    }
    const result = await response.text();
    document.querySelector('.geolocation__value').innerHTML = result;
  } catch (error) {
    console.error(error.message);
  }
}

async function belingogeo_selectGeoCity(city_name, city_name_orig) {
  try {
    const response = await fetch(belingoGeo.ajaxurl, {
	  method: "post",
	  headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
	  body: 'action=write_city_cookie&city_name=' + city_name + '&city_name_orig=' + city_name_orig + '&back_url=' + belingoGeo.backurl + '&object_id=' + belingoGeo.object_id + '&object=' + belingoGeo.object
	});
    if (!response.ok) {
      throw new Error('Response status: ' + response.status);
    }
    const result = await response.json();
    location.href = result.redirect;
  } catch (error) {
    console.error(error.message);
  }
}

async function belingogeo_selectNoGeo() {
  try {
    const response = await fetch(belingoGeo.ajaxurl, {
	  method: "post",
	  headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
	  body: 'action=write_nogeo_cookie&back_url=' + belingoGeo.backurl
	});
    if (!response.ok) {
      throw new Error('Response status: ' + response.status);
    }
    const result = await response.json();
    location.href = result.redirect;
  } catch (error) {
    console.error(error.message);
  }
}


async function belingogeo_showQuestionCity() {
  try {
    const response = await fetch(belingoGeo.ajaxurl, {
	  method: "post",
	  headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
	  body: 'action=show_city_question&back_url=' + belingoGeo.backurl + '&object_id=' + belingoGeo.object_id + '&object=' + belingoGeo.object
	});
    if (!response.ok) {
      throw new Error('Response status: ' + response.status);
    }
    const result = await response.json();
    if(result.redirect) {
			location.href = result.redirect;
	}else{
		var geo_with_question = document.querySelector('.geolocation_with_question__link');
		if( result.show_question && geo_with_question ) {
			geo_with_question.insertAdjacentHTML('afterend', result.show_question);
		}
		belingogeo_register_events();
	}
  } catch (error) {
    console.error(error.message);
  }
}

async function belingogeo_loadCities() {
  try {
    const response = await fetch(belingoGeo.ajaxurl, {
	  method: "post",
	  headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
	  body: 'action=load_cities'
	});
    if (!response.ok) {
      throw new Error('Response status: ' + response.status);
    }
    const result = await response.text();
    document.querySelector('.quick-locations__values__container').innerHTML = result;
    var selectGeoCity = document.querySelectorAll('.select_geo_city');
	if( selectGeoCity ) {
		selectGeoCity.forEach( el => {
			el.addEventListener('click', function(e) {
				e.preventDefault();
				var city_name = el.getAttribute('data-name');
				var city_name_orig = el.getAttribute('data-name-orig');
				belingogeo_selectGeoCity(city_name, city_name_orig);
			});
		});
	}
	var selectNoGeo = document.querySelector('.continue-without-geo');
	selectNoGeo.addEventListener('click', function(e) {
		e.preventDefault();
		belingogeo_selectNoGeo();
	});
  } catch (error) {
    console.error(error.message);
  }
}

document.addEventListener('DOMContentLoaded', function() {

	belingogeo_getWidgetCity();
	belingogeo_showQuestionCity();

});