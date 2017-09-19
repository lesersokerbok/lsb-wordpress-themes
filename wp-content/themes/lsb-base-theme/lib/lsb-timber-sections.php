<?php 

class LSB_Section {
	protected $_acf_section;

	function __construct($acf_section) {
		$this->_acf_section = $acf_section;
	}

	public function title() {
		return $this->_acf_section['lsb_title'];
	}

	public function subtitle() {
		return $this->_acf_section['lsb_subtitle'];
	}
}

class LSB_PostsSection extends LSB_Section {

	protected $_posts;

	public function layout() {
		return $this->post_type();
	}

	public function title() {
		if(parent::title()) {
			return parent::title();
		} else if($this->_filter_term()) {
			return $this->_filter_term()->name;
		} else {
			return get_post_type_object($this->post_type())->labels->name;
		}
	}

	public function subtitle() {
		return parent::subtitle();
	}

	public function post_type() {
		return $post_type = $this->_acf_section['acf_fc_layout'];
	}

	public function link() {
		return get_term_link($this->_filter_term()) || get_post_type_archive_link($post_type);
	}

	public function posts() {
		if(!$this->_posts) {
			$args = array(
				'post_type' => $this->post_type(),
				'posts_per_page' => 12
			);
		
			if($this->_filter_term()) {
				$args['tax_query'][] = array ( 
					array ( 
						'taxonomy' => $this->_filter_term()->taxonomy,
						'field' => 'object', 
						'terms' => $this->_filter_term()
					)
				);
			}
		
			$query = new WP_Query( $args );
			$hashed = md5(serialize($query));

			$this->_posts = TimberHelper::transient('lsb_section_'.$hashed, function()  use ($query) {
				return Timber::get_posts($query, LSB_Post::class);
			}, 600);
		}
		return $this->_posts;
	}

	protected function _filter_term() {
		$filter = $this->_acf_section['lsb_filter'];
		if($filter && $this->_acf_section[$filter]) {
			return $this->_acf_section[$filter];
		}
	}
}

class LSB_MenuSection extends LSB_Section {

	protected $_layout;
	protected $_title;
	protected $_subtitle;
	protected $_items;

	function __construct($acf_section) {
		$menu_term = $acf_section['nav_menu'];
		$menu = new TimberMenu($menu_term->slug);

		$this->_layout = 'menu';
		$this->_title = $acf_section['lsb_title'] ? $acf_section['lsb_title'] : $menu_term->name;
		$this->_subtitle = $acf_section['lsb_subtitle'];
		$this->items = array_map(function($menu_item) {
			$item = [
				'name' => $menu_item->name,
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
	}

	public function layout() {
		return $this->_layout;
	}

	public function title() {
		return $this->_title;
	}

	public function subtitle() {
		return $this->_subtitle;
	}

	public function items() {
		return $this->_items;
	}
}

class LSB_SectionsFactory {
	public static function create_sections($object) {
		$acf_sections = get_field('lsb_sections', $object) ? get_field('lsb_sections', $object) : array ();
		
		return array_map(function($acf_section) {
			$layout = $acf_section['acf_fc_layout'];
		
			if(post_type_exists( $layout )) {
				return new LSB_PostsSection($acf_section);
			} elseif($layout == 'lsb_menu_nav') {
				return new LSB_MenuSection($acf_section);
			}
		}, $acf_sections);
	}
}