<?php
/**
 * Roots initial setup and constants
 */
function lsb_setup() {
	
	load_theme_textdomain('roots', get_template_directory() . '/lang');

	// Register wp_nav_menu() menus
	// http://codex.wordpress.org/Function_Reference/register_nav_menus
	register_nav_menus(array(
		'primary_navigation' => __('Toppmeny (venstre)', 'lsb')
	));

	register_nav_menus(array(
		'secondary_navigation' => __('Toppmeny (høyre)', 'lsb')
	));

	register_nav_menus(array(
		'main_navigation' => __('Hovedmeny', 'lsb')
	));

	register_nav_menus(array(
		'site_map' => __('Site Map', 'lsb')
	));

	// Add post thumbnails
	// http://codex.wordpress.org/Post_Thumbnails
	// http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
	// http://codex.wordpress.org/Function_Reference/add_image_size
	add_theme_support('post-thumbnails');
	add_image_size( 'featured-thumb', 750);

	// Add post formats
	// http://codex.wordpress.org/Post_Formats
	add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio'));

	// Add HTML5 markup for captions
	// http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
	add_theme_support('html5', array('caption'));

	// Tell the TinyMCE editor to use a custom stylesheet
	add_editor_style('/assets/css/editor-style.css');
}
add_action('after_setup_theme', 'lsb_setup');

/**
 * Register sidebars
 */
function roots_widgets_init() {
	register_sidebar(array(
		'name'          => __('Primær', 'lsb'),
		'id'            => 'sidebar-primary',
		'before_widget' => '<section class="widget %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	));

	register_sidebar(array(
		'name'          => __('Footer 1', 'lsb'),
		'id'            => 'sidebar-footer-1',
		'before_widget' => '<section class="widget %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	));

	register_sidebar(array(
		'name'          => __('Footer 2', 'lsb'),
		'id'            => 'sidebar-footer-2',
		'before_widget' => '<section class="widget %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	));

	register_sidebar(array(
		'name'          => __('Footer 3', 'lsb'),
		'id'            => 'sidebar-footer-3',
		'before_widget' => '<section class="widget %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	));
}
add_action('widgets_init', 'roots_widgets_init');
