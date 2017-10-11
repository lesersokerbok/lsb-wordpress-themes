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
add_action( 'rss_item', __NAMESPACE__ . '\\add_featured_image_in_rss' );
add_action( 'rss_item', __NAMESPACE__ . '\\add_lsb_book_meta_in_rss' );