<?php

namespace LSB\Section;

function create_hero_layout() {
  $layout_key = 'lsb_acf_section_layout_hero';
	$layout_name = 'lsb_hero';
	$layout_label = __('Hero', 'lsb_sections');

  $layout_field = create_layout_field($layout_key, $layout_name, $layout_label);
  $layout_field['sub_fields'][] = create_text_field($layout_key);

  return $layout_field;
}