<?php

namespace LSB\Algolia;
use \WP_Post;

function lsb_book_attributes( array $attributes, WP_Post $post ) {
  // Add the ACF fields as attributes
  $attributes['lsb_review'] = get_field( 'lsb_acf_review', $post->ID );
  $attributes['lsb_quote'] = get_field( 'lsb_acf_quote', $post->ID );
  $attributes['lsb_isbn'] = get_field( 'lsb_acf_isbn', $post->ID );
  $attributes['lsb_supported'] = get_field( 'lsb_acf_supported', $post->ID );
  $attributes['lsb_published_year'] = intval(get_field( 'lsb_acf_published_year', $post->ID ));

  // If book is part of 100-lista add it as a lsb_favorite, to be used later in the ranking algoritm
  $attributes['lsb_favorite'] = has_term( '100-lista', 'lsb_tax_list', $post ) ? true : false;

  // Add all taxonomies by default, including custom ones.
  // Include permalinks so it is possible to link from search results.
  $taxonomy_objects = get_object_taxonomies( $post->post_type, 'objects' );
  $attributes['taxonomies_permalinks'] = array();

  foreach ( $taxonomy_objects as $taxonomy ) {
    $terms = get_the_terms( $post->ID, $taxonomy->name );
    $terms = is_array( $terms ) ? $terms : array();
    $attributes['taxonomies_permalinks'][ $taxonomy->name ] = array_map( 'get_term_link', $terms );
  }
  
  return $attributes;
}