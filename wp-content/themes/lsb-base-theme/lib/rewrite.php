<?php

function lsb_rewrite_rules() {
	$GLOBALS['wp_rewrite']->author_base        = __('skribent', 'lsb');
	$GLOBALS['wp_rewrite']->search_base        = __('sok', 'lsb');
	$GLOBALS['wp_rewrite']->comments_base      = __('kommentarer', 'lsb');
	$GLOBALS['wp_rewrite']->pagination_base    = __('side', 'lsb');
}
add_action('init', 'lsb_rewrite_rules');
