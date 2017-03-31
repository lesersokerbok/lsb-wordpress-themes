<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.2
 */

$templates = array( 'archive.twig', 'index.twig' );

$context = Timber::get_context();

$context['archive']['title'] = 'Archive';
$context['archive']['posts'] = Timber::get_posts();

if ( is_home() ) {
	$context['archive']['title'] = get_the_title( get_option('page_for_posts', true));
} else if ( is_day() ) {
	$context['archive']['title'] = sprintf(__('Daglig arkiv: %s', 'lsb'), get_the_date());
} else if ( is_month() ) {
	$context['archive']['title'] = sprintf(__('Månedlig arkiv: %s', 'lsb'), get_the_date('F Y'));
} else if ( is_year() ) {
	$context['archive']['title'] = sprintf(__('Årlig arkiv: %s', 'lsb'), get_the_date('Y'));
} else if ( is_tag() ) {
	$context['archive']['title'] = single_tag_title( '', false );
} else if ( is_category() ) {
	$context['archive']['title'] = single_cat_title( '', false );
	array_unshift( $templates, 'archive-' . get_query_var( 'cat' ) . '.twig' );
} else if ( is_post_type_archive() ) {
	$context['archive']['title'] = post_type_archive_title( '', false );
	array_unshift( $templates, 'archive-' . get_post_type() . '.twig' );
}

Timber::render( $templates, $context );
