<?php

class LSB_Post extends TimberPost {

	public function lsb_read_more() {
		$post_type_obj = get_post_type_object( $this->post_type );
		if(isset($post_type_obj->labels->lsb_read_more)) {
			return sprintf($post_type_obj->labels->lsb_read_more, $this->post_title );
		} else {
			return __('Les hele artikkelen', 'lsb');
		}
	}

	public function lsb_sections() {
		$post_sections = get_field('lsb_post_sections');
		if(!$post_sections) {
			$post_sections = array();
		}

		foreach ($post_sections as $key => &$section) {
			$post_type = $section['acf_fc_layout'];
			$section['post_type'] = $post_type;
			$section['title'] = $section['lsb_title'];
			$section['subtitle'] = $section['lsb_subtitle'];

			if(post_type_exists($post_type)) {
				$section['title'] = [];
				$section['title']['text'] = $section['lsb_title'];
				$section['title']['link'] = get_post_type_archive_link($post_type);
				$section['lsb_posts'] = Timber::get_posts(array('post_type' => $post_type), LSB_Post::class);
			}
		}
		return $post_sections;
	}
}
