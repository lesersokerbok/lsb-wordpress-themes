<?php

class LSB_Term extends TimberTerm {

	var $_icon;
	var $_hidden;
	var $_sections;

	public function icon() {
		if( !isset( $this->_icon ) ) {
			$icon_id = get_field(  'lsb_tax_topic_icon', $this, false);
			if($icon_id) {
				$this->_icon = new TimberImage( $icon_id );
			}
		}

		return $this->_icon;
	}

	public function hidden() {
		if( !isset( $this->_hidden ) ) {
			$this->_hidden = get_field(  'lsb_tax_topic_hide_term', $this, false);
		}

		return $this->_hidden;
	}

	public function translations() {
		if( !isset( $this->_translations ) ) {
			$field_keys = array_keys(get_fields($this));
			$field_keys = array_filter($field_keys, function($key) {
				return strpos($key, 'lsb_translation') !== false;
			});

			$translations = array_map(function($key) {
				$translation = get_field_object($key, $this);
				return [
					'title' => $translation['value']['lsb_title'],
					'description' => $translation['value']['lsb_description'],
					'key' => $key,
					'label' => $translation['label'],
					'class' => $translation['wrapper']['class']
				];
			}, $field_keys);

			$this->_translations = array_filter($translations, function($translation) {
				return !!$translation['description'];
			});
		}
		return $this->_translations;
	}

	public function sections() {
		if( !isset($this->_sections) ) {
			$this->_sections = LSB_SectionsFactory::create_sections($this);
		}
		return $this->_sections;
	}
}
