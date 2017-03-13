<?php
function mb_blacklist_custom_post_type( array $blacklist ) {
    // ACF
    $blacklist[] = 'acf-field-group';
    $blacklist[] = 'acf-field';
    return $blacklist;
}
add_filter( 'algolia_post_types_blacklist', 'mb_blacklist_custom_post_type' );

function lsb_book_post_attributes( array $attributes, WP_Post $post ) {
    $attributes['lsb_review'] = get_field( 'lsb_acf_review', $post->ID );
    $attributes['lsb_quote'] = get_field( 'lsb_acf_quote', $post->ID );
    $attributes['lsb_isbn'] = get_field( 'lsb_acf_isbn', $post->ID );
    $attributes['lsb_supported'] = get_field( 'lsb_acf_supported', $post->ID );
    if( has_term( '100-lista', 'lsb_tax_list', $post ) ) {
        echo "is 100 lista";
        $attributes['lsb_favorite'] = true;
    } else {
        $attributes['lsb_favorite'] = false;
    }
    $attributes['lsb_published_year'] = intval(get_field( 'lsb_acf_published_year', $post->ID ));
    // Push all taxonomies by default, including custom ones.
		$taxonomy_objects = get_object_taxonomies( $post->post_type, 'objects' );
    $attributes['taxonomies_permalinks'] = array();
		foreach ( $taxonomy_objects as $taxonomy ) {
			$terms = get_the_terms( $post->ID, $taxonomy->name );
			$terms = is_array( $terms ) ? $terms : array();
      $attributes['taxonomies_permalinks'][ $taxonomy->name ] = array_map( 'get_term_link', $terms );
		}
    return $attributes;
}
add_filter( 'algolia_post_lsb_book_shared_attributes', 'lsb_book_post_attributes', 10, 2 );
add_filter( 'algolia_searchable_post_lsb_book_shared_attributes', 'lsb_book_post_attributes', 10, 2 );

function lsb_book_posts_index_settings( array $settings ) {
    $settings['attributesToIndex'] = [];

    $settings['attributesToIndex'][] = 'unordered(post_title)';
    $settings['attributesToIndex'][] = 'lsb_isbn';
    $settings['attributesToIndex'][] = 'unordered(taxonomies.lsb_tax_author)';
    $settings['attributesToIndex'][] = 'unordered(taxonomies.lsb_tax_illustrator)';
    $settings['attributesToIndex'][] = 'unordered(taxonomies.lsb_tax_translator)';
    $settings['attributesToIndex'][] = 'unordered(taxonomies.lsb_tax_cat)';
    $settings['attributesToIndex'][] = 'unordered(taxonomies.lsb_tax_series)';
    $settings['attributesToIndex'][] = 'unordered(taxonomies.lsb_tax_list)';
    $settings['attributesToIndex'][] = 'unordered(taxonomies.lsb_tax_topic)';
    $settings['attributesToIndex'][] = 'unordered(taxonomies.lsb_tax_age)';
    $settings['attributesToIndex'][] = 'unordered(taxonomies.lsb_tax_audience)';
    $settings['attributesToIndex'][] = 'unordered(lsb_review)';
    $settings['attributesToIndex'][] = 'unordered(lsb_quote)';
    $settings['attributesToSnippet'] = [];
    $settings['disableTypoToleranceOnAttributes'] = [];
    $settings['disableTypoToleranceOnAttributes'][] = 'lsb_isbn';
    $settings['customRanking'] = [];
    $settings['customRanking'][] = 'desc(lsb_supported)';
    $settings['customRanking'][] = 'desc(lsb_favorite)';
    $settings['customRanking'][] = 'desc(lsb_published_year)';
    return $settings;
}
add_filter( 'algolia_searchable_posts_index_settings', 'lsb_book_posts_index_settings' );
add_filter( 'algolia_posts_lsb_book_index_settings', 'lsb_book_posts_index_settings' );
