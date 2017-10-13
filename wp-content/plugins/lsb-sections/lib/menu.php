<?php

namespace LSB\Section;

function create_menu_layout() {
	$layout_key = 'lsb_acf_section_layout_menu_navigation';
	$name = 'nav_menu';
	$label = __('Meny(er)', 'lsb_sections');

	$layout_field = create_layout_field($layout_key, 'lsb_menu_nav', __('Navigasjon', 'lsb_sections'));
	$layout_field['sub_fields'][] = create_title_field($layout_key);
	$layout_field['sub_fields'][] = create_subtitle_field($layout_key);
	$layout_field['sub_fields'][] = create_select_field($layout_key.'_layout',
	'lsb_section_layout',
	 __('Layout', 'lsb_sections'),
	 [
		'pills'=> __('Pills', 'lsb_sections'),
		'blurb'=> __('Blurbs', 'lsb_sections')
	],
		'pills' );
	$layout_field['sub_fields'][] = create_taxonomy_field($layout_key.'_'.$name, $name, $label, false );

	return $layout_field;
}