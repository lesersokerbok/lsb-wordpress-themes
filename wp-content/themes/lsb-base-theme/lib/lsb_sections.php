<?php 

class LSB_Section {

}

class LSB_PostsSection extends LSB_Section {

	protected $_layout;
	protected $_title;
	protected $_subtitle;
	protected $_post_type;
	protected $_link;
	protected $_posts;

	function __construct($acf_section) {
		$post_type = $acf_section['acf_fc_layout'];
		$title = get_post_type_object($post_type)->labels->name;
		$link = get_post_type_archive_link($post_type);
		$filter = $acf_section['lsb_filter'];
		
		$args = array(
			'post_type' => $post_type,
			'posts_per_page' => 12
		);
	
		if($filter && $acf_section[$filter]) {
			$term = $acf_section[$filter];
			$args['tax_query'][] = array ( 
				array ( 
					'taxonomy' => $filter,
					'field' => 'object', 
					'terms' => $term
				)
			);
	
			$title = $term->name;
			$link = get_term_link($term);
		}
	
		$query = new WP_Query( $args );
	
		$hashed = md5(serialize($query));
		$this->_posts = TimberHelper::transient('lsb_section_'.$hashed, function()  use ($query) {
			return Timber::get_posts($query, LSB_Post::class);
		}, 600);
	
		
		$this->_layout = $post_type;
		$this->_title = $acf_section['lsb_title'] ? $acf_section['lsb_title'] : $title;
		$this->_subtitle = $acf_section['lsb_subtitle'];
		$this->_post_type = $post_type;
		$this->_link = $link;
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

	public function post_type() {
		return $this->_post_type;
	}

	public function link() {
		return $this->_link;
	}

	public function posts() {
		return $this->_posts;
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