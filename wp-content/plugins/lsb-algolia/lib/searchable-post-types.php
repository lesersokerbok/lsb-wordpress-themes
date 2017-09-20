<?php

namespace LSB\Algolia;

function filter_searchable_post_types($post_types) {
  if( post_type_exists( 'lsb_book' ) ) {
    // If post_type lsb_book exists it should be the only searchable post.
    // Used by Algolia backend take over
    $post_types = [];
    $post_types[] = 'lsb_book';
  }
  return $post_types;
}