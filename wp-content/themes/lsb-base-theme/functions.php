<?php

$includes = array(
	'lib/activation.php',     // Theme activation
	'lib/comments.php',       // Custom comments modifications
	'lib/config.php',         // Configuration
	'lib/extras.php',         // Custom functions
	'lib/feed-util.php',      // Custom rss rules
	'lib/filter.php',         // Filter on selected category
	'lib/gallery.php',        // Custom [gallery] modifications
	'lib/init.php',           // Initial theme setup and constants

	'lib/lsb_pagination.php', // Changes to offsets and pagination
	'lib/lsb_sections.php',   // Transform acf sections
	'lib/lsb-breadcrumbs.php',// Breadcrumbs logic
	'lib/lsb-mime-types.php', // Custom upload mime types
	'lib/lsb-post.php',       // Extends Timber post

	'lib/pagination.php',     // Boostrap pagination
	'lib/rewrite.php',        // Custom rewrite rules
	'lib/scripts.php',        // Scripts and stylesheets
	'lib/sidebar.php',        // Sidebar class
	'lib/titles.php',         // Page titles
	'lib/twig.php',           // Twig functions
	'lib/utils.php',          // Utility functions
	'lib/wrapper.php'       	// Theme wrapper class
);

foreach ($includes as $file) {
	if (!$filepath = locate_template($file)) {
		trigger_error(sprintf(__('Error locating %s for inclusion', 'lsb_admin'), $file), E_USER_ERROR);
	}

	require_once $filepath;
}
unset($file, $filepath);

// Initialize custom functionality
new LsbFeedUtil();
new LsbMimeTypes();

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