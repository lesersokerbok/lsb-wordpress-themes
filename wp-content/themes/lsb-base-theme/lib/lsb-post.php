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
				$section['title'] = $section['lsb_title'];
				$section['subtitle'] = $section['lsb_subtitle'];
				$section['layout'] = $section['acf_fc_layout'];

				if(post_type_exists($section['layout'])) {
					$post_type = $section['layout'];
					$section['post_type'] = $post_type;
					$section['link'] = get_post_type_archive_link($post_type);

					$slug = $post_type.$modified;
					$query = array(
						'post_type' => $post_type,
						'posts_per_page' => 12
					);

					$filter = $section['lsb_filter'];

					if($filter && $section[$filter]) {
						$term = $section[$filter];
						$query['tax_query'][] = array ( 
							array ( 
								'taxonomy' => $section['lsb_filter'],
								'field' => 'object', 
								'terms' => $term
							)
						);

						$slug .= $term->slug;
						$section['title'] = $section['title'] ? $section['title'] : $term->name;
						$section['link'] = get_term_link($term);
					}

					$section['title'] = $section['title'] ? $section['title'] : get_post_type_object($post_type)->labels->name;

					$section['posts'] = TimberHelper::transient($slug, function()  use ($query) {
						return Timber::get_posts($query, LSB_Post::class);
					}, 600);

				} elseif($section['layout'] == 'lsb_menu_nav') {
					$section['layout'] = 'menu';
					$menu_term = $section['nav_menu'];
					$menu = new TimberMenu($menu_term->slug);
					$section['items'] = array_map(function($menu_item) {
						$item = [
							'label' => $menu_item->name,
							'link' => $menu_item->link,
						];

						$term = get_term($menu_item->object_id, $menu_item->object);

						if(!is_wp_error($term)) {
							$icon_id = get_field('lsb_tax_topic_icon', $term, false);
							if($icon_id) {
								$item['icon'] = new TimberImage($icon_id);
							}
						}

						return $item;
					}, $menu->get_items());
					$section['title'] = $section['title'] ? $section['title'] : $menu_term->name;
				}				
			}
		}

		return $this->_sections;
	}
}
