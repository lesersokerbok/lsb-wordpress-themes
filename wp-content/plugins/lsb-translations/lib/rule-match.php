<?php

namespace LSB\Translations;

function location_rules_match_lsb_tax_audience( $match, $rule, $options ) {
	// var_dump($match);
	// var_dump($rule);
	// var_dump($options);

	$current_screen = get_current_screen();
	if('lsb_tax_audience' !== $current_screen->taxonomy) {
		return $match;
	}

	if(!isset($_GET['tag_ID'])) {
		return $match;
	};

	$current_slug = get_term($_GET['tag_ID'], 'lsb_tax_audience')->slug;
	$selected_slug = (string) $rule['value'];

	if($rule['operator'] == "==") {
		$match = ( $current_slug == $selected_slug );
	} elseif($rule['operator'] == "!=") {
		$match = ( $current_slug->ID != $selected_slug );
	}

	return $match;
}