<?php

namespace LSB\People;

function register_post_type() {
	$labels = array(
		'name'                => _x( 'Personer', 'Post Type General Name', 'lsb_main' ),
		'singular_name'       => _x( 'Person', 'Post Type Singular Name', 'lsb_main' ),
		'menu_name'           => __( 'Person', 'lsb_main' ),
		'parent_item_colon'   => __( '', 'lsb_main' ),
		'all_items'           => __( 'Alle personer', 'lsb_main' ),
		'view_item'           => __( 'Se person', 'lsb_main' ),
		'add_new_item'        => __( 'Legg til person', 'lsb_main' ),
		'add_new'             => __( 'Legg til ny', 'lsb_main' ),
		'edit_item'           => __( 'Rediger person', 'lsb_main' ),
		'update_item'         => __( 'Oppdater person', 'lsb_main' ),
		'search_items'        => __( 'Søk i personer', 'lsb_main' ),
		'not_found'           => __( 'Ikke funnet', 'lsb_main' ),
		'not_found_in_trash'  => __( 'Ikke funnet i søppelkurven', 'lsb_main' ),
	);
	$args = array(
		'label'               => __( 'lsb-person', 'lsb_main' ),
		'description'         => __( 'Personer', 'lsb_main' ),
		'labels'              => $labels,
		'supports'            => array( 'title' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
		'rewrite'             => array('slug' => 'person'),
	);

	\register_post_type( 'lsb-person', $args );
}