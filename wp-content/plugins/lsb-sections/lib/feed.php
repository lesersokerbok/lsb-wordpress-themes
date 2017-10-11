<?php

namespace LSB\Section;

function create_feed_layout() {
	$layout_key = 'lsb_acf_section_layout_feed';
	$layout_name = 'lsb_feed';
	$layout_label = __('RSS Strøm', 'lsb_sections');

	$layout_field = create_layout_field($layout_key, $layout_name, $layout_label);
	$layout_field['sub_fields'][] = create_url_field($layout_key.'_url', 'lsb_feed_url', __('RSS URL', 'lsb_sections'));
	$layout_field['sub_fields'][] = create_select_field($layout_key.'_layout', 'lsb_feed_layout', __('Layout', 'lsb_sections'), [ 'lsb_book'=> __('Som bøker', 'lsb_sections'), 'post' => __('Som innlegg', 'lsb_sections') ], 'lsb_book' );

	return $layout_field;
}