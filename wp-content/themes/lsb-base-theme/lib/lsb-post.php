<?php

class LSB_Post extends TimberPost {

	var $_read_more;
	var $_sections;

	public function lsb_read_more() {
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

	public function lsb_sections() {
		if( !$this->_sections ) {
			$this->_sections = get_field('lsb_post_sections');
			if( !$this->_sections) {
				$this->_sections = array();
			}

			foreach ($this->_sections as $key => &$section) {
				$post_type = $section['acf_fc_layout'];
				$section['post_type'] = $post_type;

				if(post_type_exists($post_type)) {
					$section['title'] = $section['lsb_title'];
					$section['link'] = get_post_type_archive_link($post_type);
					$section['subtitle'] = $section['lsb_subtitle'];
					$section['posts'] = Timber::get_posts(array('post_type' => $post_type), LSB_Post::class);
				}
			}
		}

		return $this->_sections;
	}
}
