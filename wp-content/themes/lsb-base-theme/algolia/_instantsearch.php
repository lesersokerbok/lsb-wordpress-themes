<?php

$input_placeholder =  __('Søk etter forfatter, tittel, tema, isbn ...', 'lsb_boksok');
$input_value = get_search_query();

$lsb_cat_filter_term = get_lsb_cat_filter_term();
$url_addon = "";
if($lsb_cat_filter_term) {
	$url_addon = '?filter=' . $lsb_cat_filter_term->slug;
}

?>

<div id="search-page" class="collapse">
  <section id="search-form">
    <div class="container">
      <div class="input-group input-group-lg" id="algolia-insta-search">
        <input type="search" class="form-control" value="<?php echo $input_value ?>" placeholder="<?php echo $input_placeholder ?>">
        <span class="input-group-btn">
          <button class="btn btn-default" type="submit">
            <span class="icon icon-magnifying-glass"></span>
          </button>
        </span>
      </div>
    </div>
  </section>

  <main role="main" id="search-results">
    <div class="container">
      <div id="algolia-hits">
        <div class="loader">
          <?php _e('Søker', 'lsb_boksok'); ?>
        </div>
      </div>
    </div>
    <nav class="post-nav text-xs-center lsb-page-row">
      <div id="algolia-pagination" class="text-xs-center"></div>
    </nav>
  </main>
</div>

	<script type="text/html" id="tmpl-instantsearch-hit">
		<!-- Should not be used, but if it does it will not fail -->
	</script>

  <script type="text/html" id="tmpl-instantsearch-hits">
    <#
		  for ( var book_index in data.hits ) {
        var book = data.hits[book_index];

        var relevant_content = null;
        var use_relevant_content = true;

        var relevant_meta = {};

        relevant_meta.creators = {
          terms: [],
          label: '<?= __('av', 'lsb-theme-books') ?>'
        };

        relevant_meta.topics = {
          terms: [],
          label: '<?= __('tema', 'lsb-theme-books') ?>'
        };

        relevant_meta.partof = {
          terms: [],
          label: '<?= __('del av', 'lsb-theme-books') ?>'
        };

        relevant_meta.audience = {
          terms: [],
          label: '<?= __('passer for', 'lsb-theme-books') ?>'
        };

        if(book._highlightResult.post_title.matchLevel === 'full') {
          use_relevant_content = false;
        }


        for ( var tax_key in book._highlightResult.taxonomies ) {
          var tax_terms = book._highlightResult.taxonomies[tax_key];
          for ( var term_index in tax_terms ) {
            var tax_term = tax_terms[term_index];
            if(tax_term.matchLevel !== 'none' || tax_key === 'lsb_tax_author') {
              if( tax_key === 'lsb_tax_author' || tax_key === 'lsb_tax_illustrator' || tax_key === 'lsb_tax_translator') {
                relevant_meta.creators.terms.push({value: tax_term.value, permalink: book.taxonomies_permalinks[tax_key][term_index]});
              } else if( tax_key === 'lsb_tax_topic') {
                relevant_meta.topics.terms.push({value: tax_term.value, permalink: book.taxonomies_permalinks[tax_key][term_index]});
              } else if( tax_key === 'lsb_tax_series' || tax_key === 'lsb_tax_list' ) {
                relevant_meta.partof.terms.push({value: tax_term.value, permalink: book.taxonomies_permalinks[tax_key][term_index]});
              } else if( tax_key === 'lsb_tax_age' || tax_key === 'lsb_tax_audience' ) {
                relevant_meta.audience.terms.push({value: tax_term.value, permalink: book.taxonomies_permalinks[tax_key][term_index]});
              }
            }

            if(tax_term.matchLevel === 'full') {
              use_relevant_content = false;
            }
          }
        }


        for ( var snippet_index in book._snippetResult ) {
          var snippet = book._snippetResult[snippet_index];
          if( snippet.matchLevel !== 'none') {
            relevant_content = snippet.value;
            break;
          }
        }

    #>

      <article class="lsb-book-collection-item">
        <a class="lsb-book-collection-item-cover"
          title="{{ book.post_title }}"
          alt="<?= __('Omslag - ', 'lsb-theme-books') ?>{{ book.post_title }}"
          href="{{ book.permalink }}">

          <# if(book.images.medium) { #>
            <img src="{{ book.images.medium.url }}" alt="{{ book.post_title }}" title="{{ book.post_title }}" itemprop="image" />
          <# } #>

        </a>
        <h1 class="lsb-book-collection-item-title">
          <a href="{{ book.permalink }}">{{{ book._highlightResult.post_title.value }}}</a>
        </h1>

        <# if(relevant_content && use_relevant_content) { #>
          <p class="lsb-book-collection-item-content">
            {{{ relevant_content }}}
          </p>
        <# } #>

        <p class="lsb-book-collection-item-meta">
          <# for (var meta_index in relevant_meta) { #>
            <# if (relevant_meta[meta_index].terms.length > 0) { #>
            <span class="lsb-tags">
              <span class="lsb-tag lsb-tag-label">{{ relevant_meta[meta_index].label }}</span>
              <# for (var term_index in relevant_meta[meta_index].terms) { #>
                <span class="lsb-tag"><a href="{{{ relevant_meta[meta_index].terms[term_index].permalink }}}">
                  {{{ relevant_meta[meta_index].terms[term_index].value }}}
                </a></span>
              <# } #>
            </span>
            <# } #>
          <# } #>
        </p>
		  </article>

    <# } #>

	</script>

	<script type="text/html" id="tmpl-instantsearch-empty">
		<p class="lsb-heading-medium"><?php _e('Ingen resultater for', 'lsb_theme_boksok') ?> <em>{{data.query}}</em></p>
	</script>


	<script type="text/javascript">
		jQuery(function() {

				// Instantiate instantsearch.js
				var search = instantsearch({
					appId: algolia.application_id,
					apiKey: algolia.search_api_key,
					indexName: algolia.indices.posts_lsb_book.name,
					urlSync: {
						mapping: {
							'q': 'sok'
						},
						trackedParameters: ['query']
					},
					searchParameters: {
						facetingAfterDistinct: true,
						attributesToSnippet: [
							'lsb_review:20',
							'lsb_quote:20'
						],
						<?php if($lsb_cat_filter_term) : ?>
            facets: ['taxonomies.lsb_tax_lsb_cat'],
						facetsRefinements: {
    					'taxonomies.lsb_tax_lsb_cat': ["<?= htmlspecialchars_decode($lsb_cat_filter_term->name) ?>"]
            },
						<?php endif; ?>
					},
					searchFunction: function(helper) {
            console.log("Søk", search.helper.state.query)
            var savedPage = helper.state.page;
            var mainSections = jQuery('main:not(#search-results)');
            var searchResults = jQuery('main#search-results');
						if (search.helper.state.query === '') {
              mainSections.show();
              searchResults.hide();
						  return;
						}
            search.helper.setQueryParameter('distinct', true);
						search.helper.setQueryParameter('filters', '');
						search.helper.setPage(savedPage);
						helper.search();
            mainSections.hide();
            searchResults.show();
					}
				});

				// Search box widget
				search.addWidget(
					instantsearch.widgets.searchBox({
						container: '#algolia-fo input',
						placeholder: jQuery('#algolia-insta-search input').attr('placeholder'),
						wrapInput: false,
					})
				);

				// Hits widget
				search.addWidget(
					instantsearch.widgets.hits({
						container: '#algolia-hits',
						hitsPerPage: 30,
						transformData: {
							allItems: function(data) {
                for (var book_key in data.hits) {
                  var book = data.hits[book_key];
                  book.permalink = book.permalink + "<?= $url_addon ?>";
                  for ( var tax_key in book.taxonomies_permalinks ) {
                    for ( var term_index in book.taxonomies_permalinks[tax_key] ) {
                      book.taxonomies_permalinks[tax_key][term_index] = book.taxonomies_permalinks[tax_key][term_index] + "<?= $url_addon ?>";
                    }
                  }
                }
								return data;
							},
						},
						templates: {
							empty: wp.template("instantsearch-empty"),
							allItems: wp.template('instantsearch-hits')
						}
					})
				);

				// Pagination widget
				search.addWidget(
					instantsearch.widgets.pagination({
						container: '#algolia-pagination',
						cssClasses: {
							root: 'pagination'
						}
					})
				);

//				// Currently refined
//
//				search.addWidget(
//					instantsearch.widgets.currentRefinedValues({
//						container: '#algolia-refined-values',
//						clearAll: 'after',
//						templates: {
//							header: '<h3 class="lsb-heading-small"><?php _e("Filter", "lsb-theme-boksok") ?></h3>',
//      				clearAll: '<?php _e("Nullstill", "lsb-theme-boksok") ?>'
//    				},
//						cssClasses: {
//							clearAll: 'btn btn-default btn-sm'
//						}
//					})
//				);
//
//				// Facet widget: lsb_tax_lsb_cat
//				search.addWidget(
//					instantsearch.widgets.hierarchicalMenu({
//						container: '#facet-category',
//						attributes: ['taxonomies_hierarchical.lsb_tax_lsb_cat.lvl0', 'taxonomies_hierarchical.lsb_tax_lsb_cat.lvl1'],
//						sortBy: ['count:desc', 'name:asc'],
//						limit: 10,
//						templates: {
//							header: '<h3 class="lsb-heading-small">Kategori</h3>'
//						}
//					})
//				);

				// Start
				search.start();

        $searchPage = jQuery('#search-page');
        $searchPageToggleButton = jQuery('[data-target="#search-page"]');
        $searchInput = jQuery('#algolia-insta-search input').attr('type', 'search');
        $searchButton = jQuery('#algolia-insta-search button').attr('type', 'submit');

        if(search.helper.state.query !== '') {
          $searchPage.collapse('show');
          $searchPageToggleButton.addClass('active');
        }

        $searchPage.on('shown.bs.collapse', function () {
          console.log("show");
          $searchPageToggleButton.addClass('active');
          $searchPageToggleButton.blur();
          $searchInput.attr('type', 'search').select();
          if(search.helper.state.query !== '') {
            jQuery('main:not(#search-results)').hide();
          }
        })

        $searchPage.on('hide.bs.collapse', function () {
          $searchPageToggleButton.removeClass('active');
          $searchPageToggleButton.blur();
          jQuery('main:not(#search-results)').show();
        })

        $searchButton.bind('keyup',function(e) {
          if (e.key == 'Enter') {
            jQuery(this).blur();
          }
        });

        $searchInput.bind('keyup',function(e) {
          if (e.key == 'Enter') {
            jQuery(this).blur();
          }
        });

		});
	</script>
