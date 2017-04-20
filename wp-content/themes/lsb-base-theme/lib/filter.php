<?php

function  get_lsb_cat_filter() {
	$lsb_cat_filter = get_query_var( 'filter', 'none' );
	if( is_tax('lsb_tax_lsb_cat') ) {
		$taxonomy = get_queried_object();
		$lsb_cat_filter = $taxonomy->slug;
	}
	return $lsb_cat_filter;
}

function  get_lsb_cat_filter_term() {
	return get_term_by('slug', get_lsb_cat_filter(), 'lsb_tax_lsb_cat');
}

function lsb_add_lsb_cat_filter( $public_query_vars ) {
	$public_query_vars[] = 'filter';
	return $public_query_vars;
}

function lsb_append_lsb_cat_filter( $object ) {
	$lsb_cat_filter = get_lsb_cat_filter();
	if(is_array($object)) {
		$object[] = 'filter-' . $lsb_cat_filter;
	} else if(is_string($object) && $lsb_cat_filter !== 'none' && strpos($object, 'hovedkategori') === false) {
		$object = add_query_arg( array('filter' => $lsb_cat_filter), $object );
	}
	return $object;
}

function lsb_cat_filter_posts($query) {

	if( isset($query->query['post_type']) && $query->query['post_type'] !== 'lsb_book' ) {
		// if the query is not for books do not add filter
		return $query;
	} if( isset($query->query['lsb_tax_author']) || isset($query->query['lsb_tax_illustrator']) || isset($query->query['lsb_tax_translator']) ) {
		// if the query is for a specific creator do not add filter
		return $query;
	} else {
		// append filter
		$lsb_cat_filter = get_lsb_cat_filter();
		if($lsb_cat_filter !== 'none') {
			$query->set('lsb_tax_lsb_cat', $lsb_cat_filter);
		}
		return $query;
	}
}

add_filter('query_vars', 'lsb_add_lsb_cat_filter', 10 );
add_filter('body_class', 'lsb_append_lsb_cat_filter', 10 );
add_filter('term_link', 'lsb_append_lsb_cat_filter', 10 );
add_filter('post_type_link', 'lsb_append_lsb_cat_filter', 10 );
add_action('pre_get_posts', 'lsb_cat_filter_posts', 10 );
