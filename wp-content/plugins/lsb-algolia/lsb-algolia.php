<?php
/**
 * Plugin Name: LSB: Algolia
 * Description: Tilpassning av Algolia
 * Version: 1.0.0
 * Author: Lilly Labs
 * Author URI: http://lillylabs.no
 */

namespace LSB\Algolia;
include('lib/blacklist.php');
include('lib/images.php');
include('lib/lsb_book-attributes.php');
include('lib/lsb_book-index-settings.php');
include('lib/searchable-post-types.php');

add_filter( 'algolia_post_types_blacklist', __NAMESPACE__ . '\\add_to_blacklist', 10, 2 );

add_filter( 'algolia_post_images_sizes', __NAMESPACE__ . '\\add_to_image_sizes', 10, 2 );

add_filter( 'algolia_post_lsb_book_shared_attributes', __NAMESPACE__ . '\\lsb_book_attributes', 10, 2 );
add_filter( 'algolia_searchable_post_lsb_book_shared_attributes', __NAMESPACE__ . '\\lsb_book_attributes', 10, 2 );

add_filter( 'algolia_searchable_posts_index_settings', __NAMESPACE__ . '\\lsb_book_index_settings' );
add_filter( 'algolia_posts_lsb_book_index_settings', __NAMESPACE__ . '\\lsb_book_index_settings' );

add_filter( 'algolia_searchable_post_types', __NAMESPACE__ . '\\filter_searchable_post_types' );
