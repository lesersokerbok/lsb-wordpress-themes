
(function($) {
	console.log("test");

	function addRelevantMetaAndContent(book) {
		var relevant_content = null;
		var relevant_meta = {};

		relevant_meta.creators = {
			terms: [],
		};

		relevant_meta.topics = {
			terms: [],
		};

		relevant_meta.partof = {
			terms: [],
		};

		relevant_meta.audience = {
			terms: [],
		};

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
			}
		}


		for ( var snippet_index in book._snippetResult ) {
			var snippet = book._snippetResult[snippet_index];
			if( snippet.matchLevel !== 'none') {
				relevant_content = snippet.value;
				break;
			}
		}

		book.relevant_content = relevant_content;
		book.relevant_meta = relevant_meta;

	}

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
		},
		searchFunction: function(helper) {
			console.log("Søk", search.helper.state.query)
			var savedPage = helper.state.page;
			var mainSections = $('main:not(#search-results)');
			var searchResults = $('main#search-results');
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
			container: '#algolia-form input',
			placeholder: $('#algolia-form input').attr('placeholder'),
			wrapInput: false,
		})
	);

	// Hits widget
	search.addWidget(
		instantsearch.widgets.hits({
			container: '#algolia-hits',
			hitsPerPage: 30,
			transformData: {
				item: function(book) {
					for ( var tax_key in book.taxonomies_permalinks ) {
						for ( var term_index in book.taxonomies_permalinks[tax_key] ) {
							book.taxonomies_permalinks[tax_key][term_index] = book.taxonomies_permalinks[tax_key][term_index] + "<?= $url_addon ?>";
						}
					}

					addRelevantMetaAndContent(book);

					return book;
				},
			},
			templates: {
				empty: wp.template("instantsearch-empty"),
				item: wp.template('instantsearch-hit')
			},
			cssClasses: {
				root: ['loop'],
				item: ['lsb_book', 'summary']
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

	// Start
	search.start();

	$searchPage = $('#search-page');
	$searchInput = $('#algolia-form input').attr('type', 'search');
	$searchButton = $('#algolia-form button').attr('type', 'submit');

	$searchInput.bind('keyup',function(e) {
		if(search.helper.state.query !== '') {
			$searchPage.removeClass('hidden');
		} else {
			$searchPage.addClass('hidden');
		}
	});

	// if(search.helper.state.query !== '') {
	// 	$searchPage.collapse('show');
	// }
	//
	// $searchPage.on('shown.bs.collapse', function () {
	// 	$searchPageToggleButton.addClass('active');
	// 	$searchPageToggleButton.blur();
	// 	$searchInput.attr('type', 'search').select();
	// 	if(search.helper.state.query !== '') {
	// 		$('main:not(#search-results)').hide();
	// 	}
	// })

	// $searchPage.on('hide.bs.collapse', function () {
	// 	$searchPageToggleButton.removeClass('active');
	// 	$searchPageToggleButton.blur();
	// 	$('main:not(#search-results)').show();
	// })
	//
	// $searchButton.bind('keyup',function(e) {
	// 	if (e.key == 'Enter') {
	// 		$(this).blur();
	// 	}
	// });
	//
	// $searchInput.bind('keyup',function(e) {
	// 	if (e.key == 'Enter') {
	// 		$(this).blur();
	// 	}
	// });

})(jQuery); // Fully reference jQuery after this point.
