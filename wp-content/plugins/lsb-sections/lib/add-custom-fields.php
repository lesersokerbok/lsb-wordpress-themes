<?php

namespace LSB\Section;

function create_layout_field($key, $name, $label) {

	return array (
		'key' => $key,
		'name' => $name,
		'label' => $label,
		'display' => 'row',
		'sub_fields' => array (
			array (
				'key' => "{$key}_title",
				'label' => __('Overskrift', 'lsb_sections'),
				'name' => 'lsb_title',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array (
				'key' => "{$key}_subtitle",
				'label' => __('Underoverskrift', 'lsb_sections'),
				'name' => 'lsb_subtitle',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
		),
		'min' => '',
		'max' => '',
	);
}

function create_select_field($key, $name, $label, $choices) {
	return array (
			'key' => $key,
			'name' => $name,
			'label' => $label,
			'type' => 'radio',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => $choices,
			'allow_null' => 1,
			'other_choice' => 0,
			'save_other_choice' => 0,
			'default_value' => '',
			'layout' => 'horizontal',
			'return_format' => 'value',
		);
}

function create_taxonomy_field($key, $name, $label, $is_multi_select) {
	return array (
		'key' => $key,
		'label' => $label,
		'name' => $name,
		'type' => 'taxonomy',
		'taxonomy' => $name,
		'field_type' => $is_multi_select ? 'multi_select' : 'select',
		'return_format' => 'object',
		'multiple' => 0,
		'add_term' => 0
	);
}

function create_custom_post_type_layouts() {
	$layouts = array ();

	foreach (get_post_types(array( '_builtin' => false ), 'objects') as $key => $post_type) {
		$filters = array_map( function($taxonomy) { return $taxonomy->label; }, get_object_taxonomies( $post_type->name, 'objects' ));
		$layout_key = "lsb_acf_section_layout_{$post_type->name}";

		$layout_field = create_layout_field($layout_key, $post_type->name, $post_type->labels->name);
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

		$layouts[] = $layout_field;
	}
	return $layouts;
}

function create_menu_layout() {
	$layout_key = 'lsb_acf_section_layout_menu_navigation';
	$name = 'nav_menu';
	$label = __('Meny(er)', 'lsb_sections');
	
	$layout_field = create_layout_field($layout_key, 'lsb_menu_nav', __('Navigasjon', 'lsb_sections'));
	$layout_field['sub_fields'][] = create_taxonomy_field($layout_key.'_'.$name, $name, $label, false );

	return $layout_field;
}

function add_custom_fields() {

	$custom_post_type_layouts = create_custom_post_type_layouts();
	$menu_layouts = [create_menu_layout()];

	$layouts = array_merge($custom_post_type_layouts, $menu_layouts);

	if( function_exists('acf_add_local_field_group') && count($layouts) > 0) {

		acf_add_local_field_group(array (
			'key' => 'lsb_acf_group_sections',
			'title' => __('Seksjoner', 'lsb_sections'),
			'fields' => array (
				array (
					'key' => 'lsb_acf_sections',
					'label' => 'Seksjoner',
					'name' => 'lsb_sections',
					'type' => 'flexible_content',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'button_label' => __('Legg til seksjon', 'lsb_sections'),
					'min' => '',
					'max' => '',
					'layouts' => $layouts
				),
			),
			'location' => array (
				array (
					array (
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'post',
					),
				),
				array (
					array (
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'page',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => 1,
			'description' => '',
		));
	}

}
