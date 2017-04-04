<?php
/**
 * Plugin Name: LSB: Leseopplegg
 * Description: Legger til innholdstypen Leseopplegg.
 * Version: 1.0.0
 * Author: Lilly Labs
 * Author URI: http://lillylabs.no
 */

namespace LSB\ReadingGuides;
include('class-reading-guide.php');

add_action( 'init', __NAMESPACE__ . '\\CPT_Reading_Guide::register_post_type');
add_action('acf/init', __NAMESPACE__ . '\\CPT_Reading_Guide::add_custom_fields');
register_activation_hook( __FILE__, __NAMESPACE__ .'\\CPT_Reading_Guide::rewrite_flush' );
