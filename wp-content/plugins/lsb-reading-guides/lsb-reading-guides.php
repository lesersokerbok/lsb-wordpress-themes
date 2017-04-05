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

	$lsb_pre_reading = get_field_object( "lsb_pre_reading", $post_id );
	$lsb_reading = get_field_object( "lsb_reading", $post_id );
	$lsb_post_reading = get_field_object( "lsb_post_reading", $post_id );

	$post_content = get_field( "lsb_intro", $post_id );
	$post_content .= "<!--more-->";
	$post_content .= sprintf("<h2>%s</h2>%s", $lsb_pre_reading['label'], $lsb_pre_reading['value']);
	$post_content .= sprintf("<h2>%s</h2>%s", $lsb_reading['label'], $lsb_reading['value']);
	$post_content .= sprintf("<h2>%s</h2>%s", $lsb_post_reading['label'], $lsb_post_reading['value']);

	$updated_post = array(
		'ID' => $post_id,
		'post_title' => $lsb_book->post_title,
		'post_content' => $post_content,
		'post_name' => $lsb_book->post_name,
		'slug' => $lsb_book->slug
	);

	set_post_thumbnail( $post_id, get_post_thumbnail_id( $lsb_book ) );

	remove_action( 'save_post_lsb_reading_guide', __NAMESPACE__ .'\save_post_action' );
	wp_update_post( $updated_post);
	add_action( 'save_post_lsb_reading_guide', __NAMESPACE__ .'\save_post_action' );
}
add_action( 'save_post_lsb_reading_guide', __NAMESPACE__ .'\save_post_action' );

add_action( 'init', __NAMESPACE__ . '\\CPT_Reading_Guide::register_post_type' );
add_action( 'acf/init', __NAMESPACE__ . '\\CPT_Reading_Guide::add_custom_fields' );
register_activation_hook( __FILE__, __NAMESPACE__ .'\\CPT_Reading_Guide::rewrite_flush' );
