<?php

class LSBBreadcrumbs {

	private $_menu_location = '';
	private $_menu = false;
	private $_menu_items = array();
	private $_trail = array();
	private $_taxonomy = false;
	private $_blog_home_key = false;
	private $_front_page_key = false;

  public $items = [];

	public function __construct( $menu_location = '' ) {

    $this->_menu_location = $menu_location;
		$menu_locations = get_nav_menu_locations();	

		if ( isset( $menu_locations[ $this->_menu_location ] ) ) {
			$this->_menu = wp_get_nav_menu_object( $menu_locations[ $this->_menu_location ] );
			$this->_menu_items = wp_get_nav_menu_items( $this->_menu->term_id );
		}

		// Convinience
		$this->_blog_home_key = (int) get_option( 'page_for_posts' );
		$this->_front_page_key = (int) get_option( 'page_on_front' );

		if( is_category() || is_tag() || is_tax() ) {
			$this->_taxonomy = get_queried_object()->taxonomy;
		}

		// Create key trail

		if( is_home() ) {

			$this->_trail = array( 
				$this->_blog_home_key 
			);

		} else if( is_page() ) {

			$this->_trail = array_merge( 
				[ get_the_ID() ], 
				get_post_ancestors( get_the_ID() ) 
			);

		} else if ( is_singular( 'post' ) ) {
			
			$this->_trail = array_merge( 
				[ get_the_ID() ],
				[ $this->_blog_home_key ] 
			);

		} else if ( is_singular( 'lsb_book' ) ) {
			
			$this->_trail = array_merge( 
				[ get_the_ID() ],
				[ $this->_front_page_key ]
			);

		} else if( is_singular() ) { // custom post type single
			
			$this->_trail = array(
				get_the_ID(),
				get_post_type()
			);

		} else if( is_category() || is_tag() ) {

			$this->_trail = array_merge( 
				[ get_queried_object_id() ], 
				[ $this->_blog_home_key ]
			);

		} else if( is_tax('lsb_tax_lsb_cat') ) {

			$this->_trail = array( 
				get_queried_object_id()
			);

		} else if( is_tax() && get_post_type() === 'lsb_book' ) {

			$this->_trail = array( 
				get_queried_object_id(),
				$this->_front_page_key
			);

		} else if( is_post_type_archive() ) {

			$this->_trail = array(
				get_post_type()
			);
		}

    $this->items = $this->generate_trail();
	}

	private function generate_trail() {

		$trail = [];
		foreach ($this->_trail as $key ) {
			$menu_item = LSBBreadcrumbs::get_menu_item_object( $key, $this->_menu_items );
			if( !empty( $menu_item ) ) {
				$trail = array_merge( $trail, LSBBreadcrumbs::generate_menu_trail( $menu_item, $this->_menu_items ) );
				break;
			} else {
				$trail[] = LSBBreadcrumbs::custom_menu_item($key, $this->_taxonomy, $this->_blog_home_key);
			}
		}

		if( !empty( $trail) ) {
			$trail[0]->active = true;
		}

		return array_reverse( $trail );
	}

	private function custom_menu_item( $key ) {

		if( !is_int($key) ) {
			return LSBBreadcrumbs::custom_post_type_item( $key );
		} else if ( $key === $this->_blog_home_key || $key === $this->_front_page_key ) {
			return LSBBreadcrumbs::custom_singular_item( $key );
		} else if ( $this->_taxonomy) {
			return LSBBreadcrumbs::custom_term_item( $key, $this->_taxonomy );
		} else {
			return LSBBreadcrumbs::custom_singular_item( $key );
		}
	}

	static private function custom_term_item( $key, $taxonomy ) {
		$term = get_term($key, $taxonomy);

		if( empty( $term ) ) {
			return false;
		}
		return (object) [
			'title' => $term->name,
			'url' => get_term_link($term, $taxonomy)
		];
	}

	static private function custom_singular_item( $key ) {
		return (object) [
			'title' => get_the_title( $key ),
			'url' => get_permalink( $key )
		];
	}

	static private function custom_post_type_item( $key ) {
		return (object) [
			'title' => get_post_type_object( $key )->label,
			'url' => get_post_type_archive_link( $key )
		];
	}

	static private function generate_menu_trail( $menu_item, $menu_items ) {
		$trail = [ $menu_item ];
		// work backwards from the current menu item all the way to the top
		while ( $menu_item = LSBBreadcrumbs::get_parent_menu_item_object( $menu_item, $menu_items ) ) {
			$trail[] = $menu_item;
		}
		return $trail;
	}

	static private function get_menu_item_object( $key,  $menu_items ) {

		$item = false;

		if ( empty( $menu_items ) ) {
			return $item;
		}

		// loop through the entire nav menu and determine whether any have a class="current" or are the current URL (e.g. a Custom Link was used)
		foreach ( $menu_items as $menu_item ) {

      // If menu object id is the same as the current key
      if ($key == $menu_item->object_id) {
        $item = $menu_item;
      }

			// Check if menu item object is the same as current key
			if (!$item && $menu_item->object == $key) {
        $item = $menu_item;
      }

			if ( $item ) {
				break;
			}
		}

		return $item;
	}

	static private function get_parent_menu_item_object( $child_menu_item, $menu_items ) {

		$parent_menu_item = false;

		if ( empty( $child_menu_item ) || empty ( $menu_items ) ) {
			return $parent_menu_item;
		}

		foreach ( $menu_items as $menu_item ) {
			if ( absint( $child_menu_item->menu_item_parent ) == absint( $menu_item->ID ) ) {
				$parent_menu_item = $menu_item;
				break;
			}
		}

		return $parent_menu_item;
	}

	static private function custom_current_menu_item( $key ) {
		$title = get_the_title( $key );

		if( empty( $title ) ) {
			$object = get_queried_object();

			if( property_exists($object, 'label') ) {
				$title = $object->label;
			} else if( property_exists($object, 'name') ) {
				$title = $object->name;
			}
		}

		return (object) [
			"title" => $title,
			"active" => true
		];
	}

	static private function custom_parent_menu_item( $key ) {
		if(is_int($key)) {
			$title = get_the_title( $key );
			$url = get_permalink( $key );
		} else {
			$title = get_post_type_object( $key )->label;
			$url = get_post_type_archive_link( $key );
		}

		return !empty( $title ) && !empty( $url) ? (object) [ 'title' => $title, 'url' => $url ] : false;
	}

}