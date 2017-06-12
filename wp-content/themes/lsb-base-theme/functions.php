<?php
/**
 * Roots includes
 *
 * The $roots_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/roots/pull/1042
 */
$roots_includes = array(
	'lib/algolia.php',        // Algolia functions
	'lib/utils.php',          // Utility functions
	'lib/init.php',           // Initial theme setup and constants
	'lib/wrapper.php',        // Theme wrapper class
	'lib/sidebar.php',        // Sidebar class
	'lib/config.php',         // Configuration
	'lib/activation.php',     // Theme activation
	'lib/titles.php',         // Page titles
	'lib/nav.php',            // Custom nav modifications
	'lib/gallery.php',        // Custom [gallery] modifications
	'lib/comments.php',       // Custom comments modifications
	'lib/scripts.php',        // Scripts and stylesheets
	'lib/extras.php',         // Custom functions
	'lib/pagination.php',     // Boostrap pagination
	'lib/lsb-mime-types.php', // Custom upload mime types
	'lib/rewrite.php',        // Custom rewrite rules
	'lib/feed-util.php',      // Custom rss rules
	'lib/lsb-breadcrumbs.php',// Breadcrumbs logic
	'lib/lsb-post.php',       // Extends Timber post
	'lib/lsb_pagination.php', // Changes to offsets and pagination
	'lib/lsb_sections.php',   // Transform acf sections
	'lib/filter.php'          // Filter on selected category
);

foreach ($roots_includes as $file) {
	if (!$filepath = locate_template($file)) {
		trigger_error(sprintf(__('Error locating %s for inclusion', 'roots'), $file), E_USER_ERROR);
	}

	require_once $filepath;
}
unset($file, $filepath);

// Initialize custom functionality
new LsbFeedUtil();

if(!function_exists('_log')){
	function _log( $message ) {
		if( WP_DEBUG === true ){
			if( is_array( $message ) || is_object( $message ) ){
				error_log( print_r( $message, true ) );
			} else {
				error_log( $message );
			}
		}
	}
}

new LsbMimeTypes();

function capitalize_title( $term_title ) {
	return ucfirst($term_title);
}
add_filter ( 'single_term_title', 'capitalize_title', 0 );

// add hook
add_filter( 'wp_nav_menu_objects', 'my_wp_nav_menu_objects_sub_menu', 10, 2 );
// filter_hook function to react on sub_menu flag
function my_wp_nav_menu_objects_sub_menu( $sorted_menu_items, $args ) {
	if ( isset( $args->sub_menu ) ) {
		$root_id = 0;

		// find the current menu item
		foreach ( $sorted_menu_items as $menu_item ) {
			if ( $menu_item->current ) {
				// set the root id based on whether the current menu item has a parent or not
				$root_id = ( $menu_item->menu_item_parent ) ? $menu_item->menu_item_parent : $menu_item->ID;
				break;
			}
		}

		// find the top level parent
		if ( ! isset( $args->direct_parent ) ) {
			$prev_root_id = $root_id;
			while ( $prev_root_id != 0 ) {
				foreach ( $sorted_menu_items as $menu_item ) {
					if ( $menu_item->ID == $prev_root_id ) {
						$prev_root_id = $menu_item->menu_item_parent;
						// don't set the root_id to 0 if we've reached the top of the menu
						if ( $prev_root_id != 0 ) $root_id = $menu_item->menu_item_parent;
						break;
					}
				}
			}
		}
		$menu_item_parents = array();
		foreach ( $sorted_menu_items as $key => $item ) {
			// init menu_item_parents
			if ( $item->ID == $root_id ) $menu_item_parents[] = $item->ID;
			if ( in_array( $item->menu_item_parent, $menu_item_parents ) ) {
				// part of sub-tree: keep!
				$menu_item_parents[] = $item->ID;
			} else if ( ! ( isset( $args->show_parent ) && in_array( $item->ID, $menu_item_parents ) ) ) {
				// not part of sub-tree: away with it!
				unset( $sorted_menu_items[$key] );
			}
		}

		return $sorted_menu_items;
	} else {
		return $sorted_menu_items;
	}
}


/** Force URLs in srcset attributes into HTTPS scheme.
	* This is particularly useful when you're running a Flexible SSL frontend like Cloudflare
	*/
function ssl_srcset( $sources ) {
	foreach ( $sources as &$source ) {
		if(strpos($source['url'], 'boksokbeta.lesersokerbok.no') !== false) {
			$source['url'] = set_url_scheme( $source['url'], 'https' );
		}
	}
	return $sources;
}
add_filter( 'wp_calculate_image_srcset', 'ssl_srcset' );

function lsb_add_to_context( $data ){
		$data['breadcrumbs'] = new LSBBreadcrumbs('site_map');
		return $data;
}
add_filter('timber/context', 'lsb_add_to_context');

function lsb_add_list_separators( $arr, $first_delimiter = ', ', $second_delimiter = ' & ' ) {
	if( !is_array( $arr) ) {
		return $arr;
	}

	$length = count($arr);
	$list = '';
	foreach ( $arr as $index => $item ) {
		if ( $index < $length - 2 ) {
			$delimiter = $first_delimiter;
		} elseif ( $index == $length - 2 ) {
			$delimiter = $second_delimiter;
		} else {
			$delimiter = '';
		}
		$list .= sprintf('<a href="%s">%s</a>%s', $item->link, $item->name, $delimiter);
	}
	return $list;
}

function lsb_filter_icon_terms( $arr ) {
	if( !is_array( $arr) ) {
		return $arr;
	}
	return array_filter($arr, function($term) {
		return !!$term->icon;
	});
}

function lsb_filter_visible_terms( $arr ) {
	if( !is_array( $arr) ) {
		return $arr;
	}
	return array_filter($arr, function($term) {
		return !$term->hidden;
	});
}

function lsb_add_to_twig($twig) {
	/* this is where you can add your own fuctions to twig */
	$twig->addExtension(new Twig_Extension_StringLoader());
	$twig->addFilter(new Twig_SimpleFilter('terms_list', 'lsb_add_list_separators'));
	$twig->addFilter(new Twig_SimpleFilter('icon_terms', 'lsb_filter_icon_terms'));
	$twig->addFilter(new Twig_SimpleFilter('visible_terms', 'lsb_filter_visible_terms'));
	return $twig;
}
add_filter('timber/twig', 'lsb_add_to_twig');
