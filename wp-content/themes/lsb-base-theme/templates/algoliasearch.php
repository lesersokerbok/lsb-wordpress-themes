<div id="search-page" class="hidden container-fluid">
	<div class="content row">
		<div id="algolia-hits" class="col-sm-12">
		</div>
		<nav class="post-nav text-xs-center lsb-page-row">
			<div id="algolia-pagination" class="text-xs-center"></div>
		</nav>
	</div>
</div>

<script type="text/html" id="tmpl-instantsearch-hit">
		<div class="entry-image">
			<a class="thumbnail" href="{{ data.permalink }}">
				<# if(data.images.medium) { #>
					<img src="{{ data.images.medium.url }}"></img>
				<# } #>
			</a>
		</div>
		<header>
			<h2 class="entry-title"><a href="{{ data.permalink }}">{{ data.post_title }}</a></h2>
			<p class="meta">

			</p>
		</header>
</script>

<script type="text/html" id="tmpl-instantsearch-empty">
	<p class="lsb-heading-medium"><?php _e('Ingen resultater for', 'lsb_theme_boksok') ?> <em>{{data.query}}</em></p>
</script>
