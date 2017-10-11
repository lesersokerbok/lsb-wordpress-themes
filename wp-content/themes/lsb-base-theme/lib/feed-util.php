<?php

class LsbFeedUtil {
	public function __construct() {
		add_filter('the_excerpt_rss', array($this, 'add_featured_image_to_feed_content'));
		add_filter('the_content_feed', array($this, 'add_featured_image_to_feed_content'));
	}

	public static function add_featured_image_to_feed_content($content) {
		if  ( is_feed() ) {

			global $post;

			if ( $post->post_type === 'lsb_book' && has_post_thumbnail( $post->ID ) ) {
				$content = '' . get_the_post_thumbnail( $post->ID, 'thumbnail' ) . '' . $content;
			} else {
				$content = '' . get_the_post_thumbnail( $post->ID, 'large' ) . '' . $content;
			}

		}

		return $content;
	}

	public static function get_image_from_feed_item_description($item) {
		$doc = new DOMDocument();
		$doc->loadHTML(mb_convert_encoding($item->get_description(), 'HTML-ENTITIES', 'UTF-8'));
		$xpath = new DOMXPath($doc);
		$image = $xpath->evaluate("string(//img/@src)");
		if ( is_a($image, 'DOMNodeList') ) {
			//if more than one image
			return $image->item(0);
		}

		return $image;
	}

	public static function get_image_from_enclosure($item) {
		$image = null;
		foreach ($item->get_enclosures() as $enclosure) {
			if ($enclosure->link != '' && strpos($enclosure->link, 'gravatar') === false) {
				$image = $enclosure->link;
				break;
			}
		}
		return $image;
	}

	public static function get_image_from_feed_item($item) {
		$image = LsbFeedUtil::get_image_from_enclosure($item);
		if(!$image) {
			return LsbFeedUtil::get_image_from_feed_item_description($item);
		} else {
			return $image;
		}
	}

	public static function get_excerpt_from_feed_item($item) {
		$excerpt = wp_html_excerpt( $item->get_description(), 360);

		// Comes from the feed itself
		$excerpt = preg_replace( "/Les videre .*/", '', $excerpt);

		return $excerpt;
	}

	public static function print_error_message($feed_url, $rss) {
		if(is_wp_error($rss)) {
			printf( esc_html__( 'Det er noe galt med feeden (%1$s): %2$s', 'lsb' ), $feed_url, $rss->get_error_message() );
		} else {
			printf( esc_html__( 'Det er ingen elementer i feeden (%1$s)', 'lsb' ), $feed_url );
		}
	}

	public static function is_feed_item_permalink_same_domain_as_site_domain($item) {
		$feed_item_url = parse_url($item->get_permalink());
		$site_url = parse_url(get_option('siteurl'));

		return $feed_item_url['host'] == $site_url['host'];
	}

}

?>
