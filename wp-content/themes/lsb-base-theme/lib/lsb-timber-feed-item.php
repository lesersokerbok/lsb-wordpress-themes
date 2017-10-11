<?php

class LSB_FeedItem {
	protected $_item;
	protected $_thumbnail;

	function __construct($item) {
		$this->_item = $item;
	}

	public function post_type() {
		return 'post';
	}

	public function title() {
		return $this->_item->get_title();
	}

	public function link() {
		return $this->_item->get_permalink();
	}

	public function preview() {
		$preview = wp_trim_words( $this->_item->get_description(), 50, null );

		// Comes from the feed itself
		$preview = preg_replace( "/Les videre .*/", '', $preview);
		$preview = preg_replace( "/Read more .*/", '', $preview);

		return $preview;
	}

	public function thumbnail() {
		if(!$this->_thumbnail) {
			$url = $this->_thumbnail_from_enclosure();
			$this->_thumbnail = new TimberImage($url);
		}
		return $this->_thumbnail;
	}

	public function read_more() {
		return __('Les hele artikkelen', 'lsb');
	}

	public function _thumbnail_from_enclosure() {
		$image = null;
		foreach ($this->_item->get_enclosures() as $enclosure) {
			// Find first image enclosure that is not gravatar
			if(strpos($enclosure->type, 'image') !== false || strpos($enclosure->medium, 'image') !== 'image' ) {
				if (strpos($enclosure->link, 'gravatar') === false) {
					$image = $enclosure->link;
					break;
				}
			}
		}
		return $image;
	}
}

class LSB_FeedBookItem extends LSB_FeedItem {

	public function post_type() {
		return 'lsb_book';
	}

	public function terms($taxonomy) {
		if('lsb_tax_author' == $taxonomy && is_array($this->_item->get_item_tags('', 'lsb-author'))) {
			return array_map(function($term){
				return (object)[
					'name' => $term['attribs']['']['name'],
					'link' => $term['attribs']['']['url']
				];
			}, $this->_item->get_item_tags('', 'lsb-author'));
		}
	}
}

class LSB_FeedItemFactory {
	public static function create_feed_item($simple_pie_item, $post_type = 'post' ) {
		if('lsb_book' == $post_type) {
			return new LSB_FeedBookItem($simple_pie_item);
		} else {
			return new LSB_FeedItem($simple_pie_item);
		}
	}
}