<?php

class LSBMenu extends TimberMenu {
	public function __construct( $slug ) {
		parent::__construct($slug);
		$this->parent_ancestor_hack($this->items);

	}

	private function parent_ancestor_hack($items) {
		// This will be fixed in core for 4.8
		if(!is_array($items) || count($items) == 0) {
			return;
		}

		foreach ($items as $key => $item) {
			$item->current_item_ancestor = $this->is_ancestor($item->children);
			$item->current_item_parent = $this->is_parent($item->children);
			$this->parent_ancestor_hack($item->children);
		}
	}

	private function is_ancestor($items) {
		if(!is_array($items) || count($items) == 0) {
			return;
		}

		$is_ancestor = false;

		foreach ($items as $key => $item) {
			$is_ancestor = $item->current || $this->is_ancestor($item->children);
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
