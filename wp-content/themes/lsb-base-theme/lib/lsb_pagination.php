<?php

add_action('pre_get_posts', 'lsb_sections_query_offset', 1 );
function lsb_sections_query_offset(&$query) {

    if ( count(get_field('lsb_sections', get_queried_object())) == 0 ) {
        return;
    }
    
    $ppp = get_option('posts_per_page');

    if ( $query->is_paged ) {
      $page_offset = ($query->query_vars['paged']-2) * $ppp;
      $query->set('offset', $page_offset );
    }
}

add_filter('found_posts', 'lsb_sections_adjust_offset_pagination', 1, 2 );
function lsb_sections_adjust_offset_pagination($found_posts, $query) {

    if ( count(get_field('lsb_sections', get_queried_object())) > 0 ) {
        $ppp = get_option('posts_per_page');
        return $found_posts + $ppp;
    }

    return $found_posts;
}