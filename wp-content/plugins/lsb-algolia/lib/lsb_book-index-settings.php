<?php

namespace LSB\Algolia;

function lsb_book_index_settings( array $settings ) {
  // Remove default by emtying the array
  $settings['attributesToIndex'] = [];
  // Create custom array
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

  // Remove default by emtying the array
  $settings['attributesToSnippet'] = [];
  // Create custom array
  $settings['attributesToSnippet'][] = 'lsb_review:20';
  $settings['attributesToSnippet'][] = 'lsb_quote:20';

  // Remove default by emtying the array
  $settings['disableTypoToleranceOnAttributes'] = [];
  // Create custom array
  $settings['disableTypoToleranceOnAttributes'][] = 'lsb_isbn';

  // Remove default by emtying the array
  $settings['customRanking'] = [];
  // Create custom array
  $settings['customRanking'][] = 'desc(lsb_supported)';
  $settings['customRanking'][] = 'desc(lsb_favorite)'; // Is on the 100 - lista
  $settings['customRanking'][] = 'desc(lsb_published_year)';
  return $settings;
}