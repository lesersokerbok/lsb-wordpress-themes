<?php

class LsbMimeTypes {
	public function __construct() {
		add_filter('upload_mimes', array($this, 'add_custom_upload_mime_types'));
	}

	public function add_custom_upload_mime_types( $mime_types ) {

		$mime_types['eps'] = 'application/postscript';

		return $mime_types;
	}
}

?>
