<form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
  <div class="input-group">
    <input type="search" value="<?php if (is_search()) { echo get_search_query(); } ?>" name="s" class="search-field form-control" placeholder="Søk etter en forfatter, en tittel eller et tema!  ">
    <label class="hide">Søk etter</label>
    <span class="input-group-btn">
      <button type="submit" class="search-submit btn btn-default">Søk</button>
    </span>
  </div>
</form>
