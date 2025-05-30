=== belingoGeo ===
Contributors: belingo
Tags: geo-targeting, geo target, geotargeting, targeted content, geolocation
Requires at least: 5.0.0
Tested up to: 6.7.2
Stable tag: 1.12.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The plugin adds the ability to select cities, unique pages are created with a unique url for each city. This allows you to uniqueize content.

== Description ==

The plugin adds the ability to select cities, unique pages are created with a unique url for each city. This allows you to uniqueize content for search engines.

<iframe width="680" height="420" src="https://www.youtube.com/embed/gTIPR8cmQmM?si=PZusLiKpV-GbgEGt" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

If for some reason the video is unavailable, you can watch it on <a href="https://www.youtube.com/watch?v=gTIPR8cmQmM">Youtube</a>, <a href="https://dzen.ru/video/watch/6759510b565b5409ab52b754?share_to=link">Zen</a>, <a href="https://rutube.ru/video/0c08cc8493b2893a7c33b2ff5252a1db/">Rutube</a> and <a href="https://vkvideo.ru/video-54775454_456239017">VK Video</a>

Plugin capabilities:

- Creating virtual URLs for all WordPress pages and posts
- Ability to combine cities into regions.
- Ability to exclude pages, posts or taxonomies for which there is no need to create a URL
- Pre-made pop-up windows for confirming the found city, as well as for selecting other cities.
- Defining those cities that are not added to the list
- Shortcodes for displaying cities in different cases
- Shortcodes with a phone number and address for each city
- Shortcodes that allow you to add any content, depending on the selected city
- Shortcodes for regions, allowing you to display different content for a group of cities.
- Creating virtual URLs for Woocommerce categories and products
- Support for Yoast.

<a href="https://belingo.ru/products/belingogeo-pro/?utm_source=wordpress.org&utm_medium=description" target="_blank">Extended version of the plugin</a>

Useful articles:

<a href="https://belingo.ru/ustanovka-i-nastrojka-plagina-belingogeo/?utm_source=wordpress.org&utm_medium=description" target="_blank">Installing and configuring the plugin</a>
<a href="https://belingo.ru/kak-sortirovat-goroda-v-plagine-belingogeo/?utm_source=wordpress.org&utm_medium=description" target="_blank">How to sort cities in plugin</a>
<a href="https://belingo.ru/kak-sozdat-dopolnitelnoe-pole-dlya-goroda-v-plagine-belingogeo/?utm_source=wordpress.org&utm_medium=description" target="_blank">How to create an additional field for the city in the plugin</a>
<a href="https://belingo.ru/opisanie-vsex-nastroek-plagina-belingogeo/?utm_source=wordpress.org&utm_medium=description">Description of all settings of the BelingoGeo plugin</a>
<a href="https://belingo.ru/nastrojka-plagina-belingogeo-v-rezhime-poddomenov/?utm_source=wordpress.org&utm_medium=description">Setting up the BelingoGeo plugin in the "city in a subdomain" mode</a>
<a href="https://belingo.ru/opisanie-shortkodov-plagina-belingogeo/?utm_source=wordpress.org&utm_medium=description">Description of shortcodes of the BelingoGeo plugin</a>

We are on social networks:

<a href="https://t.me/belingollc" target="_blank">Telegram channel</a>
<a href="https://vk.com/itbelingo" target="_blank">VK Group</a>
<a href="https://dzen.ru/belingo" target="_blank">Zen channel</a>

== Installation ==

1. Upload `belingogeo` to the `/wp-content/plugins/` directory.
2. Activate `Belingo.GeoCity` in your wordpress site if it is not activated already.
3. Place the shortcode [belingogeo_selector] anywhere on your website page. This shortcode displays the city switching selector, its placement is optional, URLs can be generated without it.
4. Create one or more cities in BelingoGeo -> Cities, after that duplicates of each page with the city prefix will appear on your site, for example /city1/page/, /city2/page/, etc.
5. To make pages unique, you need to use shortcodes. You can read more about shortcodes <a href="https://belingo.ru/opisanie-shortkodov-plagina-belingogeo/?utm_source=wordpress.org&utm_medium=install">here</a>
6. Additionally, see the <a href="https://belingo.ru/opisanie-vsex-nastroek-plagina-belingogeo/?utm_source=wordpress.org&utm_medium=install">description of the plugin settings</a>

== Screenshots ==
1. Settings Page
2. Example of work on the page
3. Cities in console
4. City page
5. Regions in console

== Changelog ==
= 1.12.1 =
* Fix bug access violation vulnerability

= 1.12.0 =
* Description update
* Updating language packs
* Added the ability to enable cookie rewriting when going to a page or subdomain via a direct link.
* Added belingogeo_is_exclude hook.
* Added the function of excluding records for each city.
* Added a function for physically excluding records on archive pages for the city.

= 1.11.1 =
* Fixed city detection if the default city is not specified and the found city is not in the list. Now you can optionally display the first city from the list.

= 1.11 =
* Added multisite mode
* The option to turn off URL generation has been moved to modes
* Fixed the problem of resetting settings when disabling/enabling the plugin
* Fixed saving of nogeo_name cookie
* Fixed og:site_name when using Yoast
* Added support for cities in Yoast breadcrumbs.
* Fixed definition of empty object in belingogeo_is_exclude()
* Added additional field for phone in city with html support
* Added the ability to exclude all pages at once
* The redirect option when the page exists has been moved to modes.
* Added belingogeo_generate_link hook
* Updated csv file with cities for import. Added prepositional case
* Language packs updated
* Fixed empty links in Yoast sitemap
* Added belingogeo_ajax_data hook

= 1.10.5 =
* Added support for fields in Yoast for social network X
* Updated plugin description

= 1.10.4 =
* fix example csv file with cities

= 1.10.3 =
* Hide plugin version in settings

= 1.10.2 =
* Fixed incorrect condition in exceptions
* Fixed fatal errors when using new versions of the plugin with old pro extensions
* Fixed exception if the current city is not in the list. Fixed sitemap when all regular entries are excluded.
* Fixed a fatal error in the sitemap when there are no excluded taxonomies.

= 1.10.1 =
* Fixed WC cache when changing prices for goods and when changing cities

= 1.10 =
* Updating Language Packs
* Fixed an issue with infinite cloning of the Default city. Now this is a system city, it cannot be deleted
* The function for downloading CSV examples has been adjusted
* Added the ability to not display the city confirmation window for the [belingogeo_selector] shortcode
* Added redirect exception to search page
* Fixed forced city confirmation when using cache
* fix new redirect page functions
* Added an option to redirect to an existing city page
* remove rewrite:true from post_types and taxonomies in admin
* fix sitemaps taxonomies and hide empty sitemaps
* Added the ability to change woocommerce prices depending on the city
* fix save posts in admin without cities
* Changed the method of connecting pop-up windows and selector, added the ability to change text in windows from the console
* Excluded from xml sitemap not publicly_queryable post_types
* add hook for sitemap headers
* Added the ability to insert any shortcodes into the woocommerce category header

= 1.9 =
* added ability to use nested shortcodes
* improved belingogeo_city_content shortcode, added the ability to exclude cities and specify several cities
* fix yoast json ld for shortcodes
* fix city in canonical
* fix default sort cities in popup window
* fix show links in sitemaps when subdomains is on
* added new hooks to the plugin templates, added the ability to search for a city, added a search option in the settings
* Update Select2
* Added additional information about the plugin
* Updated language pack
* Update sypex geo database
* Regions added
* Added 2 new shortcodes: belingogeo_region_field, belingogeo_region_content
* fix shortcode belingogeo_region_content
* Added the ability to import/export

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