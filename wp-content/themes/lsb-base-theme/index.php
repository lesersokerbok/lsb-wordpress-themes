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

$templates = array( 'archive.twig', 'base.twig' );

$context = Timber::get_context();

$context['title'] = __('Arkiv', 'lsb');
$context['description'] = term_description();
$context['post_type'] = 'post';
$context['posts'] = Timber::get_posts(false, LSB_Post::class);
$context['pagination'] = Timber::get_pagination();

if ( is_home() ) {
	$context['title'] = get_the_title( get_option('page_for_posts', true));
} else if ( is_day() ) {
	$context['title'] = sprintf(__('Daglig arkiv: %s', 'lsb'), get_the_date());
} else if ( is_month() ) {
	$context['title'] = sprintf(__('Månedlig arkiv: %s', 'lsb'), get_the_date('F Y'));
} else if ( is_year() ) {
	$context['title'] = sprintf(__('Årlig arkiv: %s', 'lsb'), get_the_date('Y'));
} else if ( is_tag() ) {
	$context['title'] = single_tag_title( '', false );
} else if ( is_category() ) {
	$context['title'] = single_cat_title( '', false );
	array_unshift( $templates, 'archive-' . get_query_var( 'cat' ) . '.twig' );
} else if ( is_post_type_archive() ) {
	$context['title'] = post_type_archive_title( '', false );
	$context['post_type'] = get_post_type();
	if($context['pagination']['prev']) {
		$context['pagination']['prev']['title'] = __('Forrige side', 'lsb');
	}
	if($context['pagination']['next']) {
		$context['pagination']['next']['title'] = __('Neste side', 'lsb');
	}
	array_unshift( $templates, 'archive-' . get_post_type() . '.twig' );
}

if($context['breadcrumbs_menu']->is_root_item()) {
	$context['title'] = null;
}

Timber::render( $templates, $context );