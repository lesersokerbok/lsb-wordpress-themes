<?php

namespace LSB\Feed;

function add_lsb_book_meta_in_rss() {
	global $post;
	if('lsb_book' == \get_post_type( $post->ID ) ) {
		$authors = \get_the_terms($post->ID, 'lsb_tax_author');
		foreach($authors as $author) {
			echo "\t";
			echo '<lsb-author name="'. $author->name . '" url="' . \get_term_link($author) . '" />';
			echo "\n";
		}
	}
}