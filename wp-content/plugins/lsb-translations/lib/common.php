<?php

namespace LSB\Translations;

function create_fields() {
	return array(
		array (
			'key' => 'lsb_acf_title',
			'label' => __('Tittel', 'lsb_translations'),
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
			'maxlength' => '',
			'rows' => '',
			'new_lines' => '',
		),
		array (
			'key' => 'lsb_acf_translation',
			'label' => __('Beskrivelse', 'lsb_translations'),
			'name' => 'lsb_description',
			'type' => 'textarea',
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
			'maxlength' => '',
			'rows' => '',
			'new_lines' => 'wpautop',
		)
	);
}