<?php
$settings_page = 'belingo_geo_settings.php';

add_action('admin_menu', 'belingoGeo_rewrite_rules_settings');
function belingoGeo_rewrite_rules_settings() {

	$menu_name = 'BelingoGeo';
	$menu_name = apply_filters('belingogeo_menu_settings_name', $menu_name);

	add_menu_page( __('BelingoGeo plugin settings', 'belingogeo'), $menu_name, 'edit_others_posts', 'belingo_geo_settings.php', 'belingo_geo_function', plugins_url( 'belingogeo/images/logo_mini_20x20.png' ), 6 );
	add_submenu_page( 'belingo_geo_settings.php', __('Regions', 'belingogeo'), __('Regions', 'belingogeo'), 'edit_others_posts', '/edit-tags.php?taxonomy=bg_regions&post_type=cities');
	add_submenu_page( 'belingo_geo_settings.php', __('BelingoGeo plugin settings', 'belingogeo'), __('Settings', 'belingogeo'), 'edit_others_posts', 'belingo_geo_settings.php');
	add_submenu_page( 'belingo_geo_settings.php', __('Woo Price', 'belingogeo'), __('Woo Price', 'belingogeo'), 'edit_others_posts', 'belingogeo_woo_price', 'belingogeo_woo_price_func');
	add_submenu_page( 'belingo_geo_settings.php', __('Import', 'belingogeo'), __('Import', 'belingogeo'), 'edit_others_posts', 'belingogeo_import', 'belingogeo_import_func');
	add_submenu_page( 'belingo_geo_settings.php', __('Export', 'belingogeo'), __('Export', 'belingogeo'), 'edit_others_posts', 'belingogeo_export', 'belingogeo_export_func');
	add_submenu_page( 'belingo_geo_settings.php', __('About plugin', 'belingogeo'), __('About plugin', 'belingogeo'), 'edit_others_posts', 'belingo_geo_about.php', 'belingo_geo_about_function');
}

add_action('admin_init', 'belingogeo_download_example');
function belingogeo_download_example() {

	if(isset($_GET['page']) && $_GET['page'] == 'belingogeo_import' && isset($_GET['example'])) {
		$example = BELINGO_GEO_PLUGIN_DIR.'/examples/'.sanitize_text_field($_GET['example']);
		belingogeo_download_csv_file($example);
		exit;
	}

}

function belingogeo_woo_price_func($arr) {

	echo '<div class="wrap">';
	echo '<h1 class="wp-heading-inline">'.__('Woo Price', 'belingogeo').'</h1>';
	echo '<p>'.__('In this section, you can manage prices in WooCommerce for each city separately.').'</p>';
	if (is_plugin_active('belingogeopro/belingoGeoPro.php')) {
		if(function_exists('belingogeopro_woo_price_func')) {
			belingogeopro_woo_price_func();
		}else{
			echo '<p style="color:red;">'.__('You need to update the Pro extension to version 1.10 or higher', 'belingogeo').'</p>';
		}
	}else{
		echo '<p style="color:red;">'.__('Only available for Pro version', 'belingogeo').'</p>';
	}
	echo '</div>';

}

function belingogeo_import_func($arr) {

	echo '<div class="wrap">';
	echo '<h1 class="wp-heading-inline">'.__('Import', 'belingogeo').'</h1>';
	echo '<p>';
	echo str_replace( '<a>', '<a href="admin.php?page=belingogeo_import&example=example1.csv">', __('Upload a list of cities in CSV format, <a>download</a> an example file.', 'belingogeo') );
	echo '<br>';
	echo str_replace( '<a>', '<a href="admin.php?page=belingogeo_import&example=all_cities_rf.csv">', __('All cities of Russia - <a>download</a>', 'belingogeo') );
	echo '</p>';
	echo '<p style="color:red;">'.__('Attention! Loading all cities at once can be difficult and depends on the settings and limitations of your hosting provider. In this case, we recommend splitting the file into several parts.', 'belingogeo').'</p>';
	if (is_plugin_active('belingogeopro/belingoGeoPro.php')) {
		if(function_exists('belingogeopro_import_func')) {
			belingogeopro_import_func();
		}else{
			echo '<p style="color:red;">'.__('You need to update the Pro extension to version 1.9 or higher', 'belingogeo').'</p>';
		}
	}else{
		echo '<p style="color:red;">'.__('Only available for Pro version', 'belingogeo').'</p>';
	}
	echo '</div>';

}

function belingogeo_export_func($arr) {

	echo '<div class="wrap">';
	echo '<h1 class="wp-heading-inline">'.__('Export', 'belingogeo').'</h1>';
	if (is_plugin_active('belingogeopro/belingoGeoPro.php')) {
		if(function_exists('belingogeopro_export_func')) {
			belingogeopro_export_func();
		}else{
			echo '<p style="color:red;">'.__('You need to update the Pro extension to version 1.9 or higher', 'belingogeo').'</p>';
		}
	}else{
		echo '<p style="color:red;">'.__('Only available for Pro version', 'belingogeo').'</p>';
	}
	echo '</div>';

}

function belingo_geo_about_function($arr) {

	echo '<div class="wrap">';
	echo '<h1 class="wp-heading-inline">'.__('About plugin', 'belingogeo').'</h1> ';
	if (!is_plugin_active('belingogeopro/belingoGeoPro.php')) {
		echo '<a target="_blank" href="https://belingo.ru/products/belingogeo-pro/?utm_source=plugin_belingogeo&utm_medium=pro" class="page-title-action">'.__('Go Pro', 'belingogeo').'</a>';
	}
	echo '<p>'.__('The plugin adds the ability to select cities, unique pages are created with a unique url for each city. This allows you to make content unique to search engines.', 'belingogeo').'</p>';
	echo '<h2>'.__('Useful articles', 'belingogeo').'</h2>';
	echo '<div><a target="_blank" href="https://belingo.ru/ustanovka-i-nastrojka-plagina-belingogeo/?utm_source=plugin_belingogeo&utm_medium=description">'.__('Installing and configuring the belingoGeo plugin', 'belingogeo').'</a></div>';
	echo '<div><a target="_blank" href="https://belingo.ru/kak-sortirovat-goroda-v-plagine-belingogeo/?utm_source=plugin_belingogeo&utm_medium=description">'.__('How to sort cities in belingoGeo plugin?', 'belingogeo').'</a></div>';
	echo '<div><a target="_blank" href="https://belingo.ru/kak-sozdat-dopolnitelnoe-pole-dlya-goroda-v-plagine-belingogeo/?utm_source=plugin_belingogeo&utm_medium=description">'.__('How to create an additional field for the city in the belingoGeo plugin?', 'belingogeo').'</a></div>';
	echo '<div><a target="_blank" href="https://belingo.ru/kak-vyvesti-ssylku-dlya-pereklyucheniya-goroda-v-lyubom-meste-sajta/?utm_source=plugin_belingogeo&utm_medium=description">'.__('How to display a link to switch cities anywhere on the site', 'belingogeo').'</a></div>';
	echo '<div><a target="_blank" href="https://belingo.ru/opisanie-vsex-nastroek-plagina-belingogeo/?utm_source=plugin_belingogeo&utm_medium=description">'.__('Description of all settings of the BelingoGeo plugin', 'belingogeo').'</a></div>';
	echo '<div><a target="_blank" href="https://belingo.ru/nastrojka-plagina-belingogeo-v-rezhime-poddomenov/?utm_source=plugin_belingogeo&utm_medium=description">'.__('Setting up the BelingoGeo plugin in the "city in a subdomain" mode', 'belingogeo').'</a></div>';
	echo '<div><a target="_blank" href="https://belingo.ru/opisanie-shortkodov-plagina-belingogeo/?utm_source=plugin_belingogeo&utm_medium=description">'.__('Description of shortcodes of the BelingoGeo plugin', 'belingogeo').'</a></div>';

	echo '<h2>'.__('Support', 'belingogeo').'</h2>';
	echo '<div><a target="_blank" href="https://belingo.ru">https://belingo.ru</a> '.__('- Our website.', 'belingogeo').'</div>';
	echo '<div><a target="_blank" href="mailto: support@belingo.ru">support@belingo.ru</a> '.__('- E-mail for communication with technical support specialists.', 'belingogeo').'</div>';

	echo '<h2>'.__('We are on social networks', 'belingogeo').'</h2>';
	echo '<div class="social_networks">
					<a href="https://t.me/belingollc" target="_blank" rel="nofollow">
						<svg width="35px" height="35px" viewBox="0 0 256 256" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M128,0 C57.307,0 0,57.307 0,128 L0,128 C0,198.693 57.307,256 128,256 L128,256 C198.693,256 256,198.693 256,128 L256,128 C256,57.307 198.693,0 128,0 L128,0 Z" fill="#40B3E0"> </path> <path d="M190.2826,73.6308 L167.4206,188.8978 C167.4206,188.8978 164.2236,196.8918 155.4306,193.0548 L102.6726,152.6068 L83.4886,143.3348 L51.1946,132.4628 C51.1946,132.4628 46.2386,130.7048 45.7586,126.8678 C45.2796,123.0308 51.3546,120.9528 51.3546,120.9528 L179.7306,70.5928 C179.7306,70.5928 190.2826,65.9568 190.2826,73.6308" fill="#FFFFFF"> </path> <path d="M98.6178,187.6035 C98.6178,187.6035 97.0778,187.4595 95.1588,181.3835 C93.2408,175.3085 83.4888,143.3345 83.4888,143.3345 L161.0258,94.0945 C161.0258,94.0945 165.5028,91.3765 165.3428,94.0945 C165.3428,94.0945 166.1418,94.5735 163.7438,96.8115 C161.3458,99.0505 102.8328,151.6475 102.8328,151.6475" fill="#D2E5F1"> </path> <path d="M122.9015,168.1154 L102.0335,187.1414 C102.0335,187.1414 100.4025,188.3794 98.6175,187.6034 L102.6135,152.2624" fill="#B5CFE4"> </path> </g> </g></svg>
					</a>
					<a href="https://vk.com/itbelingo" target="_blank" rel="nofollow">
						<svg width="35px" height="35px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <circle cx="512" cy="512" r="512" style="fill:#2787f5"></circle> <path d="M585.83 271.5H438.17c-134.76 0-166.67 31.91-166.67 166.67v147.66c0 134.76 31.91 166.67 166.67 166.67h147.66c134.76 0 166.67-31.91 166.67-166.67V438.17c0-134.76-32.25-166.67-166.67-166.67zm74 343.18h-35c-13.24 0-17.31-10.52-41.07-34.62-20.71-20-29.87-22.74-35-22.74-7.13 0-9.17 2-9.17 11.88v31.57c0 8.49-2.72 13.58-25.12 13.58-37 0-78.07-22.4-106.93-64.16-43.45-61.1-55.33-106.93-55.33-116.43 0-5.09 2-9.84 11.88-9.84h35c8.83 0 12.22 4.07 15.61 13.58 17.31 49.9 46.17 93.69 58 93.69 4.41 0 6.45-2 6.45-13.24v-51.6c-1.36-23.76-13.92-25.8-13.92-34.28 0-4.07 3.39-8.15 8.83-8.15h55c7.47 0 10.18 4.07 10.18 12.9v69.58c0 7.47 3.39 10.18 5.43 10.18 4.41 0 8.15-2.72 16.29-10.86 25.12-28.17 43.11-71.62 43.11-71.62 2.38-5.09 6.45-9.84 15.28-9.84h35c10.52 0 12.9 5.43 10.52 12.9-4.41 20.37-47.18 80.79-47.18 80.79-3.73 6.11-5.09 8.83 0 15.61 3.73 5.09 16 15.61 24.1 25.12 14.94 17 26.48 31.23 29.53 41.07 3.45 9.84-1.65 14.93-11.49 14.93z" style="fill:#fff"></path> </g></svg>
					</a>
					<a href="https://dzen.ru/belingo" target="_blank" rel="nofollow">
						<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="35" height="35" viewBox="0 0 50 50">
						<path d="M46.894 23.986c.004 0 .007 0 .011 0 .279 0 .545-.117.734-.322.192-.208.287-.487.262-.769C46.897 11.852 38.154 3.106 27.11 2.1c-.28-.022-.562.069-.77.262-.208.192-.324.463-.321.746C26.193 17.784 28.129 23.781 46.894 23.986zM46.894 26.014c-18.765.205-20.7 6.202-20.874 20.878-.003.283.113.554.321.746.186.171.429.266.679.266.03 0 .061-.001.091-.004 11.044-1.006 19.787-9.751 20.79-20.795.025-.282-.069-.561-.262-.769C47.446 26.128 47.177 26.025 46.894 26.014zM22.823 2.105C11.814 3.14 3.099 11.884 2.1 22.897c-.025.282.069.561.262.769.189.205.456.321.734.321.004 0 .008 0 .012 0 18.703-.215 20.634-6.209 20.81-20.875.003-.283-.114-.555-.322-.747C23.386 2.173 23.105 2.079 22.823 2.105zM3.107 26.013c-.311-.035-.555.113-.746.321-.192.208-.287.487-.262.769.999 11.013 9.715 19.757 20.724 20.792.031.003.063.004.094.004.25 0 .492-.094.678-.265.208-.192.325-.464.322-.747C23.741 32.222 21.811 26.228 3.107 26.013z"></path>
						</svg>
					</a>
				</div>';

	echo '</div>';
	echo '<h2>'.__('Our other plugins', 'belingogeo').'</h2>';
	echo '<div><a href="https://belingo.ru/products/belingoantispam/?utm_source=plugin_belingogeo&utm_medium=description" target="_blank">Belingo Antispam</a> - '.__('A simple and effective anti-spam plugin for WordPress. The plugin\'s algorithm analyzes user behavior on the site and, if necessary, marks it as spam.', 'belingogeo').'</div>';
	echo '<div><a href="https://belingo.ru/products/belingocredit/?utm_source=plugin_belingogeo&utm_medium=description" target="_blank">Belingo Credit</a> - '.__('A very simple calculator to place on any page of your website using a shortcode. Annuity or differentiated calculation method. For any period and with any interest rate.', 'belingogeo').'</div>';

}

function belingo_geo_function($arr) {
	global $settings_page;

	flush_rewrite_rules();

	$belingogeo_version = '';
	$belingogeo_version = apply_filters('belingogeo_settings_version', $belingogeo_version);

	echo '<div class="wrap">';
	echo '<h1 class="wp-heading-inline">'.__('Belingo Geo Settings', 'belingogeo').' <sup style="color:green;">'.$belingogeo_version.'</sup></h1>';
	if (!is_plugin_active('belingogeopro/belingoGeoPro.php')) {
		echo '<a target="_blank" href="https://belingo.ru/products/belingogeo-pro/?utm_source=plugin_belingogeo&utm_medium=pro" class="page-title-action">'.__('Go Pro', 'belingogeo').'</a>';
	}
	echo '<form method="post" action="options.php" enctype="multipart/form-data">';
	settings_fields('belingo_geo_excludes');
	do_settings_sections($settings_page);
	submit_button();
	echo '</form>';

	echo '</div>';
}

add_action( 'admin_notices', 'belingo_geo_custom_admin_notices' );
function belingo_geo_custom_admin_notices() {
 	global $settings_page;
	if(isset( $_GET[ 'page' ] ) && $settings_page == $_GET[ 'page' ] && isset( $_GET[ 'settings-updated' ] ) && true == $_GET[ 'settings-updated' ]) {
		echo '<div class="notice notice-success is-dismissible"><p>'.__('Settings have been saved', 'belingogeo').'</p></div>';
	}
 
}

function belingo_geo_settings() {
	global $settings_page;
	register_setting( 'belingo_geo_excludes', 'belingo_geo_exclude_posts' );
	register_setting( 'belingo_geo_excludes', 'belingo_geo_exclude_post_types' );
	register_setting( 'belingo_geo_excludes', 'belingo_geo_exclude_pages' );
	register_setting( 'belingo_geo_excludes', 'belingo_geo_exclude_terms' );
	register_setting( 'belingo_geo_excludes', 'belingo_geo_exclude_tags' );
	register_setting( 'belingo_geo_excludes', 'belingo_geo_exclude_taxonomies' );
	register_setting( 'belingo_geo_excludes', 'belingo_geo_basic_default_nonecity' );
	//register_setting( 'belingo_geo_excludes', 'belingo_geo_basic_disable_url' );
	//register_setting( 'belingo_geo_excludes', 'belingo_geo_basic_redirect_page' );
	register_setting( 'belingo_geo_excludes', 'belingo_geo_basic_finding_nonecity' );
	register_setting( 'belingo_geo_excludes', 'belingo_geo_sitemap_per_page');
	register_setting( 'belingo_geo_excludes', 'belingo_geo_exclude_nonobject');
	register_setting( 'belingo_geo_excludes', 'belingo_geo_basic_show_in_breadcrumbs');
	register_setting( 'belingo_geo_excludes', 'belingo_geo_url_type');
	register_setting( 'belingo_geo_excludes', 'belingo_geo_basic_forced_confirmation_city');
	register_setting( 'belingo_geo_excludes', 'belingo_geo_basic_default_text_nonecity');
	register_setting( 'belingo_geo_excludes', 'belingo_geo_basic_filter_links_by_url');
	register_setting( 'belingo_geo_excludes', 'belingo_geo_basic_forced_slug_generation');
	register_setting( 'belingo_geo_excludes', 'belingo_geo_basic_forced_region_slug_generation');
	register_setting( 'belingo_geo_excludes', 'belingo_geo_basic_woo_auto_detect_city_checkout');
	register_setting( 'belingo_geo_excludes', 'belingo_geo_basic_enable_search_in_popup');
	register_setting( 'belingo_geo_excludes', 'belingo_geo_basic_add_city_to_woo_page_title');
	register_setting( 'belingo_geo_excludes', 'belingo_geo_basic_popup_window_header');
	register_setting( 'belingo_geo_excludes', 'belingo_geo_basic_popup_window_text1');
	register_setting( 'belingo_geo_excludes', 'belingo_geo_basic_popup_window_text2');
	register_setting( 'belingo_geo_excludes', 'belingo_geo_basic_enable_windows_in_footer');
	register_setting( 'belingo_geo_excludes', 'belingo_geo_exclude_all_posts');
	register_setting( 'belingo_geo_excludes', 'belingo_geo_exclude_all_pages');
	add_settings_section( 'belingo_geo_basic', __('Basic', 'belingogeo'), '', $settings_page );
	add_settings_section( 'belingo_geo_excludes', __('Exceptions', 'belingogeo'), '', $settings_page );

	add_settings_field( 
		'belingo_geo_url_type', 
		__('Link type', 'belingogeo'), 
		'belingo_geo_display_settings', 
		$settings_page, 
		'belingo_geo_basic', 
		array( 
			'type'      => 'radio',
			'option_name' => 'belingo_geo_url_type',
			'descr' 	=> '',
			'options' => [
				[
					"label" => __('URLs disabled (the plugin will not generate virtual links)', 'belingogeo'),
					"value" => "disabled",
					"disabled" => false
				],
				[
					"label" => __('City in subdirectory (the link will look like this: example.com/samara/)', 'belingogeo'),
					"value" => "subdirectory",
					"disabled" => false
				],
				[
					"label" => __('City in subdomain (the link will look like this: samara.example.com)', 'belingogeo'),
					"value" => "subdomain",
					"disabled" => true,
					"help" => "https://belingo.ru/nastrojka-plagina-belingogeo-v-rezhime-poddomenov/?utm_source=plugin_belingogeo&utm_medium=settings"
				],
				[
					"label" => __('Multisite (switching between sites, within your network of sites, WordPress must be in multisite mode)', 'belingogeo'),
					"value" => "multisite",
					"disabled" => true
				],
				[
					"label" => __('Existing URLs (redirect to existing page structure with city. For pages only.)', 'belingogeo'),
					"value" => "existing",
					"disabled" => true
				],
			],
			'post_type'	=> false,
			'disabled' => false,
			'is_pro' => true
		)
	);

	add_settings_field( 
		'belingo_geo_basic_default_nonecity',  
		__('Default city', 'belingogeo'),
		'belingo_geo_display_settings', 
		$settings_page, 
		'belingo_geo_basic', 
		array( 
			'type'      => 'select',
			'option_name' => 'belingo_geo_basic_default_nonecity',
			'descr' 	=> __('The string is displayed in the select_city shortcode if there is no selected city', 'belingogeo'),
			'post_type'	=> 'cities',
			'multiple'  => false
		)
	);

	add_settings_field( 
		'belingo_geo_basic_default_text_nonecity', 
		__('If the city is not found', 'belingogeo'), 
		'belingo_geo_display_settings', 
		$settings_page, 
		'belingo_geo_basic', 
		array( 
			'type'      => 'text',
			'option_name' => 'belingo_geo_basic_default_text_nonecity',
			'descr' 	=> __('If no city is selected, and no default city is specified, you can specify the text that will be displayed, by default: "Not Found".', 'belingogeo'),
			'post_type'	=> false
		)
	);

	add_settings_field( 
		'belingo_geo_basic_popup_window_header', 
		__('Popup title with cities', 'belingogeo'), 
		'belingo_geo_display_settings', 
		$settings_page, 
		'belingo_geo_basic', 
		array( 
			'type'      => 'text',
			'option_name' => 'belingo_geo_basic_popup_window_header',
			'descr' 	=> __('Popup title with cities', 'belingogeo'),
			'post_type'	=> false
		)
	);

	add_settings_field( 
		'belingo_geo_basic_popup_window_text1', 
		__('Additional text1 in the popup window', 'belingogeo'), 
		'belingo_geo_display_settings', 
		$settings_page, 
		'belingo_geo_basic', 
		array( 
			'type'      => 'text',
			'option_name' => 'belingo_geo_basic_popup_window_text1',
			'descr' 	=> __('Additional text1 in the popup window', 'belingogeo'),
			'post_type'	=> false
		)
	);

	add_settings_field( 
		'belingo_geo_basic_popup_window_text2', 
		__('Additional text2 in the popup window', 'belingogeo'), 
		'belingo_geo_display_settings', 
		$settings_page, 
		'belingo_geo_basic', 
		array( 
			'type'      => 'text',
			'option_name' => 'belingo_geo_basic_popup_window_text2',
			'descr' 	=> __('Additional text2 in the popup window', 'belingogeo'),
			'post_type'	=> false
		)
	);

	add_settings_field( 
		'belingo_geo_basic_enable_windows_in_footer', 
		__('Connect pop-ups in the site footer', 'belingogeo'),
		'belingo_geo_display_settings', 
		$settings_page, 
		'belingo_geo_basic', 
		array( 
			'type'      => 'checkbox',
			'option_name' => 'belingo_geo_basic_enable_windows_in_footer',
			'descr' 	=> __('Enables pop-up windows in the footer of the site, the option can not be enabled if you placed the shortcode manually', 'belingogeo'),
			'post_type'	=> false
		)
	);

	add_settings_field( 
		'belingo_geo_sitemap_per_page', 
		__('Number of urls in the sitemap', 'belingogeo'), 
		'belingo_geo_display_settings', 
		$settings_page, 
		'belingo_geo_basic', 
		array( 
			'type'      => 'text',
			'option_name' => 'belingo_geo_sitemap_per_page',
			'descr' 	=> __('The number of URLs per page in the sitemap', 'belingogeo'),
			'post_type'	=> false
		)
	);

	add_settings_field( 
		'belingo_geo_exclude_nonobject', 
		__('Exclude anything that is not a registered entity', 'belingogeo'),
		'belingo_geo_display_settings', 
		$settings_page, 
		'belingo_geo_excludes', 
		array( 
			'type'      => 'checkbox',
			'option_name' => 'belingo_geo_exclude_nonobject',
			'descr' 	=> __('This option excludes all pages not related to WP_Post, WP_Term, WP_Post_Type and WP_Taxonomy. For example archives by date', 'belingogeo'),
			'post_type'	=> false
		)
	);

	add_settings_field( 
		'belingo_geo_exclude_all_posts', 
		__('Exclude all regular posts', 'belingogeo'),
		'belingo_geo_display_settings', 
		$settings_page, 
		'belingo_geo_excludes', 
		array( 
			'type'      => 'checkbox',
			'option_name' => 'belingo_geo_exclude_all_posts',
			'descr' 	=> __('This option excludes all regular entries. If enabled, exclusion of each individual entry is ignored.', 'belingogeo'),
			'post_type'	=> false
		)
	);

	add_settings_field( 
		'belingo_geo_exclude_all_pages', 
		__('Exclude all pages', 'belingogeo'),
		'belingo_geo_display_settings', 
		$settings_page, 
		'belingo_geo_excludes', 
		array( 
			'type'      => 'checkbox',
			'option_name' => 'belingo_geo_exclude_all_pages',
			'descr' 	=> __('This option excludes all pages. If enabled, exclusion of each individual page is ignored.', 'belingogeo'),
			'post_type'	=> false
		)
	);

	add_settings_field(
		'belingo_geo_exclude_pages',
		__('Pages', 'belingogeo'),
		'belingo_geo_display_settings',
		$settings_page,
		'belingo_geo_excludes',
		array(
			'type'      => 'select',
			'option_name' => 'belingo_geo_exclude_pages',
			'descr' 	=> __('Pages selected in this list will be excluded from the plugin', 'belingogeo'),
			'post_type'	=> 'page',
			'multiple'  => true	
		)
	);

	add_settings_field(
		'belingo_geo_exclude_terms',
		__('Categories', 'belingogeo'), 
		'belingo_geo_display_settings',
		$settings_page,
		'belingo_geo_excludes',
		array(
			'type'      => 'select',
			'option_name' => 'belingo_geo_exclude_terms',
			'descr' 	=> __('The selected headings will be excluded, urls with the city will not be generated for them, and all posts belonging to this heading will be automatically excluded', 'belingogeo'),
			'post_type'	=> 'term',
			'multiple'  => true	
		)
	);

	add_settings_field(
		'belingo_geo_exclude_tags',
		__('Tags', 'belingogeo'), 
		'belingo_geo_display_settings',
		$settings_page,
		'belingo_geo_excludes',
		array(
			'type'      => 'select',
			'option_name' => 'belingo_geo_exclude_tags',
			'descr' 	=> __('The selected tags will be excluded, urls with the city will not be generated for them', 'belingogeo'),
			'post_type'	=> 'tag',
			'multiple'  => true	
		)
	);

	add_settings_field(
		'belingo_geo_exclude_posts',
		__('Posts', 'belingogeo'),
		'belingo_geo_display_settings',
		$settings_page,
		'belingo_geo_excludes',
		array(
			'type'      => 'select',
			'option_name' => 'belingo_geo_exclude_posts',
			'descr' 	=> __('Posts selected in this list will be excluded from the plugin', 'belingogeo'),
			'post_type'	=> 'post',
			'multiple'  => true	
		)
	);

	add_settings_field(
		'belingo_geo_exclude_post_types',
		__('Post types', 'belingogeo'),
		'belingo_geo_display_settings',
		$settings_page,
		'belingo_geo_excludes',
		array(
			'type'      => 'checkboxes',
			'option_name' => 'belingo_geo_exclude_post_types',
			'descr' 	=> __('The selected post types will be excluded, URLs with the city will not be generated for them, and all posts of the specified post type will be automatically excluded', 'belingogeo'),
			'list'		=> 'custom_post_types',
			'post_type' => false	
		)
	);

	add_settings_field(
		'belingo_geo_exclude_taxonomies',
		__('Taxonomies', 'belingogeo'), 
		'belingo_geo_display_settings',
		$settings_page,
		'belingo_geo_excludes',
		array(
			'type'      => 'checkboxes',
			'option_name' => 'belingo_geo_exclude_taxonomies',
			'descr' 	=> __('The selected taxonomies will be excluded, urls with the city will not be generated for them, and all terms of the specified taxonomy will be automatically excluded', 'belingogeo'),
			'post_type'	=> false,
			'list'		=> 'taxonomies'
		)
	);

	/*add_settings_field( 
		'belingo_geo_basic_disable_url', 
		__('Disable virtual URLs', 'belingogeo'),
		'belingo_geo_display_settings', 
		$settings_page, 
		'belingo_geo_basic', 
		array( 
			'type'      => 'checkbox',
			'option_name' => 'belingo_geo_basic_disable_url',
			'descr' 	=> __('You can disable virtual URLs, the plugin will not generate them', 'belingogeo'),
			'post_type'	=> false
		)
	);*/

	/*add_settings_field( 
		'belingo_geo_basic_redirect_page', 
		__('Redirect on page if is exists', 'belingogeo'),
		'belingo_geo_display_settings', 
		$settings_page, 
		'belingo_geo_basic', 
		array( 
			'type'      => 'checkbox',
			'option_name' => 'belingo_geo_basic_redirect_page',
			'descr' 	=> __('When virtual URLs are disabled, you can enable redirection to existing pages. Works only in conjunction with disabled URLs!', 'belingogeo'),
			'post_type'	=> false,
			'disabled'  => true,
			'is_pro'	=> true
		)
	);*/

	add_settings_field( 
		'belingo_geo_basic_finding_nonecity', 
		__('Definition of a city outside the list', 'belingogeo'),
		'belingo_geo_display_settings', 
		$settings_page, 
		'belingo_geo_basic', 
		array( 
			'type'      => 'checkbox',
			'option_name' => 'belingo_geo_basic_finding_nonecity',
			'descr' 	=> __('If this option is enabled, the city will be determined anyway, even if it is not in the list. Virtual URLs for such a city will not be generated.', 'belingogeo'),
			'post_type'	=> false
		)
	);

	add_settings_field( 
		'belingo_geo_basic_show_in_breadcrumbs', 
		__('Add city to breadcrumbs', 'belingogeo'),
		'belingo_geo_display_settings', 
		$settings_page, 
		'belingo_geo_basic', 
		array( 
			'type'      => 'checkbox',
			'option_name' => 'belingo_geo_basic_show_in_breadcrumbs',
			'descr' 	=> __('Option to add the city to breadcrumbs on the website.', 'belingogeo'),
			'post_type'	=> false
		)
	);

	add_settings_field( 
		'belingo_geo_basic_filter_links_by_url', 
		__('Filter links by url', 'belingogeo'),
		'belingo_geo_display_settings', 
		$settings_page, 
		'belingo_geo_basic', 
		array( 
			'type'      => 'checkbox',
			'option_name' => 'belingo_geo_basic_filter_links_by_url',
			'descr' 	=> __('By default, the plugin replaces links using internal functions that determine the city, but when using caching, problems may arise, to eliminate it, you can try using this option', 'belingogeo'),
			'post_type'	=> false
		)
	);

	add_settings_field( 
		'belingo_geo_basic_forced_confirmation_city', 
		__('Forced confirmation of the city', 'belingogeo'),
		'belingo_geo_display_settings', 
		$settings_page, 
		'belingo_geo_basic', 
		array( 
			'type'      => 'checkbox',
			'option_name' => 'belingo_geo_basic_forced_confirmation_city',
			'descr' 	=> __('Forced confirmation of the city without a pop-up window with the question: "What is your city?".', 'belingogeo'),
			'post_type'	=> false
		)
	);

	add_settings_field( 
		'belingo_geo_basic_forced_slug_generation', 
		__('Disable forced slug generation for city', 'belingogeo'),
		'belingo_geo_display_settings', 
		$settings_page, 
		'belingo_geo_basic', 
		array( 
			'type'      => 'checkbox',
			'option_name' => 'belingo_geo_basic_forced_slug_generation',
			'descr' 	=> __('The plugin automatically generates a slug for the city, this option disables automatic generation and you can manually specify the slug for the city.', 'belingogeo'),
			'post_type'	=> false
		)
	);

	add_settings_field( 
		'belingo_geo_basic_forced_region_slug_generation', 
		__('Disable forced slug generation for region', 'belingogeo'),
		'belingo_geo_display_settings', 
		$settings_page, 
		'belingo_geo_basic', 
		array( 
			'type'      => 'checkbox',
			'option_name' => 'belingo_geo_basic_forced_region_slug_generation',
			'descr' 	=> __('The plugin automatically generates a slug for the region, this option disables automatic generation and you can manually specify the slug for the region.', 'belingogeo'),
			'post_type'	=> false
		)
	);

	add_settings_field( 
		'belingo_geo_basic_woo_auto_detect_city_checkout', 
		__('Automatic city detection on the WooCommerce checkout page', 'belingogeo'),
		'belingo_geo_display_settings', 
		$settings_page, 
		'belingo_geo_basic', 
		array( 
			'type'      => 'checkbox',
			'option_name' => 'belingo_geo_basic_woo_auto_detect_city_checkout',
			'descr' 	=> __('Automatic city detection on the WooCommerce checkout page', 'belingogeo'),
			'post_type'	=> false,
			'disabled'  => true,
			'is_pro'	=> true
		)
	);

	add_settings_field( 
		'belingo_geo_basic_enable_search_in_popup', 
		__('Enable city search by pop-up window', 'belingogeo'),
		'belingo_geo_display_settings', 
		$settings_page, 
		'belingo_geo_basic', 
		array( 
			'type'      => 'checkbox',
			'option_name' => 'belingo_geo_basic_enable_search_in_popup',
			'descr' 	=> __('The option displays a city search in a pop-up list of cities', 'belingogeo'),
			'post_type'	=> false,
			'disabled'  => true,
			'is_pro'	=> true
		)
	);

	add_settings_field( 
		'belingo_geo_basic_add_city_to_woo_page_title', 
		__('Add a city to the header of the WooCommerce category', 'belingogeo'), 
		'belingo_geo_display_settings', 
		$settings_page, 
		'belingo_geo_basic', 
		array( 
			'type'      => 'text',
			'option_name' => 'belingo_geo_basic_add_city_to_woo_page_title',
			'descr' 	=> __('You can specify any shortcode, it will be added to the woocommerce category header.', 'belingogeo'),
			'post_type'	=> false,
			'disabled'	=> true,
			'is_pro'	=> true
		)
	);

}
add_action( 'admin_init', 'belingo_geo_settings' );


function belingo_geo_display_settings($args) {

	$args = apply_filters('belingo_geo_display_settings', $args);

	extract( $args );

	$belingo_geo_exclude = get_option( $option_name );

	if(!$belingo_geo_exclude) {
		$belingo_geo_exclude = [];
	}

	if($post_type != 'term' && $post_type != 'tag') {

		switch ( $type ) {

			case 'select':

				$posts = get_posts( array(
					'post_type'   => $post_type,
					'include'     => $belingo_geo_exclude
				) );

				wp_reset_postdata();

				echo "<select ";
				if($multiple) {
					echo " multiple ";
				} 
				echo "class='select2_field' id='".esc_attr($option_name)."' name='" . esc_attr($option_name) . "[]' style='min-width: 300px;'>";

				if(count((array)$belingo_geo_exclude)>0) {
					foreach($posts as $post){
						echo "<option value='".esc_attr($post->ID)."' selected>".esc_html($post->post_title)."</option>";
					}
				}

				echo ($descr != '') ? esc_html($descr) : "";
				echo "</select>";
				echo "<p class='description'>".esc_html($descr)."</p>";
				break;

			case 'text':
				echo "<input type='text' id='".esc_attr($option_name)."' name='" . esc_attr($option_name) . "' value='".esc_attr(get_option($option_name))."' style='min-width: 300px;'";
				if(isset($disabled) && $disabled) {
					echo ' disabled="disabled"';
				}
				echo ">";
				echo "<p class='description'>".esc_html($descr);
				if(isset($is_pro) && $is_pro) {
					echo " <span style=\"color:red;\">";
					_e('Only available for Pro version', 'belingogeo');
					echo "</span>";
				}
				echo "</p>";
				break; 

			case 'simple-text':
				echo "<p style='".$style."'>".esc_html($descr)."</p>";
				break; 

			case 'checkbox':
				echo "<input type='checkbox' id='".esc_attr($option_name)."' name='" . esc_attr($option_name) . "' value='1' ";
				$checked = get_option($option_name);
				if($checked && $checked == 1) {
					echo "checked";
				}
				if(isset($disabled) && $disabled) {
					echo " disabled";
				}
				echo ">";
				echo "<p class='description'>".esc_html($descr);
				if(isset($is_pro) && $is_pro) {
					echo " <span style=\"color:red;\"> ";
					_e('Only available for Pro version', 'belingogeo');
					echo "</span>";
				}
				echo "</p>";
			break;

			case 'radio':
				foreach($options as $option) {
					echo "<p class='radio_label'><label for='".esc_attr($option_name)."-".esc_attr($option['value'])."'><input ";
					if($disabled || $option['disabled']) {
						echo "disabled='disabled'";
					}
					echo " type='radio' id='".esc_attr($option_name)."-".esc_attr($option['value'])."' name='" . esc_attr($option_name) . "' value='" . esc_attr($option['value']) . "' ";
					$checked = get_option($option_name);
					if($checked && $checked == $option['value']) {
						echo "checked";
					}
					echo "> ".esc_html($option['label'])."</label>";
					if(isset($option['help'])) {
						echo "<a class='settings_question' target='_blank' href='".esc_attr($option['help'])."'>";
						echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" xml:space="preserve"><circle fill="#6E83B7" cx="256" cy="256" r="246"/><circle fill="#466089" cx="256" cy="256" r="200"/><g><path fill="#EDEFF1" d="M276.02 351h-40v-89.36c0-23.401 19.097-42.439 42.571-42.439 20.087 0 36.429-16.194 36.429-36.101 0-19.905-16.342-36.1-36.429-36.1h-45.143c-20.087 0-36.429 16.194-36.429 36.1h-40c0-41.962 34.286-76.1 76.429-76.1h45.143c42.143 0 76.429 34.138 76.429 76.1s-34.286 76.1-76.429 76.1c-1.418 0-2.571 1.095-2.571 2.439V351z"/><circle fill="#EDEFF1" cx="256" cy="395" r="26"/></g></svg>';
						echo "</a>";
					}
					echo "</p>";
				}
				echo "<p class='description'>".esc_html($descr);
				if(isset($is_pro) && $is_pro) {
					echo " <span style=\"color:red;\">";
					_e('Only available for Pro version', 'belingogeo');
					echo "</span>";
				}
				echo "</p>";
			break;

			case 'checkboxes':

				if($list == 'custom_post_types') {
					$args = array(
				       'public'   => true,
				       '_builtin' => false,
				       //'rewrite'  => true
				    );
				    $post_types = get_post_types( $args, 'names', 'and' );
				    foreach ( $post_types  as $post_type ) {
				       	echo "<p><label for='".esc_attr($option_name.'_'.$post_type)."'><input type='checkbox' id='".esc_attr($option_name.'_'.$post_type)."' name='" . esc_attr($option_name) . "[".esc_attr($post_type)."]' value='1' ";
				       	if(is_array(get_option($option_name))) {
							$checked = array_key_exists($post_type, get_option($option_name));
							if($checked) {
								echo "checked";
							}
						}
						echo "> ".$post_type."</label></p>";
				    }
				    echo "<p class='description'>".esc_html($descr)."</p>";
				}

				if($list == 'taxonomies') {
					$args = array(
				       'public'   => true,
				       //'rewrite'  => true,
				       '_builtin' => false,
				    );
				    $taxonomies = get_taxonomies( $args );
				    foreach ( $taxonomies  as $taxonomy ) {
				       	echo "<p><label for='".esc_attr($option_name.'_'.$taxonomy)."'><input type='checkbox' id='".esc_attr($option_name.'_'.$taxonomy)."' name='" . esc_attr($option_name) . "[".esc_attr($taxonomy)."]' value='1' ";
				       	if(is_array(get_option($option_name))) {
							$checked = array_key_exists($taxonomy, get_option($option_name));
							if($checked) {
								echo "checked";
							}
						}
						echo "> ".$taxonomy."</label></p>";
				    }
				    echo "<p class='description'>".esc_html($descr)."</p>";
				}

			break;

		}
	}elseif($post_type == 'term') {
		$terms = get_terms( array(
			'taxonomy'   => 'category',
			'include'     => $belingo_geo_exclude,
			'hide_empty'  => false
		) );

		wp_reset_postdata();

		switch ( $type ) {

			case 'select':
				echo "<select multiple class='select2_field' id='".esc_attr($option_name)."' name='" . esc_attr($option_name) . "[]' style='min-width: 300px;'>";

				if(count($belingo_geo_exclude)>0) {
					foreach($terms as $term){
						echo "<option value='".esc_attr($term->term_id)."' selected>".esc_html($term->name)."</option>";
					}
				}

				echo ($descr != '') ? esc_html($descr) : "";
				echo "</select>";
				echo "<p class='description'>".esc_html($descr)."</p>";
				break;
		}
	}elseif($post_type == 'tag') {
		$terms = get_terms( array(
			'taxonomy'   => 'post_tag',
			'include'     => $belingo_geo_exclude,
			'hide_empty'  => false
		) );

		wp_reset_postdata();

		switch ( $type ) {

			case 'select':
				echo "<select multiple class='select2_field' id='".esc_attr($option_name)."' name='" . esc_attr($option_name) . "[]' style='min-width: 300px;'>";

				if(count($belingo_geo_exclude)>0) {
					foreach($terms as $term){
						echo "<option value='".esc_attr($term->term_id)."' selected>".esc_html($term->name)."</option>";
					}
				}

				echo ($descr != '') ? esc_html($descr) : "";
				echo "</select>";
				echo "<p class='description'>".esc_html($descr)."</p>";
				break;
		}
	}
}

?>