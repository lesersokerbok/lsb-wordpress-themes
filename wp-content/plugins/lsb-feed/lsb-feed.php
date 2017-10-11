<?php
/**
 * Plugin Name: LSB: Feed
 * Description: Tilpassning av RSS feed
 * Version: 1.0.0
 * Author: Lilly Labs
 * Author URI: http://lillylabs.no
 */

namespace LSB\Feed;

include('lib/featured-image.php');
include('lib/lsb_book-content.php');

add_action( 'rss2_item', __NAMESPACE__ . '\\add_featured_image_in_rss_2' );
add_action( 'rss2_item', __NAMESPACE__ . '\\add_lsb_book_meta_in_rss' );

if ( WP_ENV === 'development') {
  add_filter( 'http_request_args', __NAMESPACE__ . '\\set_reject_unsafe_urls_to_false');
}

function set_reject_unsafe_urls_to_false( $args ) {
  $args['reject_unsafe_urls'] = false;
  return $args;
}