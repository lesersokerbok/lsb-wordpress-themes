<?php
/**
 * The Template for displaying all single posts
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::get_context();
$context['post'] = new LSB_Post();

if (is_singular('page')) {

} else if ( is_singular('post') ) {
	$context['title']['text'] = get_the_title( get_option('page_for_posts', true));
	$context['title']['link'] = get_the_permalink( get_option('page_for_posts', true));
} else if ( is_singular() ) {
	//Get post type
	$post_type_obj = get_post_type_object( get_post_type() );
	//Get post type's label
	$title = apply_filters('post_type_archive_title', $post_type_obj->labels->name );

	$context['title']['text'] = $title;
	$context['title']['link'] = get_post_type_archive_link( get_post_type() );
}

Timber::render( array( 'singular-' . $post->ID . '.twig', 'singular-' . $post->post_type . '.twig', 'singular.twig' ), $context );
