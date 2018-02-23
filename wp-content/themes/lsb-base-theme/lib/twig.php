<?php

add_filter('timber/context', 'lsb_add_to_context');
function lsb_add_to_context( $data ){
	if (has_nav_menu('primary_navigation')) {
		$data['primary_menu'] = new TimberMenu('primary_navigation');
	}
	if (has_nav_menu('secondary_navigation')) {
		$data['secondary_menu'] = new TimberMenu('secondary_navigation');
	}
	if (has_nav_menu('main_navigation')) {
		$data['main_menu'] = new TimberMenu('main_navigation');
	}
	if (has_nav_menu('site_map')) {
		$data['site_map'] = new TimberMenu('site_map');
	}
	if (has_nav_menu('site_map')) {
		$data['breadcrumbs'] = new LSBBreadcrumbs('site_map');
	}

	global $page;
	if(
		count($data['breadcrumbs']->items) == 1 ||
		is_paged() && count($data['breadcrumbs']->items) == 2 ||
		$page > 1 && count($data['breadcrumbs']->items) == 2
	) {
		$data['is_root'] = true;
		if (has_nav_menu('site_map')) {
			$data['is_section_home'] = $page > 1 ? false : array_reduce(
				$data['site_map']->items,
				function($carry, $item) {
					return $carry || $item->current;
				} ,
				false);
		}
	}





	$data['is_front_page'] = is_front_page();
	return $data;
}

add_filter('timber/twig', 'lsb_add_to_twig');
function lsb_add_to_twig($twig) {
	/* this is where you can add your own fuctions to twig */
	$twig->addExtension(new Twig_Extension_StringLoader());
	$twig->addFilter(new Twig_SimpleFilter('terms_list', 'lsb_add_list_separators'));
	$twig->addFilter(new Twig_SimpleFilter('icon_terms', 'lsb_filter_icon_terms'));
	$twig->addFilter(new Twig_SimpleFilter('visible_terms', 'lsb_filter_visible_terms'));
	$twig->addFilter(new Twig_SimpleFilter('icon', 'lsb_get_icon'));
	return $twig;
}

function lsb_add_list_separators( $arr, $first_delimiter = ', ', $second_delimiter = ' & ' ) {
	if( !is_array( $arr) ) {
		return $arr;
	}

	$length = count($arr);
	$list = '';
	foreach ( $arr as $index => $item ) {
		if ( $index < $length - 2 ) {
			$delimiter = $first_delimiter;
		} elseif ( $index == $length - 2 ) {
			$delimiter = $second_delimiter;
		} else {
			$delimiter = '';
		}
		$list .= sprintf('<a href="%s">%s</a>%s', $item->link, $item->name, $delimiter);
	}
	return $list;
}

function lsb_filter_icon_terms( $arr ) {
	if( !is_array( $arr) ) {
		return $arr;
	}
	return array_filter($arr, function($term) {
		return !!$term->icon;
	});
}

function lsb_filter_visible_terms( $arr ) {
	if( !is_array( $arr) ) {
		return $arr;
	}
	return array_filter($arr, function($term) {
		return !$term->hidden;
	});
}

function lsb_get_icon( $item ) {
	if( $item instanceof TimberMenuItem) {
		$term = get_term($item->object_id, $item->object);
		if(!is_wp_error($term)) {
			$icon_id = get_field('lsb_tax_topic_icon', $term, false);
			return $icon_id ? new TimberImage($icon_id) : NULL;
		}
	}
}
