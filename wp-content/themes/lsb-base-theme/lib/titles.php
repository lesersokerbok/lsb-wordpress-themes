<?php
/**
 * Page titles
 */
function roots_title() {
	if (is_home()) {
		if (get_option('page_for_posts', true)) {
			return get_the_title(get_option('page_for_posts', true));
		} else {
			return __('Siste nyheter', 'lsb');
		}
	} elseif (is_archive()) {

		if (is_post_type_archive()) {
			return apply_filters('the_title', get_queried_object()->labels->name);
		} elseif (is_day()) {
			return sprintf(__('Daglig arkiv: %s', 'lsb'), get_the_date());
		} elseif (is_month()) {
			return sprintf(__('Månedlig arkiv: %s', 'lsb'), get_the_date('F Y'));
		} elseif (is_year()) {
			return sprintf(__('Årlig arkiv: %s', 'lsb'), get_the_date('Y'));
		} elseif (is_author()) {
			$author = get_queried_object();
			return sprintf(__('Forfatterarkiv: %s', 'lsb'), apply_filters('the_author', is_object($author) ? $author->display_name : null));
		} else {
			return single_cat_title('', false);
		}

	} elseif (is_search()) {
		return sprintf(__('Søkeresultat', 'lsb'));
	} elseif (is_404()) {
		return __('Fant ikke det du lette etter', 'lsb');
	} else {
		return get_the_title();
	}
}
