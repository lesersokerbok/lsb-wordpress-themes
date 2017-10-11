<?php

class LSB_FeedItem {
	protected $_item;

	function __construct($item) {
		$this->_item = $item;
	}

	public function post_type() {
		return 'lsb_book';
	}

	public function title() {
		return $this->_item->get_title();
	}

	public function link() {
		return $this->_item->get_permalink();
	}

	public function thumbnail() {
		if(is_array($this->_item->get_item_tags('', 'image'))) {
			$images = $this->_item->get_item_tags('', 'image');
			$url = $images[0]['attribs']['']['url'];
			return new TimberImage($url);
		}
	}

	public function terms($taxonomy) {
		if('lsb_tax_author' == $taxonomy && is_array($this->_item->get_item_tags('', 'author'))) {
			return array_map(function($term){
				return (object)[
					'name' => $term['attribs']['']['name'],
					'link' => $term['attribs']['']['url']
				];
			}, $this->_item->get_item_tags('', 'author'));
		}
	}
}