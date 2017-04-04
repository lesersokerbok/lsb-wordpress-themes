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
			'supports'					=> array( 'title' ),
			'hierarchical'			=> false,
			'public'						=> true,
			'show_ui'						=> true,
			'show_in_menu'			=> true,
			'show_in_nav_menus'	=> true,
			'show_in_admin_bar'	=> true,
			'menu_position'			=> 5,
			'can_export'				=> true,
			'has_archive'				=> false,
			'exclude_from_search'	=> false,
			'publicly_queryable'	=> true,
			'capability_type'			=> 'page',
			'rewrite'							=> array('slug' => _x('leseopplegg', 'The slug for lsb_reading_guide', 'lsb_reading_guides'), 'with_front' => 0),
		);
		register_post_type( 'lsb_reading_guide', $args );
	}

	static public function rewrite_flush() {
		self::register_post_type();
		flush_rewrite_rules();
	}
}
