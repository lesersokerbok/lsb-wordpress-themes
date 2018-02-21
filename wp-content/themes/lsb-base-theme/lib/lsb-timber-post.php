<?php

class LSB_Post extends TimberPost {

	var $_read_more;
	var $_sections;

	public function preview() {
		return parent::preview()->length(50)->read_more('');
	}

	public function content($page = 0, $len = -1) {

		if($this->post_type !== 'lsb_book') {
			return parent::content($page, $len);
		}

		if( !$this->_content ) {
			$lsb_review = get_field_object( 'lsb_review', $this );
			$lsb_quote = get_field_object( 'lsb_quote', $this );
			$lsb_look_inside = get_field_object( 'lsb_look_inside', $this );

			$this->_content = "";
			if( !empty($lsb_review['value']) ) {
				$this->_content .= sprintf("<h2>%s</h2>%s", $lsb_review['label'], $lsb_review['value']);
			}

			if( !empty($lsb_quote['value']) ) {
				$this->_content .= sprintf("<h2>%s</h2>%s", $lsb_quote['label'], $lsb_quote['value']);
			}

			if( !empty($lsb_look_inside['value']) ) {
				$this->_content .= sprintf("<p><a href='%s'>%s</a></p>", $lsb_look_inside['value'], $lsb_look_inside['label']);
			}
		}

		return $this->_content;
	}

	public function terms($tax = "", $merge = true, $TermClass = "LSB_Term") {
		return parent::terms($tax, true, $TermClass);
	}

	public function role_label() {
		return get_field_object('role', $this)['choices'][get_field('role', $this)];
	}

	public function phone_numbers() {
		$numbers = [];
		if(get_field('phone', $this)) {
			$numbers[] = get_field('phone' ,$this);
		}
		if(get_field('mobile', $this)) {
			$numbers[] = get_field('mobile', $this);
		}
		return $numbers;
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
			$this->_sections = LSB_SectionsFactory::create_sections($this);
		}
		global $page;
		return $page > 1 ? [] : $this->_sections;
	}
}
