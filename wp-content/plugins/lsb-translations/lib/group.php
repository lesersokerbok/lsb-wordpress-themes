<?php

namespace LSB\Translations;

function create_group($key, $label) {
	$isRtl = $key === 'so' || $key === 'ur';
	$isSigns = $key === 'so' || $key === 'ur' || $key === 'ti';
	return array (
    'key' => 'lsb_acf_translation_' . $key,
    'label' => $label,
		'name' => 'lsb_translation_' . $key,
		'type' => 'group',
		'layout' => 'block',
		'sub_fields' => [],
		'wrapper' => array (
			'width' => '',
			'class' => ($isRtl ? 'is-rtl' : '') . ' ' . ($isSigns ? 'is-signs' : ''),
			'id' => '',
		)
	);
}