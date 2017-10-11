<?php

namespace LSB\Section;

function create_post_layout($post_type) {
	$layout_key = "lsb_acf_section_layout_{$post_type->name}";
	$layout_name = $post_type->name;
	$layout_label = $post_type->label;

	$filters = array_map( function($taxonomy) { return $taxonomy->label; }, get_object_taxonomies( $post_type->name, 'objects' ));

	$layout_field = create_layout_field($layout_key, $layout_name, $layout_label);
	$layout_field['sub_fields'][] = create_select_field($layout_key.'filter', 'lsb_filter', __('Filtrer', 'lsb_sections'), $filters);

	foreach ($filters as $name => $label) {
		$taxonomy = create_taxonomy_field($layout_key.'filter'.$name, $name, $label, false);
		$taxonomy['conditional_logic'] =  array (
			array (
				array (
					'field' => $layout_key.'filter',
					'operator' => '==',
					'value' => $name,
				),
			),
		);
		$layout_field['sub_fields'][] = $taxonomy;
	}

	return $layout_field;
}

function create_post_layouts() {
	$layouts = array ();

	foreach (get_post_types(array( '_builtin' => false ), 'objects') as $key => $post_type) {
		$layouts[] = create_post_layout($post_type);
	}
	return $layouts;
}