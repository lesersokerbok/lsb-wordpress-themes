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
		if('lsb_book' == $this->_post_type()) {
			return 'card';
		} else {
			return 'teaser';
		}
	}

	public function title() {
		if(parent::title()) {
			return parent::title();
		} else if($this->_filter_term()) {
			return $this->_filter_term()->name;
		} else {
			return get_post_type_object($this->_post_type())->labels->name;
		}
	}

	public function subtitle() {
		return parent::subtitle();
	}

	public function link() {
		return $this->_filter_term() ? get_term_link($this->_filter_term()) : get_post_type_archive_link($this->_post_type());
	}

	public function posts() {
		if(!$this->_posts) {
			$args = array(
				'post_type' => $this->_post_type(),
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

	protected function _post_type() {
		return $post_type = $this->_acf_section['acf_fc_layout'];
	}

	protected function _filter_term() {
		$filter = $this->_acf_section['lsb_filter'];
		if($filter && $this->_acf_section[$filter]) {
			return $this->_acf_section[$filter];
		}
	}
}

class LSB_MenuSection extends LSB_Section {

	protected $_menu;

	public function layout() {
		return 'menu';
	}

	public function menu() {
		if(!$this->_menu) {
			$this->_menu = new TimberMenu($this->_acf_section['nav_menu']->slug);
		}
		return $this->_menu;
	}

	public function title() {
		return parent::title() ?: $this->menu()->title;
	}
}

class LSB_FeedSection extends LSB_Section {

	protected $_feed;
	protected $_posts;
	protected $_error;

	public function layout() {
		return $this->_acf_section['lsb_feed_layout'];
	}

	public function posts() {
		if(!$this->_feed()) {
			return;
		}

		if(!$this->_posts) {
			$this->_posts = array_map(function($item) {
				return LSB_FeedItemFactory::create_feed_item($item, $this->layout());
			},$this->_feed()->get_items(0, $this->_max_number_of_items()));
		}
		return $this->_posts;
	}

	public function link() {
		if(!$this->_feed()) {
			return;
		}
		return $this->_feed()->get_permalink();
	}

	public function title() {
		if(!$this->_feed()) {
			return parent::title();
		}
		return parent::title() ?: $this->_feed()->get_title();
	}

	public function error() {
		return $this->_error;
	}

	protected function _feed() {
		if(!$this->_feed) {
			$feed = fetch_feed( $this->_feed_url() );
			if( !is_wp_error( $feed )) {
				$this->_feed = $feed;
			} else {
				$this->_error = $feed;
			}
		}
		return $this->_feed;
	}

	protected function _feed_url() {
		return $this->_acf_section['lsb_feed_url'];
	}

	protected function _max_number_of_items() {
		return $this->layout() === 'card' ? 12 : 5;
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
			} elseif($layout == 'lsb_feed') {
				return new LSB_FeedSection($acf_section);
			} else {
				return new LSB_Section($acf_section);
			}
		}, $acf_sections);
	}
}