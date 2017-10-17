<?php

namespace LSB\Section;

function create_hero_layout() {
  $layout_key = 'lsb_acf_section_layout_hero';
	$layout_name = 'lsb_hero';
	$layout_label = __('Hero', 'lsb_sections');

  $layout_field = create_layout_field($layout_key, $layout_name, $layout_label);
  $layout_field['sub_fields'][] = create_text_field($layout_key.'_text', 'lsb_text', __('Tekst', 'lsb_sections'));
  $layout_field['sub_fields'][] = create_text_field($layout_key.'_action_text', 'lsb_action_text', __('Action tekst', 'lsb_sections'));
  $layout_field['sub_fields'][] = create_link_field($layout_key.'_action_link', 'lsb_action_link', __('Action lenke', 'lsb_sections'));

  return $layout_field;
}