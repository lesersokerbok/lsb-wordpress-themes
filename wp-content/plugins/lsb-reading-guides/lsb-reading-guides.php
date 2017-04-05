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

function save_lsb_reading_guide_action($post_id) {

	if( 'lsb_reading_guide' !== get_post_type($post_id) ) {
		return;
	}

	// In case the field returns ID, not post
	$lsb_book = get_post(get_field( "lsb_book", $post_id ));

	$lsb_pre_reading = get_field_object( "lsb_pre_reading", $post_id );
	$lsb_reading = get_field_object( "lsb_reading", $post_id );
	$lsb_post_reading = get_field_object( "lsb_post_reading", $post_id );

	$post_content = get_field( "lsb_intro", $post_id );
	$post_content .= "<!--more-->";
	$post_content .= sprintf("<a href='%s'>%s</a>", get_permalink($lsb_book), __('Les mer om boken', 'lsb'));

	if( $lsb_pre_reading['value'] ) {
		$post_content .= sprintf("<h2>%s</h2>%s", $lsb_pre_reading['label'], $lsb_pre_reading['value']);
	}

	if( $lsb_reading['value'] ) {
		$post_content .= sprintf("<h2>%s</h2>%s", $lsb_reading['label'], $lsb_reading['value']);
	}

	if( $lsb_post_reading['value'] ) {
		$post_content .= sprintf("<h2>%s</h2>%s", $lsb_post_reading['label'], $lsb_post_reading['value']);
	}

	$updated_reading_guide = array(
		'ID' => $post_id,
		'post_title' => $lsb_book->post_title,
		'post_content' => $post_content,
		'post_name' => $lsb_book->post_name
	);

	set_post_thumbnail( $post_id, get_post_thumbnail_id( $lsb_book ) );
	wp_update_post( $updated_reading_guide );

	$book_guides = get_post_meta($lsb_book->ID, 'lsb_reading_guides', true);
	if(!in_array($post_id, $book_guides)) {
		if(is_array($book_guides)) {
			array_push($book_guides, $post_id);
		} else {
			$book_guides = array($post_id);
		}
	}
	update_post_meta( $lsb_book->ID, 'lsb_reading_guides', $book_guides );
}

function before_delete_lsb_reading_guide_action($post_id) {

	if( 'lsb_reading_guide' !== get_post_type($post_id) ) {
		return;
	}

	// In case the field returns ID, not post
	$lsb_book = get_post(get_field( "lsb_book", $post_id ));
	$book_guides = get_post_meta($lsb_book->ID, 'lsb_reading_guides', true);
	if(in_array($post_id, $book_guides)) {
		$book_guides = array_diff($book_guides, array($post_id) );
		update_post_meta( $lsb_book->ID, 'lsb_reading_guides', $book_guides );
	}
}

function save_lsb_book_action($post_id) {

	if( 'lsb_book' !== get_post_type($post_id) ) {
		return;
	}

	foreach( get_post_meta( $post_id, 'lsb_reading_guides', true ) as $lsb_reading_guide_id ) {
		save_lsb_reading_guide_action($lsb_reading_guide_id);
	}
}

add_action( 'acf/save_post', __NAMESPACE__ .'\save_lsb_reading_guide_action', 20 );
add_action( 'acf/save_post', __NAMESPACE__ .'\save_lsb_book_action', 20 );
add_action( 'before_delete_post', __NAMESPACE__ .'\before_delete_lsb_reading_guide_action' );

add_action( 'init', __NAMESPACE__ . '\\CPT_Reading_Guide::register_post_type' );
add_action( 'acf/init', __NAMESPACE__ . '\\CPT_Reading_Guide::add_custom_fields' );
register_activation_hook( __FILE__, __NAMESPACE__ .'\\CPT_Reading_Guide::rewrite_flush' );
