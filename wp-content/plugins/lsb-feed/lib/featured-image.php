<?php

namespace LSB\Feed;

function add_featured_image_in_rss_2() {
	global $post;
	if( \has_post_thumbnail( $post->ID ) ) {
		$id = \get_post_thumbnail_id($post->ID);
		$mime_type = \get_post_mime_type($id);
		$url = \wp_get_attachment_url($id);
		$meta = \wp_get_attachment_metadata($id);
		$path = wp_upload_dir()['basedir'] . '/' . $meta['file'];
		$filesize = filesize($path);

		echo "\t";
		echo '<enclosure url="' . $url . '" type="' . $mime_type . '" size="' . $filesize . '" />';
		echo "\n";
	}
}