<?php

namespace LSB\Algolia;

function add_to_image_sizes($sizes) {
  $sizes[] = 'medium';
  return $sizes;
}
