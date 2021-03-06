<form role="search" id="algolia-form" method="get" class="lsb-search-form" action="<?php echo esc_url(home_url('/')); ?>">
  <div class="input-group">
    <input type="search" value="<?php echo get_search_query(); ?>" name="s" class="search-field form-control" placeholder="<?php echo __('Søk etter en forfatter, en tittel eller et tema!', 'lsb_boksok'); ?>">
    <span class="input-group-btn">
      <button type="submit" class="search-submit btn btn-default"><?php echo __('Søk', 'lsb_boksok'); ?></button>
    </span>
  </div>
</form>
