<?php

namespace LSB\Algolia;

function add_to_blacklist( array $blacklist ) {
  // ACF should not be indexed
  $blacklist[] = 'acf-field-group';
  $blacklist[] = 'acf-field';
  $blacklist[] = 'custom_css';
  $blacklist[] = 'customize_changeset';
  $blacklist[] = 'wpephpcompat_jobs';
  return $blacklist;
}