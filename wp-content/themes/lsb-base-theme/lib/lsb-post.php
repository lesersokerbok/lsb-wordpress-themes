<?php

class LSB_Post extends TimberPost {

	public function lsb_test() {
		return "TEST";
	}

	public function thumbnail() {
		if(parent::thumbnail()) {
			return parent::thumbnail();
		} else if ($this->lsb_book) {
			return (new TimberPost($this->lsb_book))->thumbnail;
		}
	}

		// var $_thumbnail;
		//
		// public function lsb_thumbnail() {
		// 	if (!$this->_thumbnail && !$this->) {
		// 		$issues = $this->get_terms('issues');
		// 		if (is_array($issues) && count($issues)) {
		// 			$this->_issue = $issues[0];
		// 		}
		// 	}
		// 	return $this->_issue;
		// }
}
