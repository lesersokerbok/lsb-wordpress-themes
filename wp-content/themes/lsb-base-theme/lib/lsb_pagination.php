<?php

add_action('pre_get_posts', 'lsb_sections_query_offset', 1 );
function lsb_sections_query_offset(&$query) {

    if ( count(get_field('lsb_sections', get_queried_object())) == 0 ) {
        return;
    }
    
    /* 
     * If the first page in the archive has lsb_sections it will not 
     * show the actual posts so we need to let WP know changing the offsetting.
     */


    $ppp = get_option('posts_per_page');

    if ( $query->is_paged ) {
        // Paged start at 1, not 0.
        // On page 2 offset should be 0
        // On page 3 offset should be a full page of posts (ppp)
        $page_offset = ($query->query_vars['paged']-2) * $ppp;
        $query->set('offset', $page_offset );
    }
}

add_filter('found_posts', 'lsb_sections_adjust_offset_pagination', 1, 2 );
function lsb_sections_adjust_offset_pagination($found_posts, $query) {

    if ( count(get_field('lsb_sections', get_queried_object())) > 0 ) {
        // If there is are lsb_sections add a full page of posts (ppp)
        // to the count so pagination artitmatic is correct.
        $ppp = get_option('posts_per_page');
        return $found_posts + $ppp;
    }

    return $found_posts;
}