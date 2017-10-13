<?php

namespace LSB\Section;

function create_layout_field($key, $name, $label) {
	return array (
		'key' => $key,
		'name' => $name,
		'label' => $label,
		'display' => 'row',
		'sub_fields' => [],
		'min' => '',
		'max' => '',
	);
}

function create_title_field($key) {
	return array (
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
	);
}

function create_subtitle_field($key) {
	return array (
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
	);
}

function create_text_field($key) {
	return array (
		'key' => "{$key}_text",
		'label' => __('Tekst', 'lsb_sections'),
		'name' => 'lsb_text',
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
	);
}

function create_select_field($key, $name, $label, $choices, $default = null) {
	return array (
		'key' => $key,
		'name' => $name,
		'label' => $label,
		'type' => 'radio',
		'instructions' => '',
		'required' => $default ? 1 : 0,
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
		'default_value' => $default ? $default : '',
		'layout' => 'horizontal',
		'return_format' => 'value',
	);
}

function create_taxonomy_field($key, $name, $label, $is_multi_select) {
	return array (
		'key' => $key,
		'name' => $name,
		'label' => $label,
		'type' => 'taxonomy',
		'taxonomy' => $name,
		'field_type' => $is_multi_select ? 'multi_select' : 'select',
		'return_format' => 'object',
		'multiple' => 0,
		'add_term' => 0
	);
}

function create_url_field($key, $name, $label) {
	return array (
		'key' => $key,
		'name' => $name,
		'label' => $label,
		'type' => 'url',
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
	);
}