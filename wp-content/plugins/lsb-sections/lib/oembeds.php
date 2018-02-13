<?php

namespace LSB\Section;

function create_oembeds_layout() {
  $layout_key = 'lsb_acf_section_layout_oembeds';
	$layout_name = 'lsb_oembeds';
	$layout_label = __('Multimedia (oembeds)', 'lsb_sections');

  $layout_field = create_layout_field($layout_key, $layout_name, $layout_label);
  $layout_field['sub_fields'][] = create_title_field($layout_key);
  $layout_field['sub_fields'][] = create_subtitle_field($layout_key);
  $layout_field['sub_fields'][] = create_link_field($layout_key.'_title_link', 'lsb_title_link', __('Overskriftslenke', 'lsb_sections'));

  $layout_field['sub_fields'][] = array (
    'key' => $layout_key.'_items',
    'label' => __('Oembeds', 'lsb_boksok'),
    'instructions' => __('YouTube, SoundCloud, Issuu etc. ', 'lsb_boksok'),
    'name' => 'lsb_items',
    'type' => 'repeater',
    'button_label' => __('Legg til oembed', 'lsb_boksok'),
    'sub_fields' => array (
      array(
        'key' => $layout_key.'_items'.'_item',
        'label' => __('Oembed', 'lsb_boksok'),
        'instructions' => __('Url direkte til video, lyd, bok etc.', 'lsb_boksok'),
        'name' => 'lsb_oembed',
        'type' => 'oembed',
        'required' => 1
      ),
    ),
  );

  return $layout_field;
}