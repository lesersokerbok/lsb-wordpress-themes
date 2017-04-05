<?php

namespace LSB\ReadingGuides;

class CPT_Reading_Guide {

	static public function register_post_type() {
		$labels = array(
			'name'							=> _x( 'Leseopplegg', 'Post Type General Name', 'lsb_reading_guides' ),
			'singular_name'			=> _x( 'Leseopplegg', 'Post Type Singular Name', 'lsb_reading_guides' ),
			'menu_name'					=> __( 'Leseopplegg', 'lsb_reading_guides' ),
			'parent_item_colon'	=> __( '', 'lsb_reading_guides' ),
			'all_items'					=> __( 'Alle leseopplegg', 'lsb_reading_guides' ),
			'view_item'					=> __( 'Se leseopplegg', 'lsb_reading_guides' ),
			'add_new_item'			=> __( 'Legg til leseopplegg', 'lsb_reading_guides' ),
			'add_new'						=> __( 'Legg til ny', 'lsb_reading_guides' ),
			'edit_item'					=> __( 'Rediger leseopplegg', 'lsb_reading_guides' ),
			'update_item'				=> __( 'Oppdater leseopplegg', 'lsb_reading_guides' ),
			'search_items'			=> __( 'Søk i leseopplegger', 'lsb_reading_guides' ),
			'not_found'					=> __( 'Ikke funnet', 'lsb_reading_guides' ),
			'not_found_in_trash'=> __( 'Ikke funnet i søppelkurven', 'lsb_reading_guides' ),
		);
		$args = array(
			'label'							=> __( 'lsb_reading_guide', 'lsb_reading_guides' ),
			'description'				=> __( 'Leseopplegg', 'lsb_reading_guides' ),
			'labels'						=> $labels,
			'supports'					=> false,
			'hierarchical'			=> false,
			'public'						=> true,
			'show_ui'						=> true,
			'show_in_menu'			=> true,
			'show_in_nav_menus'	=> true,
			'show_in_admin_bar'	=> true,
			'menu_position'			=> 5,
			'can_export'				=> true,
			'has_archive'				=> true,
			'exclude_from_search'	=> true,
			'publicly_queryable'	=> true,
			'capability_type'			=> 'page',
			'rewrite'							=> array('slug' => _x('leseopplegg', 'The slug for lsb_reading_guide', 'lsb_reading_guides'), 'with_front' => 0),
		);
		register_post_type( 'lsb_reading_guide', $args );
	}

	static public function add_custom_fields() {

		if( !function_exists('acf_add_local_field_group') ) {
			return;
		}

		acf_add_local_field_group(array (
			'key' => 'lsb_acf_group_reading_guide_book',
			'title' => __( 'Boken', 'lsb_reading_guides' ),
			'fields' => array (
				array (
					'key' => 'lsb_acf_reading_guide_book',
					'label' => 'Book',
					'name' => 'lsb_book',
					'type' => 'post_object',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'post_type' => array (
						0 => 'lsb_book',
					),
					'taxonomy' => array (
					),
					'allow_null' => 0,
					'multiple' => 0,
					'return_format' => 'object',
					'ui' => 1,
				),
				array (
					'key' => 'lsb_acf_reading_guide_intro',
					'label' => __( 'Introduksjon', 'lsb_reading_guides' ),
					'name' => 'lsb_intro',
					'type' => 'wysiwyg',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'tabs' => 'all',
					'toolbar' => 'basic',
					'media_upload' => 0,
					'delay' => 0,
				),
			),
			'location' => array (
				array (
					array (
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'lsb_reading_guide',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'acf_after_title',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => 1,
			'description' => '',
		));

		acf_add_local_field_group(array (
			'key' => 'lsb_acf_group_reading_guide_steps',
			'title' => __( 'Lesesteg', 'lsb_reading_guides' ),
			'fields' => array (
				array (
					'key' => 'lsb_acf_reading_guide_pre_reading',
					'label' => __( 'Førlesing', 'lsb_reading_guides' ),
					'name' => 'lsb_pre_reading',
					'type' => 'wysiwyg',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'tabs' => 'all',
					'toolbar' => 'basic',
					'media_upload' => 0,
					'delay' => 0,
				),
				array (
					'key' => 'lsb_acf_reading_guide_reading',
					'label' => __( 'Leseoppdrag', 'lsb_reading_guides' ),
					'name' => 'lsb_reading',
					'type' => 'wysiwyg',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'tabs' => 'all',
					'toolbar' => 'basic',
					'media_upload' => 0,
					'delay' => 0,
				),
				array (
					'key' => 'lsb_acf_reading_guide_post_reading',
					'label' => __( 'Etterlesing', 'lsb_reading_guides' ),
					'name' => 'lsb_post_reading',
					'type' => 'wysiwyg',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'tabs' => 'all',
					'toolbar' => 'basic',
					'media_upload' => 0,
					'delay' => 0,
				),
			),
			'location' => array (
				array (
					array (
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'lsb_reading_guide',
					),
				),
			),
			'menu_order' => 1,
			'position' => 'acf_after_title',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => 1,
			'description' => '',
		));
	}

	static public function rewrite_flush() {
		self::register_post_type();
		flush_rewrite_rules();
	}
}
