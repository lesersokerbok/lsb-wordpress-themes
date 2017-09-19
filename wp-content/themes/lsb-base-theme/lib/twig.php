<?php 

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
		$data['breadcrumbs'] = new LSBBreadcrumbs('site_map');
	}
	
	$data['is_front_page'] = is_front_page();
	return $data;
}
add_filter('timber/context', 'lsb_add_to_context');

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

function lsb_add_to_twig($twig) {
	/* this is where you can add your own fuctions to twig */
	$twig->addExtension(new Twig_Extension_StringLoader());
	$twig->addFilter(new Twig_SimpleFilter('terms_list', 'lsb_add_list_separators'));
	$twig->addFilter(new Twig_SimpleFilter('icon_terms', 'lsb_filter_icon_terms'));
	$twig->addFilter(new Twig_SimpleFilter('visible_terms', 'lsb_filter_visible_terms'));
	return $twig;
}
add_filter('timber/twig', 'lsb_add_to_twig');