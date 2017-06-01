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
			$this->_sections = get_field('lsb_sections') ? get_field('lsb_sections') : array ();

			$modified = get_the_modified_date( 'U', $this );

			foreach ($this->_sections as $key => &$section) {
				$post_type = $section['acf_fc_layout'];
				if(post_type_exists($post_type)) {
					$section['post_type'] = $post_type;
					$section['title'] = $section['lsb_title'];
					$section['link'] = get_post_type_archive_link($post_type);
					$section['subtitle'] = $section['lsb_subtitle'];

					$slug = $post_type.$modified;
					$query = array(
						'post_type' => $post_type,
						'posts_per_page' => 12
					);

					if($section['lsb_filter']) {
						$filter = $section['lsb_filter'];
						$term_id = $section[$filter];
						$query['tax_query'][] = array ( 
							array ( 
								'taxonomy' => $section['lsb_filter'],
								'field' => 'id', 
								'terms' => $term_id
							)
						);

						$slug .= $term_id;
						$section['link'] = get_term_link($term_id);
					}

					$section['posts'] = TimberHelper::transient($slug, function()  use ($query) {
						return Timber::get_posts($query, LSB_Post::class);
					}, 600);
				}
			}
		}

		return $this->_sections;
	}
}
