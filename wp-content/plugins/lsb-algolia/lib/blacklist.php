<?php

namespace LSB\Algolia;

function add_to_blacklist( array $blacklist ) {
  // ACF should not be indexed
  $blacklist[] = 'acf-field-group';
  $blacklist[] = 'acf-field';
  $blacklist[] = 'custom_css';
  $blacklist[] = 'customize_changeset';
  $blacklist[] = 'wpephpcompat_jobs';

  // If lsb_book exists searchable_post_types is set
  // to only lsb_book and therefor the need for this index is obsolete
  $blacklist[] = 'lsb_book';

  return $blacklist;
}