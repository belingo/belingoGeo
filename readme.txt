=== belingoGeo ===
Contributors: belingo
Tags: geo-targeting, geo target, geotargeting, targeted content, geolocation, geo content, change content based on location
Requires at least: 4.4.2
Tested up to: 6.2.2
Stable tag: 1.8.7
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The plugin adds the ability to select cities, unique pages are created with a unique url for each city. This allows you to uniqueize content for search engines.

== Description ==

The plugin adds the ability to select cities, unique pages are created with a unique url for each city. This allows you to uniqueize content for search engines.

<a href="https://belingo.ru/ustanovka-i-nastrojka-plagina-belingogeo/?utm_source=wordpress.org&utm_medium=description" target="_blank">Installing and configuring the plugin</a>
<a href="https://belingo.ru/kak-sortirovat-goroda-v-plagine-belingogeo/?utm_source=wordpress.org&utm_medium=description" target="_blank">How to sort cities in plugin</a>
<a href="https://belingo.ru/kak-sozdat-dopolnitelnoe-pole-dlya-goroda-v-plagine-belingogeo/?utm_source=wordpress.org&utm_medium=description" target="_blank">How to create an additional field for the city in the plugin</a>
<a href="https://belingo.ru/products/belingogeo-pro/?utm_source=wordpress.org&utm_medium=description" target="_blank">Extended version of the plugin</a>

Subscribe to our <a href="https://t.me/belingollc" target="_blank">Telegram channel</a>

== Installation ==

1. Upload `belingogeo` to the `/wp-content/plugins/` directory.
2. Activate `Belingo.GeoCity` in your wordpress site if it is not activated already.
3. Place shortcode [belingogeo_select_city] anywhere on your website page.

== Screenshots ==
1. Settings Page
2. Example of work on the page
3. Cities in console
4. City page

== Changelog ==
= 1.8.7 =
* fixed city detection if result is empty
* fix scripts and styles path for admin
* fix search city in admin
* fix warning errors

= 1.8.6 =
* Fix default city

= 1.8.5 =
* Plugin settings form corrected

= 1.8.4 =
* Fixed way to remove city from url

= 1.8.3 =
* Fixed display of new shortcodes in Yoast

= 1.8.2 =
* Fixed city sorting in the popup window
* Added a hook to change the cities query in the popup

= 1.8.1 =
* Fixed sitemaps
* Added the ability to disable the forced generation of a shortcut for the city

= 1.8 =
* Moved section with settings and cities
* Fixed problem with Cyrillic in url
* Fixed 404 error on some pages, including Woocommerce pages
* Code refactored
* Now Woocommerce pages are also available in the basic version of the plugin
* Fixed output of shortcodes in the Gutenberg theme editor
* Shortcodes have been updated, now there are only 3 of them (belingogeo_select_city, city_field, city_content), old shortcodes still work, but are considered obsolete and will be removed in the future
* The belingogeo_select_city shortcode got a "show" parameter, now you can specify on which device to display the shortcode - this will make life easier in some themes
* Shortcodes can now display content when URLs are disabled
* Added the ability to specify the city by default, no URLs will be generated for such a city, while shortcodes will work
* All shortcodes now have default values available
* Added the ability to force the definition of the city without confirmation in the pop-up window
* The number of entries per page in the sitemap is now in the settings, you can adjust it.
* Added the ability to disable or enable the city in breadcrumbs, for now only for breadcrumbs woocommerce
* Expanded options to exclude pages and posts
* For the Pro version, the ability to automatically determine the city on the checkout page of WooCommerce has been added
* Added a set of hooks and pre-installed functions to extend the plugin's capabilities by third-party developers

= 1.7.1 =
* Fixed incorrect status of non-excluded entry in Ajax

= 1.7 =
* Added the ability to paginate in the sitemap (for sites with a large amount of material)
* Added new shortcodes [city_field] and [city_content]
* Added ACF support
* Minor bug fixes

= 1.6.5 =
* Fixed redirect on init page and on change city

= 1.6.4 =
* Fixed redirect when city is selected

= 1.6.3 =
* Fixed category nesting in custom taxonomy

= 1.6.2 =
* Fix notice errors

= 1.6.1 =
* Fix taxonomy fo custom post types
* Fix xml sitemaps

= 1.6 =
* Added support for Custom Post Types

= 1.5 =
* First release.