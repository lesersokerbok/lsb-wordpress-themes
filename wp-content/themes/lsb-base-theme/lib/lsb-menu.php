<?php

class LSBMenu extends TimberMenu {

	var $_current_id;
	var $_page_for_posts;
	var $_filter;

	public function __construct( $slug ) {
		parent::__construct($slug);

		$this->_page_for_posts = get_option('page_for_posts');
		$this->_filter = get_lsb_cat_filter_term();
		
		if(is_single()) {
			$post = get_post();
			$this->_current_id = get_the_ID($post);
			$this->_current_post_type = get_post_type($post);
			$this->archive_hack($this->items);
		} else {
			$object = get_queried_object();
			if(property_exists($object, 'term_id')) {
				$this->_current_id = $object->term_id;
			}
		}
		$this->parent_ancestor_hack($this->items);
		$this->taxonomy_root_filter($this->items);
	}

	function is_root_item() {
		
		$current_id = $this->_current_id;

		if(is_home()) {
			$current_id = $this->_page_for_posts;
		} 

		foreach ($this->items as $key => $item) {
			if($item->object_id == $current_id) {
				return true;
			}
		}
	}

	private function taxonomy_root_filter($items) {
		if(!is_array($items) || count($items) == 0) {
			return;
		}

		foreach ($items as $key => $item) {
			// echo '<pre>';
			// var_dump($this->_filter->term_id);
			// var_dump($item->menu_object->object_id);
			// echo '</pre>';
			if($this->_filter) {
				$is_filter_tax = $this->_filter->term_id == $item->menu_object->object_id;
				$item->current = $item->current && $is_filter_tax;
				$item->current_item_ancestor = !$item->current && $is_filter_tax;
				$item->current_item_parent = $item->current_item_parent && $is_filter_tax;
			}
		}
	}

	private function archive_hack($items) {
		// This will be fixed in core for 4.8
		if(!is_array($items) || count($items) == 0) {
			return;
		}

		foreach ($items as $key => $item) {
			$is_current_item_archive = $item->type == 'post_type_archive' && $item->object == $this->_current_post_type;
			$is_current_item_post_page = $item->object_id == $this->_page_for_posts && 'post' == $this->_current_post_type;
			$item->current_item_archive = $is_current_item_archive || $is_current_item_post_page;
			$this->archive_hack($item->children);
		}
	}

	private function parent_ancestor_hack($items) {
		// This will be fixed in core for 4.8
		if(!is_array($items) || count($items) == 0) {
			return;
		}

		foreach ($items as $key => $item) {
			$item->current_item_ancestor = $item->current_item_ancestor || $item->current_item_archive || $this->is_ancestor($item->children);
			$item->current_item_parent = $item->current_item_parent || $item->current_item_archive || $this->is_parent($item->children);
			$this->parent_ancestor_hack($item->children);
		}
	}

	private function is_ancestor($items) {
		if(!is_array($items) || count($items) == 0) {
			return;
		}

		$is_ancestor = false;

		foreach ($items as $key => $item) {
			$is_ancestor = $item->current || $item->current_item_archive || $this->is_ancestor($item->children);
			if( $is_ancestor ) {
				return $is_ancestor;
			}
		}
	}

	private function is_parent($items) {
		if(!is_array($items) || count($items) == 0) {
			return;
		}

		$is_parent = false;

		foreach ($items as $key => $item) {
			$is_parent = $item->current;
			if( $is_parent ) {
				return $is_parent;
			}
		}
	}
}
