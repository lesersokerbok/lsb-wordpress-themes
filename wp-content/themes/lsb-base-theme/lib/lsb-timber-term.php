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
  
  public function sections() {
		if( !$this->_sections ) {
      // $acf_sections = get_field('lsb_sections', $this) ? get_field('lsb_sections', $this) : array ();
			$this->_sections = LSB_SectionsFactory::create_sections($this);
		}
		return $this->_sections;
	}
}
