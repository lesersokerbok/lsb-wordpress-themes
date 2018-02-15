<?php

class LSB_FeedItem {
	protected $_item;
	protected $_thumbnail;
	protected $_taxonomy;

	function __construct($item) {
		$this->_item = $item;
	}

	public function post_type() {
		return strpos($this->link()["url"], 'boksok') !== false ? "lsb_book" : "feed-item";
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

	public function terms($taxonomy) {
		if(!$this->_taxonomy[$taxonomy]) {
			if('lsb_tax_author' == $taxonomy && is_array($this->_item->get_item_tags('', 'lsb-author'))) {
				$this->_taxonomy[$taxonomy] = array_map(function($term){
					return (object)[
						'name' => $term['attribs']['']['name'],
						'link' => $term['attribs']['']['url']
					];
				}, $this->_item->get_item_tags('', 'lsb-author'));
			}
		}
		return $this->_taxonomy[$taxonomy];
	}

	public function read_more() {
		if($this->terms('lsb_tax_author')) {
			return __('Les hele anmeldelsen', 'lsb');
		} else {
			return __('Les hele artikkelen', 'lsb');
		}
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

class LSB_FeedItemFactory {
	public static function create_feed_item($simple_pie_item, $post_type = 'post' ) {
		return new LSB_FeedItem($simple_pie_item);
	}
}