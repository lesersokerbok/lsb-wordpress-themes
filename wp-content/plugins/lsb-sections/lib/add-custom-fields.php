<?php

namespace LSB\Section;

function create_layout_field($post_type, $label) {
	$key = "lsb_acf_section_layout_{$post_type}";

	return array (
		'key' => $key,
		'name' => $post_type,
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

function add_custom_fields() {

	$layouts = array();

	foreach (get_post_types(array( '_builtin' => false ), 'objects') as $key => $post_type) {
		$layouts[] = create_layout_field($post_type->name, $post_type->labels->name);
	}

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
