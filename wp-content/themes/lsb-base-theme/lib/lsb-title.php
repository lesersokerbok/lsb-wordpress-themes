<?php

class LSBTitle {
	public function __construct() {
		
	}

	public static function current_title( ) {
    if( is_singular() || is_page() ) {
      return get_the_title();
    } else if ( is_home() ) {
      return get_the_title( get_option('page_for_posts', true));
    } else if ( is_tag() || is_category() || is_tax() || is_post_type_archive ) {
        $queried_object = get_queried_object();
        return $queried_object->label;
    } else if ( is_post_type_archive() ) {
      return post_type_archive_title( '', false );
    }
	}
}

?>
