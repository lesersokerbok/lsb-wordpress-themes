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

function save_post_action($post_id) {
	if( !class_exists('acf') ) {
		return;
	}

	$lsb_book = get_field( "lsb_book", $post_id );
	$updated_post = array(
		'ID' => $post_id,
		'post_title' => $lsb_book->post_title,
		'post_name' => $lsb_book->post_name,
		'slug' => $lsb_book->slug,
		'thumbnail' => $lsb_book->thumbnail
	);

	remove_action( 'save_post_lsb_reading_guide', __NAMESPACE__ .'\save_post_action' );
	wp_update_post( $updated_post);
	add_action( 'save_post_lsb_reading_guide', __NAMESPACE__ .'\save_post_action' );
}
add_action( 'save_post_lsb_reading_guide', __NAMESPACE__ .'\save_post_action' );

add_action( 'init', __NAMESPACE__ . '\\CPT_Reading_Guide::register_post_type' );
add_action( 'acf/init', __NAMESPACE__ . '\\CPT_Reading_Guide::add_custom_fields' );
register_activation_hook( __FILE__, __NAMESPACE__ .'\\CPT_Reading_Guide::rewrite_flush' );
