<?php

namespace LSB\Translations;

function init() {

	$languages = [
		'so' => 'سۆرانی / Kurdisk (sorani)',
		'ur' => 'اردو / Urdu',
		'sr' => 'Soomaali / Somali',
		'tr' => 'Türkçe / Tyrkisk',
		'ti' => 'ትግርኛ / Tigrinja',
		'en' => 'English / Engelsk'
	];

	$groups = array_map(function($key, $label) {
		$group = create_group($key, $label);
		$group['sub_fields'] = create_fields();
		return $group;
	}, array_keys($languages), $languages);

	\acf_add_local_field_group(array (
		'key' => 'lsb_acf_group_translations',
		'title' => __('Oversettelser', 'lsb_sections'),
		'fields' => $groups,
		'location' => array (
			array (
				array (
					'param' => 'lsb_tax_audience',
					'operator' => '==',
					'value' => 'ny-i-norge',
				),
			),
			array (
				array (
					'param' => 'taxonomy',
					'operator' => '==',
					'value' => 'lsb_tax_lsb_cat',
				),
			),
		),
		'menu_order' => 10,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));
}