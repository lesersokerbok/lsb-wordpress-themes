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
$post = Timber::query_post();
$context['post'] = $post;
$context['title'] = get_the_title( get_option('page_for_posts', true));

Timber::render( array( 'singular-' . $post->ID . '.twig', 'singular-' . $post->post_type . '.twig', 'singular.twig' ), $context );
