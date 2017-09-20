<?php

class LSB_Post extends TimberPost {

	var $_authors;
	var $_read_more;
	var $_sections;

	public function content($page = 0, $len = -1) {

		if($this->post_type !== 'lsb_book') {
			return parent::content($page, $len);
		}

		if( !$this->_content ) {
			$lsb_review = $lsb_pre_reading = get_field_object( 'lsb_review', $this );
			$lsb_quote = $lsb_pre_reading = get_field_object( 'lsb_quote', $this );

			$this->_content = "";
			if( !empty($lsb_review['value']) ) {
				$this->_content .= sprintf("<h2>%s</h2>%s", $lsb_review['label'], $lsb_review['value']);
			}
			if( !empty($lsb_quote['value']) ) {
				$this->_content .= sprintf("<h2>%s</h2>%s", $lsb_quote['label'], $lsb_quote['value']);
			}
		}

		return $this->_content;
	}

	public function terms($tax = "", $merge = true, $TermClass = "LSB_Term") {
		return parent::terms($tax, true, $TermClass);
	}

	public function read_more() {
		if( !$this->_read_more ) {
			$post_type_obj = get_post_type_object( $this->post_type );
			if(isset($post_type_obj->labels->lsb_read_more)) {
				$this->_read_more = sprintf($post_type_obj->labels->lsb_read_more, $this->post_title );
			} else {
				$this->_read_more = __('Les hele artikkelen', 'lsb');
			}
		}

		return $this->_read_more;
	}

	public function sections() {
		if( !$this->_sections ) {
			// $acf_sections = get_field('lsb_sections', $this) ? get_field('lsb_sections', $this) : array ();
			$this->_sections = LSB_SectionsFactory::create_sections($this);
		}
		return $this->_sections;
	}
}