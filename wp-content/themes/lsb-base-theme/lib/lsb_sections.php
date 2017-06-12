<?php 

function transform_menu_section($acf_section) {
	$menu_term = $acf_section['nav_menu'];
	$menu = new TimberMenu($menu_term->slug);
	$items = array_map(function($menu_item) {
		$item = [
			'name' => $menu_item->name,
			'link' => $menu_item->link,
		];

		$term = get_term($menu_item->object_id, $menu_item->object);

		if(!is_wp_error($term)) {
			$icon_id = get_field('lsb_tax_topic_icon', $term, false);
			if($icon_id) {
				$item['icon'] = new TimberImage($icon_id);
			}
		}

		return $item;
	}, $menu->get_items());

	return [
		'layout' => 'menu',
		'title' => $acf_section['lsb_title'] ? $acf_section['lsb_title'] : $menu_term->name,
		'subtitle' => $acf_section['lsb_subtitle'],
		'items' => $items
	];
}

function transform_custom_post_type_section($acf_section, $post_type) {
	
	$title = get_post_type_object($post_type)->labels->name;
	$link = get_post_type_archive_link($post_type);
	$filter = $acf_section['lsb_filter'];
	
	$args = array(
		'post_type' => $post_type,
		'posts_per_page' => 12
	);

	if($filter && $acf_section[$filter]) {
		$term = $acf_section[$filter];
		$args['tax_query'][] = array ( 
			array ( 
				'taxonomy' => $filter,
				'field' => 'object', 
				'terms' => $term
			)
		);

		$title = $term->name;
		$link = get_term_link($term);
	}

  $query = new WP_Query( $args );

	$hashed = md5(serialize($query));
	$posts = TimberHelper::transient('lsb_section_'.$hashed, function()  use ($query) {
		return Timber::get_posts($query, LSB_Post::class);
	}, 600);

	return [
		'layout' => $post_type,
		'title' => $acf_section['lsb_title'] ? $acf_section['lsb_title'] : $title,
		'subtitle' => $acf_section['lsb_subtitle'],
		'post_type' => $post_type,
		'link' => $link,
		'posts' => $posts
	];
}

function transform_acf_sections($acf_sections) {
	$acf_sections = is_array($acf_sections) ? $acf_sections : array();

	return array_map(function($acf_section) {
		$layout = $acf_section['acf_fc_layout'];

		if(post_type_exists( $layout )) {
			return transform_custom_post_type_section($acf_section, $layout);
		} elseif($layout == 'lsb_menu_nav') {
			return transform_menu_section($acf_section);
		}
	}, $acf_sections);
}