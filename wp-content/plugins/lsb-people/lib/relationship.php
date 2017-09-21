<?php

namespace LSB\People;

function register_relationship() {

	\acf_add_local_field_group(array (
		'key' => 'lsb_custom_field_group_people',
		'title' => __('Personer', 'lsb_main'),
		'fields' => array (
			array (
				'key' => 'lsb_custom_field_person_relationship',
				'label' => 'Legg til personer',
				'name' => 'person_relationship',
				'prefix' => '',
				'type' => 'relationship',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'post_type' => array (
					0 => 'lsb-person',
				),
				'taxonomy' => '',
				'filters' => array (
					0 => 'search',
				),
				'elements' => '',
				'max' => '',
				'return_format' => 'object',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template-people.php',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
	));
}