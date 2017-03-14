<?php

namespace LSB\Boksok\Core;

class LsbBook {
  public function __construct() {
    // Custom post types
    add_action('init', array($this, 'register_post_type_lsb_book'));

    // Custom tax types
    add_action('init', array($this, 'register_tax_lsb_cat'));
    add_action('init', array($this, 'register_tax_lsb_audience'));
    add_action('init', array($this, 'register_tax_lsb_age'));
    add_action('init', array($this, 'register_tax_lsb_author'));
    add_action('init', array($this, 'register_tax_lsb_illustrator'));
    add_action('init', array($this, 'register_tax_lsb_translator'));
    add_action('init', array($this, 'register_tax_lsb_publisher'));
    add_action('init', array($this, 'register_tax_lsb_genre'));
    add_action('init', array($this, 'register_tax_lsb_customization'));
    add_action('init', array($this, 'register_tax_lsb_topic'));
    add_action('init', array($this, 'register_tax_lsb_language'));
    add_action('init', array($this, 'register_lsb_tax_list'));
    add_action('init', array($this, 'register_lsb_tax_series'));

    // Added fields with acf
    add_action('acf/init', array($this, 'register_lsb_acf_book_meta'));
    add_action('acf/init', array($this, 'register_lsb_acf_book_content'));
    add_action('acf/init', array($this, 'register_lsb_acf_book_oembeds'));
    add_action('acf/init', array($this, 'register_lsb_acf_tax_meta'));
  }

  public function register_post_type_lsb_book() {
    register_post_type('lsb_book',
      array(
        'label' => __('Bøker', 'lsb_boksok'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'post',
        'map_meta_cap' => true,
        'hierarchical' => false,
        'rewrite' => array('slug' => _x('bok', 'lsb_book slug', 'lsb_boksok'), 'with_front' => 1),
        'query_var' => true,
        'has_archive' => false,
        'menu_position' => '5',
        'supports' => array('title','excerpt','comments','revisions','author','thumbnail'),
        'labels' => array (
          'name'          => __('Bøker', 'lsb_boksok'),
          'singular_name' => _x('Bok', 'Bøker - entall', 'lsb_boksok'),
          'menu_name'     => _x('Bøker', 'Bøker - menynavn', 'lsb_boksok'),
          'add_new'       => __('Legg til', 'lsb_boksok'),
          'add_new_item'  => __('Legg til ny bok', 'lsb_boksok'),
          'edit'          => __('Rediger', 'lsb_boksok'),
          'edit_item'     => __('Rediger bok', 'lsb_boksok'),
          'new_item'      => __('Ny bok', 'lsb_boksok'),
          'view'          => __('Vis', 'lsb_boksok'),
          'view_item'     => __('Vis bok', 'lsb_boksok'),
          'search_items'  => __('Søk i bøker', 'lsb_boksok'),
          'not_found'     => __('Fant ingen bøker', 'lsb_boksok'),
          'not_found_in_trash' => __('Fant ingen bøker i papirkurven', 'lsb_boksok'),
          'parent'        => __('Forelderbok', 'lsb_boksok'),
        )
      )
    );
  }

  public function register_tax_lsb_author() {
    register_taxonomy( 'lsb_tax_author',
      array(
        0 => 'lsb_book',
      ),
      array( 'hierarchical' => false,
      	'label' => __('Forfattere', 'lsb_boksok'),
      	'show_ui' => true,
      	'query_var' => true,
      	'rewrite' => array( 'slug' => _x('forfatter', 'lsb_tax_author slug', 'lsb_boksok') ),
      	'show_admin_column' => false,
      	'labels' => array (
          'search_items' => __('Forfattere', 'lsb_boksok'),
          'popular_items' => __('Populære', 'lsb_boksok'),
          'all_items' => __('Alle', 'lsb_boksok'),
          'parent_item' => __('Forelder', 'lsb_boksok'),
          'parent_item_colon' => __('Forelder: ', 'lsb_boksok'),
          'edit_item' => __('Rediger forfatter', 'lsb_boksok'),
          'update_item' => __('Oppdater forfatter', 'lsb_boksok'),
          'add_new_item' => __('Legg til forfatter', 'lsb_boksok'),
          'new_item_name' => _x('Forfatter', 'Ny-forfatter-tittel', 'lsb_boksok'),
          'separate_items_with_commas' => __('Separer med komma', 'lsb_boksok'),
          'add_or_remove_items' => __('Legg til eller fjern', 'lsb_boksok'),
          'choose_from_most_used' => __('Velg fra mest brukte', 'lsb_boksok'),
        )
      )
    );
  }

  public function register_tax_lsb_illustrator() {
    register_taxonomy( 'lsb_tax_illustrator',
      array(
        0 => 'lsb_book',
      ),
      array( 'hierarchical' => false,
      	'label' => __('Illustratører', 'lsb_boksok'),
      	'show_ui' => true,
      	'query_var' => true,
      	'rewrite' => array( 'slug' => _x('illustrator', 'lsb_tax_illustrator slug', 'lsb_boksok') ),
      	'show_admin_column' => false,
      	'labels' => array (
          'search_items' => __('Illustratører', 'lsb_boksok'),
          'popular_items' => __('Populære', 'lsb_boksok'),
          'all_items' => __('Alle', 'lsb_boksok'),
          'parent_item' => __('Forelder', 'lsb_boksok'),
          'parent_item_colon' => __('Forelder: ', 'lsb_boksok'),
          'edit_item' => __('Rediger illustratør', 'lsb_boksok'),
          'update_item' => __('Oppdater illustratør', 'lsb_boksok'),
          'add_new_item' => __('Legg til illustratør', 'lsb_boksok'),
          'new_item_name' => _x('Illustratør', 'Ny-illustratør-tittel', 'lsb_boksok'),
          'separate_items_with_commas' => __('Separer med komma', 'lsb_boksok'),
          'add_or_remove_items' => __('Legg til eller fjern', 'lsb_boksok'),
          'choose_from_most_used' => __('Velg fra mest brukte', 'lsb_boksok'),
        )
      )
    );
  }

  public function register_tax_lsb_translator() {
    register_taxonomy( 'lsb_tax_translator',
      array(
        0 => 'lsb_book',
      ),
      array( 'hierarchical' => false,
        'label' => __('Oversetter', 'lsb_books'),
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => _x('oversetter', 'lsb_tax_translator', 'lsb_boksok') ),
        'show_admin_column' => false,
        'labels' => array (
          'search_items' => __('Oversettere', 'lsb_boksok'),
          'popular_items' => __('Populære', 'lsb_boksok'),
          'all_items' => __('Alle', 'lsb_boksok'),
          'parent_item' => __('Forelder', 'lsb_boksok'),
          'parent_item_colon' => __('Forelder: ', 'lsb_boksok'),
          'edit_item' => __('Rediger oversetter', 'lsb_boksok'),
          'update_item' => __('Oppdater oversetter', 'lsb_boksok'),
          'add_new_item' => __('Legg til oversetter', 'lsb_boksok'),
          'new_item_name' => _x('Forfatter', 'Ny-oversetter-tittel', 'lsb_boksok'),
          'separate_items_with_commas' => __('Separer med komma', 'lsb_boksok'),
          'add_or_remove_items' => __('Legg til eller fjern', 'lsb_boksok'),
          'choose_from_most_used' => __('Velg fra mest brukte', 'lsb_boksok'),
        )
      )
    );
  }

  public function register_tax_lsb_publisher() {
    register_taxonomy( 'lsb_tax_publisher',
      array(
        0 => 'lsb_book',
      ),
      array( 'hierarchical' => false,
        'label' => __('Forlag', 'lsb_boksok'),
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => _x('forlag', 'lsb_tax_publisher slug', 'lsb_boksok') ),
        'show_admin_column' => false,
        'labels' => array (
          'search_items' => __('Forlag', 'lsb_boksok'),
          'popular_items' => __('Populære', 'lsb_boksok'),
          'all_items' => __('Alle', 'lsb_boksok'),
          'parent_item' => __('Forelder', 'lsb_boksok'),
          'parent_item_colon' => __('Forelder: ', 'lsb_boksok'),
          'edit_item' => __('Rediger forlag', 'lsb_boksok'),
          'update_item' => __('Oppdater forlag', 'lsb_boksok'),
          'add_new_item' => __('Legg til forlag', 'lsb_boksok'),
          'new_item_name' => _x('Forfatter', 'Ny-forlag-tittel', 'lsb_boksok'),
          'separate_items_with_commas' => __('Separer med komma', 'lsb_boksok'),
          'add_or_remove_items' => __('Legg til eller fjern', 'lsb_boksok'),
          'choose_from_most_used' => __('Velg fra mest brukte', 'lsb_boksok'),
        )
      )
    );
  }

  public function register_tax_lsb_genre() {
    register_taxonomy( 'lsb_tax_genre',
      array(
        0 => 'lsb_book',
      ),
      array( 'hierarchical' => true,
        'label' => __('Sjanger', 'lsb_boksok'),
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => _x('sjanger', 'lsb_tax_genre slug', 'lsb_boksok') ),
        'show_admin_column' => true,
        'labels' => array (
          'search_items' => __('Sjangre', 'lsb_boksok'),
          'popular_items' => __('Populære', 'lsb_boksok'),
          'all_items' => __('Alle', 'lsb_boksok'),
          'parent_item' => __('Sjanger', 'lsb_boksok'),
          'parent_item_colon' => __('Sjanger: ', 'lsb_boksok'),
          'edit_item' => __('Rediger sjanger', 'lsb_boksok'),
          'update_item' => __('Oppdater sjanger', 'lsb_boksok'),
          'add_new_item' => __('Legg til sjanger', 'lsb_boksok'),
          'new_item_name' => _x('Forfatter', 'Ny-sjanger-tittel', 'lsb_boksok'),
          'separate_items_with_commas' => __('Separer med komma', 'lsb_boksok'),
          'add_or_remove_items' => __('Legg til eller fjern', 'lsb_boksok'),
          'choose_from_most_used' => __('Velg fra mest brukte', 'lsb_boksok'),
        )
      )
    );
  }

  public function register_tax_lsb_age() {
    register_taxonomy( 'lsb_tax_age',
      array(
        0 => 'lsb_book',
      ),
      array( 'hierarchical' => true,
        'label' => __('Alder', 'lsb_boksok'),
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => _x('alder', 'lsb_tax_age slug', 'lsb_boksok') ),
        'show_admin_column' => true,
        'labels' => array (
          'search_items' => __('Aldre', 'lsb_boksok'),
          'popular_items' => __('Populære', 'lsb_boksok'),
          'all_items' => __('Alle', 'lsb_boksok'),
          'parent_item' => __('Alder', 'lsb_boksok'),
          'parent_item_colon' => __('Alder: ', 'lsb_boksok'),
          'edit_item' => __('Rediger alder', 'lsb_boksok'),
          'update_item' => __('Oppdater alder', 'lsb_boksok'),
          'add_new_item' => __('Legg til alder', 'lsb_boksok'),
          'new_item_name' => _x('Forfatter', 'Ny-alder-tittel', 'lsb_boksok'),
          'separate_items_with_commas' => __('Separer med komma', 'lsb_boksok'),
          'add_or_remove_items' => __('Legg til eller fjern', 'lsb_boksok'),
          'choose_from_most_used' => __('Velg fra mest brukte', 'lsb_boksok'),
        )
      )
    );
  }

  public function register_tax_lsb_customization() {
    register_taxonomy( 'lsb_tax_customization',
      array(
        0 => 'lsb_book',
      ),
      array( 'hierarchical' => true,
        'label' => __('Tilpasning', 'lsb_boksok'),
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => _x('tilpasning', 'lsb_tax_customization slug', 'lsb_boksok') ),
        'show_admin_column' => false,
        'labels' => array (
          'search_items' => __('Tilpasninger', 'lsb_boksok'),
          'popular_items' => __('Populære', 'lsb_boksok'),
          'all_items' => __('Alle', 'lsb_boksok'),
          'parent_item' => __('Tilpasning', 'lsb_boksok'),
          'parent_item_colon' => __('Tilpasning: ', 'lsb_boksok'),
          'edit_item' => __('Rediger tilpasning', 'lsb_boksok'),
          'update_item' => __('Oppdater tilpasning', 'lsb_boksok'),
          'add_new_item' => __('Legg til tilpasning', 'lsb_boksok'),
          'new_item_name' => _x('Forfatter', 'Ny-tilpasning-tittel', 'lsb_boksok'),
          'separate_items_with_commas' => __('Separer med komma', 'lsb_boksok'),
          'add_or_remove_items' => __('Legg til eller fjern', 'lsb_boksok'),
          'choose_from_most_used' => __('Velg fra mest brukte', 'lsb_boksok'),
        )
      )
    );
  }

  public function register_tax_lsb_topic() {
    register_taxonomy( 'lsb_tax_topic',
      array(
        0 => 'lsb_book',
      ),
      array( 'hierarchical' => false,
      	'label' => __('Emne', 'lsb_boksok'),
      	'show_ui' => true,
      	'query_var' => true,
      	'rewrite' => array( 'slug' => _x('emne', 'lsb_tax_topic slug', 'lsb_boksok') ),
      	'show_admin_column' => false,
      	'labels' => array (
          'search_items' => __('Emner', 'lsb_boksok'),
          'popular_items' => __('Populære', 'lsb_boksok'),
          'all_items' => __('Alle', 'lsb_boksok'),
          'parent_item' => __('Emne', 'lsb_boksok'),
          'parent_item_colon' => __('Emne: ', 'lsb_boksok'),
          'edit_item' => __('Rediger emne', 'lsb_boksok'),
          'update_item' => __('Oppdater emne', 'lsb_boksok'),
          'add_new_item' => __('Legg til emne', 'lsb_boksok'),
          'new_item_name' => _x('Forfatter', 'Ny-emne-tittel', 'lsb_boksok'),
          'separate_items_with_commas' => __('Separer med komma', 'lsb_boksok'),
          'add_or_remove_items' => __('Legg til eller fjern', 'lsb_boksok'),
          'choose_from_most_used' => __('Velg fra mest brukte', 'lsb_boksok'),
        )
      )
    );
  }

  public function register_tax_lsb_language() {
    register_taxonomy( 'lsb_tax_language',
      array(
        0 => 'lsb_book',
      ),
      array( 'hierarchical' => true,
        'label' => __('Språk', 'lsb_boksok'),
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => _x('språk', 'lsb_tax_language slug', 'lsb_boksok') ),
        'show_admin_column' => false,
        'labels' => array (
          'search_items' => __('Språk', 'lsb_boksok'),
          'popular_items' => __('Populære', 'lsb_boksok'),
          'all_items' => __('Alle', 'lsb_boksok'),
          'parent_item' => __('Språk', 'lsb_boksok'),
          'parent_item_colon' => __('Språk: ', 'lsb_boksok'),
          'edit_item' => __('Rediger språk', 'lsb_boksok'),
          'update_item' => __('Oppdater språk', 'lsb_boksok'),
          'add_new_item' => __('Legg til språk', 'lsb_boksok'),
          'new_item_name' => _x('Forfatter', 'Ny-språk-tittel', 'lsb_boksok'),
          'separate_items_with_commas' => __('Separer med komma', 'lsb_boksok'),
          'add_or_remove_items' => __('Legg til eller fjern', 'lsb_boksok'),
          'choose_from_most_used' => __('Velg fra mest brukte', 'lsb_boksok'),
        )
      )
    );
  }

  public function register_tax_lsb_cat() {
    register_taxonomy( 'lsb_tax_lsb_cat',
      array(
        0 => 'lsb_book'
      ),
      array(
        'hierarchical' => true,
        'label' => __('Hovedkategori', 'lsb_boksok'),
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => _x('hovedkategori', 'lsb_tax_lsb_cat slug', 'lsb_boksok') ),
        'show_admin_column' => true,
        'labels' => array (
          'search_items' => __('Hovedkategori', 'lsb_boksok'),
          'popular_items' => __('Populære', 'lsb_boksok'),
          'all_items' => __('Alle', 'lsb_boksok'),
          'parent_item' => __('Hovedkategori', 'lsb_boksok'),
          'parent_item_colon' => __('Hovedkategori: ', 'lsb_boksok'),
          'edit_item' => __('Rediger Hovedkategori', 'lsb_boksok'),
          'update_item' => __('Oppdater Hovedkategori', 'lsb_boksok'),
          'add_new_item' => __('Legg til Hovedkategori', 'lsb_boksok'),
          'new_item_name' => _x('Hovedkategori', 'Ny-lsb-cat-tittel', 'lsb_boksok'),
          'separate_items_with_commas' => __('Separer med komma', 'lsb_boksok'),
          'add_or_remove_items' => __('Legg til eller fjern', 'lsb_boksok'),
          'choose_from_most_used' => __('Velg fra mest brukte', 'lsb_boksok'),
        )
      )
    );
  }

  public function register_tax_lsb_audience() {
    register_taxonomy( 'lsb_tax_audience',
      array(
        0 => 'lsb_book'
      ),
      array(
        'hierarchical' => true,
        'label' => __('Målgruppe', 'lsb_boksok'),
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => _x('malgruppe', 'lsb_tax_lsb_audience slug', 'lsb_boksok') ),
        'show_admin_column' => false,
        'labels' => array (
          'search_items' => __('Målgruppe', 'lsb_boksok'),
          'popular_items' => __('Populære', 'lsb_boksok'),
          'all_items' => __('Alle', 'lsb_boksok'),
          'parent_item' => __('Målgruppe', 'lsb_boksok'),
          'parent_item_colon' => __('Målgruppe: ', 'lsb_boksok'),
          'edit_item' => __('Rediger Målgruppe', 'lsb_boksok'),
          'update_item' => __('Oppdater Målgruppe', 'lsb_boksok'),
          'add_new_item' => __('Legg til Målgruppe', 'lsb_boksok'),
          'new_item_name' => _x('Målgruppe', 'Ny-lsb-cat-tittel', 'lsb_boksok'),
          'separate_items_with_commas' => __('Separer med komma', 'lsb_boksok'),
          'add_or_remove_items' => __('Legg til eller fjern', 'lsb_boksok'),
          'choose_from_most_used' => __('Velg fra mest brukte', 'lsb_boksok'),
        )
      )
    );
  }

  public function register_lsb_tax_list() {
    register_taxonomy( 'lsb_tax_list',
      array(
        0 => 'lsb_book'
      ),
      array('hierarchical' => true,
        'label' => __('Liste', 'lsb_boksok'),
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => _x('liste', 'lsb_tax_list slug', 'lsb_boksok') ),
        'show_admin_column' => false,
        'labels' => array (
          'search_items' => __('Lister', 'lsb_boksok'),
          'popular_items' => __('Populære', 'lsb_boksok'),
          'all_items' => __('Alle', 'lsb_boksok'),
          'parent_item' => __('Forelder', 'lsb_boksok'),
          'parent_item_colon' => __('Forelder: ', 'lsb_boksok'),
          'edit_item' => __('Rediger', 'lsb_boksok'),
          'update_item' => __('Oppdater', 'lsb_boksok'),
          'add_new_item' => __('Legg til', 'lsb_boksok'),
          'new_item_name' => __('Navn', 'lsb_boksok'),
          'separate_items_with_commas' => __('Skill med komma'),
          'add_or_remove_items' => __('Legg til eller ta vekk', 'lsb_boksok'),
          'choose_from_most_used' => __('Velg fra mest brukte', 'lsb_boksok'),
        )
      )
    );
  }

  public function register_lsb_tax_series() {
    register_taxonomy( 'lsb_tax_series',
      array(
        0 => 'lsb_book'
      ),
      array('hierarchical' => true,
        'label' => __('Serie', 'lsb_boksok'),
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => _x('serie', 'lsb_tax_series slug', 'lsb_boksok') ),
        'show_admin_column' => false,
        'labels' => array (
          'search_items' => __('Serier', 'lsb_boksok'),
          'popular_items' => __('Populære', 'lsb_boksok'),
          'all_items' => __('Alle', 'lsb_boksok'),
          'parent_item' => __('Forelder', 'lsb_boksok'),
          'parent_item_colon' => __('Forelder: ', 'lsb_boksok'),
          'edit_item' => __('Rediger', 'lsb_boksok'),
          'update_item' => __('Oppdater', 'lsb_boksok'),
          'add_new_item' => __('Legg til', 'lsb_boksok'),
          'new_item_name' => __('Navn', 'lsb_boksok'),
          'separate_items_with_commas' => __('Skill med komma'),
          'add_or_remove_items' => __('Legg til eller ta vekk', 'lsb_boksok'),
          'choose_from_most_used' => __('Velg fra mest brukte', 'lsb_boksok'),
        )
      )
    );
  }

  public function register_lsb_acf_book_meta() {
		acf_add_local_field_group(array (
			'id' => 'lsb_acf_book_meta',
			'title' => __('Bokmeta', 'lsb_boksok'),
			'fields' => array (
				array (
					'key' => 'lsb_acf_isbn',
					'label' => __('ISBN', 'lsb_boksok'),
					'name' => 'lsb_isbn',
					'type' => 'text',
					'required' => 1,
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'formatting' => 'none',
					'maxlength' => '',
				),
				array (
					'key' => 'lsb_acf_published_year',
					'label' => __('Publisert', 'lsb_boksok'),
					'name' => 'lsb_published_year',
					'type' => 'text',
					'instructions' => __('Året boken ble publisert', 'lsb_boksok'),
					'required' => 1,
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'formatting' => 'none',
					'maxlength' => '',
				),
				array (
					'key' => 'lsb_acf_pages',
					'label' => __('Sider', 'lsb_boksok'),
					'name' => 'lsb_pages',
					'type' => 'text',
					'instructions' => __('Antall sider', 'lsb_boksok'),
					'required' => 0,
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'formatting' => 'none',
					'maxlength' => '',
				),
				array (
					'key' => 'lsb_acf_look_inside',
					'label' => __('Bla i boka', 'lsb_boksok'),
					'name' => 'lsb_look_inside',
					'type' => 'url',
					'instructions' => __('Bla i boka url', 'lsb_boksok'),
					'required' => 0,
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'formatting' => 'none',
					'maxlength' => '',
				),
				array (
					'key' => 'lsb_acf_supported',
					'label' => __('Støttet av Leser søker bok?', 'lsb_boksok'),
					'name' => 'lsb_supported',
					'type' => 'true_false',
					'required' => 0,
					'message' => '',
					'default_value' => 0,
				),
				array (
					'key' => 'lsb_acf_support_cat',
					'label' => __('Støttekategori', 'lsb_boksok'),
					'name' => 'lsb_support_cat',
					'type' => 'radio',
					'required' => 1,
					'conditional_logic' => array (
						'status' => 1,
						'rules' => array (
							array (
								'field' => 'lsb_acf_supported',
								'operator' => '==',
								'value' => '1',
							),
						),
						'allorany' => 'all',
					),
					'choices' => array (
						'purple' => __('Litt å lese', 'lsb_boksok'),
						'yellow' => __('Storskrift', 'lsb_boksok'),
						'orange' => __('Punktskrift & Følebilder', 'lsb_boksok'),
						'green' => __('Enkelt innhold', 'lsb_boksok'),
						'red' => __('Tegnspråk & NMT', 'lsb_boksok'),
						'blue' => __('Bliss & Piktogram', 'lsb_boksok'),
					),
					'other_choice' => 0,
					'save_other_choice' => 0,
					'default_value' => '',
					'layout' => 'vertical',
				),
			),
			'location' => array (
				array (
					array (
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'lsb_book',
						'order_no' => 0,
						'group_no' => 0,
					),
				),
			),
			'options' => array (
				'position' => 'acf_after_title',
				'layout' => 'default',
				'hide_on_screen' => array (
				),
			),
			'menu_order' => 0,
		));
  }

  public function register_lsb_acf_book_content() {
		acf_add_local_field_group(array (
			'id' => 'lsb_acf_content',
			'title' => __('Anmeldelse', 'lsb_boksok'),
			'fields' => array (
				array (
					'key' => 'lsb_acf_review',
					'label' => __('Om boka', 'lsb_boksok'),
					'name' => 'lsb_review',
					'type' => 'wysiwyg',
					'default_value' => '',
					'toolbar' => 'full',
					'media_upload' => 'no',
				),
				array (
					'key' => 'lsb_acf_quote',
					'label' => __('Utdrag fra boken', 'lsb_boksok'),
					'name' => 'lsb_quote',
					'type' => 'wysiwyg',
					'default_value' => '',
					'toolbar' => 'basic',
					'media_upload' => 'no',
				),
			),
			'location' => array (
				array (
					array (
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'lsb_book',
						'order_no' => 0,
						'group_no' => 0,
					),
				),
			),
			'options' => array (
				'position' => 'normal',
				'layout' => 'no_box',
				'hide_on_screen' => array (
				),
			),
			'menu_order' => 0,
		));
  }

  public function register_lsb_acf_book_oembeds() {
		acf_add_local_field_group(array (
			'id' => 'lsb_acf_multimedia',
			'title' => __('Multimedia', 'lsb_boksok'),
			'fields' => array (
				array (
					'key' => 'lsb_acf_oembeds',
					'label' => __('Oembeds', 'lsb_boksok'),
					'instructions' => __('YouTube, SoundCloud, Issuu etc. ', 'lsb_boksok'),
					'name' => 'lsb_oembeds',
					'type' => 'repeater',
					'button_label' => __('Legg til oembed', 'lsb_boksok'),
					'sub_fields' => array (
						array(
							'key' => 'lsb_acf_oembed',
							'label' => __('Oembed', 'lsb_boksok'),
							'instructions' => __('Url direkte til video, lyd, bok etc.', 'lsb_boksok'),
							'name' => 'lsb_oembed',
							'type' => 'oembed',
						),
					),
				),
			),
			'location' => array (
				array (
					array (
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'lsb_book',
						'order_no' => 0,
						'group_no' => 0,
					),
				),
			),
			'options' => array (
				'position' => 'normal',
				'layout' => 'normal',
				'hide_on_screen' => array (
				),
			),
			'menu_order' => 0,
		));
  }

  public function register_lsb_acf_tax_meta() {
		// Hide term from visitors
		$hide_term = array(
			'key' => 'lsb_acf_tax_topic_hide_term',
			'label' => __('Skjul for besøkende', 'lsb_boksok'),
			'name' => 'lsb_tax_topic_hide_term',
			'type' => 'true_false',
			'message' => __('Gjør usynelig for besøkende (forsatt tilgjengelig i søk).', 'lsb_boksok'),
			'default_value' => 0,
		);

		acf_add_local_field_group(array (
			'key' => 'lsb_acf_tax_topic_settings',
			'title' => __('Innstillinger', 'lsb_book'),
			'fields' => array($hide_term),
			'location' => array(
				array(
					array(
						'param' => 'taxonomy',
						'operator' => '==',
						'value' => 'lsb_tax_topic',
					)
				),
			),
		));

		// Icon

		$icon = array (
			'key' => 'lsb_acf_tax_term_icon',
			'label' => __('Ikon/bilde', 'lsb_boksok'),
			'name' => 'lsb_tax_topic_icon',
			'type' => 'image',
			'return_format' => 'array',
	'preview_size' => 'thumbnail',
		);

		acf_add_local_field_group(array (
			'key' => 'lsb_acf_tax_icon_group',
			'title' => __('Ikon', 'lsb_book'),
			'fields' => array($icon),
			'location' => array(
					array(
						array(
							'param' => 'taxonomy',
							'operator' => '==',
							'value' => 'lsb_tax_topic',
						)
					),
					array(
						array(
							'param' => 'taxonomy',
							'operator' => '==',
							'value' => 'lsb_tax_genre',
						)
					),
					array(
						array(
							'param' => 'taxonomy',
							'operator' => '==',
							'value' => 'lsb_tax_series',
						)
					)
				)
		));
  }
}

?>
