<?php

namespace LSB\Section;

function init() {

	$custom_post_type_layouts = create_post_layouts();
	$other_layouts = [create_menu_layout(), create_feed_layout(), create_hero_layout()];

	$layouts = array_merge($custom_post_type_layouts, $other_layouts);

	if( count($layouts) > 0) {

		\acf_add_local_field_group(array (
			'key' => 'lsb_acf_group_sections',
			'title' => __('Nye Seksjoner', 'lsb_sections'),
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
				array (
					array (
						'param' => 'taxonomy',
						'operator' => '==',
						'value' => 'lsb_tax_lsb_cat',
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

