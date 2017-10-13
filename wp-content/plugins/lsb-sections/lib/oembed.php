<?php

namespace LSB\Section;

function create_oembeds_layout() {
  $layout_key = 'lsb_acf_section_layout_oembeds';
	$layout_name = 'lsb_oembeds';
	$layout_label = __('Media', 'lsb_sections');

  $layout_field = create_layout_field($layout_key, $layout_name, $layout_label);
  $layout_field['sub_fields'][] = create_title_field($layout_key);
  $layout_field['sub_fields'][] = create_subtitle_field($layout_key);

  $layout_field['sub_fields'][] = create_text_field($layout_key);

  return $layout_field;
}