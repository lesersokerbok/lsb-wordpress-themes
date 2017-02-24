<form role="search" method="get" class="search-form form-inline" action="<?php echo esc_url(home_url('/')); ?>">
	<label class="sr-only"><?php _e('Søk etter:', 'lsb'); ?></label>
	<div class="input-group">
		<input type="search" value="<?php echo get_search_query(); ?>" name="s" class="search-field form-control" placeholder="<?php _e('Søk', 'lsb'); ?> <?php bloginfo('name'); ?>">
		<span class="input-group-btn">
			<button type="submit" class="search-submit btn btn-default"><?php _e('Søk', 'lsb'); ?></button>
		</span>
	</div>
</form>
