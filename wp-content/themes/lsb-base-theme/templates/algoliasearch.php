<div id="search-page" class="container-fluid" style="display: none">
	<div class="content row">
		<div class="col-sm-12">
			<div class="page-header">
				<h1><?php esc_html_e( 'Søkeresultat', 'lsb' ); ?></h1>

				<?php if(is_singular('post')) : ?>
					<?php get_template_part('templates/entry-meta'); ?>
				<?php endif; ?>
			</div>
		</div>
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
				<# if (data.images.medium) { #>
					<img src="{{ data.images.medium.url }}"></img>
				<# } else { #>
					<img src="<?php echo get_bloginfo('template_url'); ?>/assets/img/book-cover.jpg"></img>
				<# } #>
			</a>
		</div>
		<header>
			<# if (data._highlightResult.post_title) { #>
				<h2 class="entry-title"><a href="{{ data.permalink }}">{{{ data._highlightResult.post_title.value }}}</a></h2>
			<# } #>

			<# if (data._highlightResult.lsb_isbn && data._highlightResult.lsb_isbn.matchLevel !== "none") { #>
				<p class="meta">
					<?php esc_html_e( 'ISBN:', 'lsb' ); ?>
					{{{ data._highlightResult.lsb_isbn.value }}}
				</p>
			<# } #>

			<# if (data._highlightResult.lsb_published_year && data._highlightResult.lsb_published_year.matchLevel !== "none") { #>
				<p class="meta">
					<?php esc_html_e( 'Utgivelsesår:', 'lsb' ); ?>
					{{{ data._highlightResult.lsb_published_year.value }}}
				</p>
			<# } #>

			<# if (data.relevant_meta.creators.length > 0 ) { #>
				<p class="meta">
					<# for (var index in data.relevant_meta.creators) { #>
						<a href="{{ data.relevant_meta.creators[index].permalink }}">{{{ data.relevant_meta.creators[index].value }}}</a>
					<# } #>
				</p>
			<# } #>

			<# if (data.relevant_meta.publishers.length > 0 ) { #>
				<p class="meta">
					<?php esc_html_e( 'Forlag:', 'lsb' ); ?>
					<# for (var index in data.relevant_meta.publishers) { #>
						<a href="{{ data.relevant_meta.publishers[index].permalink }}">{{{ data.relevant_meta.publishers[index].value }}}</a>
					<# } #>
				</p>
			<# } #>

			<# if (data.relevant_meta.topics.length > 0 ) { #>
				<p class="meta">
					<?php esc_html_e( 'Tema:', 'lsb' ); ?>
					<# for (var index in data.relevant_meta.topics) { #>
						<a href="{{ data.relevant_meta.topics[index].permalink }}">{{{ data.relevant_meta.topics[index].value }}}</a>
					<# } #>
				</p>
			<# } #>

			<# if (data.relevant_meta.partof.length > 0 ) { #>
				<p class="meta">
					<?php esc_html_e( 'Del av:', 'lsb' ); ?>
					<# for (var index in data.relevant_meta.partof) { #>
						<a href="{{ data.relevant_meta.partof[index].permalink }}">{{{ data.relevant_meta.partof[index].value }}}</a>
					<# } #>
				</p>
			<# } #>

			<# if (data.relevant_meta.audience.length > 0 ) { #>
				<p class="meta">
					<?php esc_html_e( 'Passer for:', 'lsb' ); ?>
					<# for (var index in data.relevant_meta.audience) { #>
						<a href="{{ data.relevant_meta.audience[index].permalink }}">{{{ data.relevant_meta.audience[index].value }}}</a>
					<# } #>
				</p>
			<# } #>

			<# if (data.relevant_meta.genre.length > 0 ) { #>
				<p class="meta">
					<?php esc_html_e( 'Sjanger:', 'lsb' ); ?>
					<# for (var index in data.relevant_meta.genre) { #>
						<a href="{{ data.relevant_meta.genre[index].permalink }}">{{{ data.relevant_meta.genre[index].value }}}</a>
					<# } #>
				</p>
			<# } #>

			<# if (data.relevant_meta.customization.length > 0 ) { #>
				<p class="meta">
					<?php esc_html_e( 'Egenskap:', 'lsb' ); ?>
					<# for (var index in data.relevant_meta.customization) { #>
						<a href="{{ data.relevant_meta.customization[index].permalink }}">{{{ data.relevant_meta.customization[index].value }}}</a>
					<# } #>
				</p>
			<# } #>

			<# if (data.relevant_meta.language.length > 0 ) { #>
				<p class="meta">
					<?php esc_html_e( 'Språk:', 'lsb' ); ?>
					<# for (var index in data.relevant_meta.language) { #>
						<a href="{{ data.relevant_meta.language[index].permalink }}">{{{ data.relevant_meta.language[index].value }}}</a>
					<# } #>
				</p>
			<# } #>

			<p class="meta">
				{{{ data.relevant_content }}}
			</p>
		</header>
</script>

<script type="text/html" id="tmpl-instantsearch-empty">
	<p class="lsb-heading-medium"><?php _e('Ingen resultater for', 'lsb_theme_boksok') ?> <em>{{ data.query }}</em></p>
</script>
