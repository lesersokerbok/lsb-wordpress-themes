<?php

class LSB_Post extends TimberPost {

	public function lsb_read_more() {
		$post_type_obj = get_post_type_object( $this->post_type );
		if($post_type_obj->labels->lsb_read_more) {
			return sprintf($post_type_obj->labels->lsb_read_more, $this->post_title );
		} else {
			return __('Les hele artikkelen', 'lsb');
		}
	}
}
