<?php

namespace LSB\Section;

function create_feed_layout() {
	$layout_key = 'lsb_acf_section_layout_feed';
	$layout_name = 'lsb_feed';
	$layout_label = __('RSS Strøm', 'lsb_sections');

	$layout_field = create_layout_field($layout_key, $layout_name, $layout_label);
	$layout_field['sub_fields'][] = create_url_field($layout_key.'_url', 'lsb_feed_url', __('RSS URL', 'lsb_sections'));
	$layout_field['sub_fields'][] = create_select_field($layout_key.'_layout', 'lsb_section_layout', __('Layout', 'lsb_sections'), [ 'card'=> __('Cards', 'lsb_sections'), 'teaser' => __('Teasers', 'lsb_sections') ], 'card' );

	return $layout_field;
}