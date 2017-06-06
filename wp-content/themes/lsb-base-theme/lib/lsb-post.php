<?php

class LSB_Post extends TimberPost {

	var $_authors;
	var $_read_more;
	var $_sections;

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

	public function authors() {
		if( !$this->_authors ) {
			if($this->post_type == 'lsb_book') {
				$this->_authors = get_the_term_list( $this->ID, 'lsb_tax_author', '<ul><li>', ', </li><li>', '</li></ul>' );
			} elseif($this->post_type == 'lsb_reading_guide') {
				$this->_authors = $this->post_excerpt;
			}
		}

		return $this->_authors;
	}

	public function sections() {
		if( !$this->_sections ) {
			$acf_sections = get_field('lsb_sections') ? get_field('lsb_sections') : array ();
			$this->_sections = transform_acf_sections($acf_sections);
		}
		return $this->_sections;
	}
}
