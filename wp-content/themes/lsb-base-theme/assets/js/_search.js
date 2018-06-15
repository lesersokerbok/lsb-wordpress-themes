(function ($) {
  if (typeof algolia === "undefined") {
    console.log("Algolia is not set up properly");
    return;
  }

  if (algolia.indices.searchable_posts === undefined) {
    console.log("It looks like you haven't indexed the searchable posts index.");
    return;
  }

  if (algolia.indices.searchable_posts.name.indexOf("wp_lsb_") > -1) {
    console.log("Do not instasearch");
    return;
  }

  console.log(algolia);
  console.log("Set up instasearch");

  function addRelevantMetaAndContent(book) {
    var useRelevantContent = true;
    var relevant_meta = {};

    relevant_meta.creators = [];
    relevant_meta.publishers = [];
    relevant_meta.categories = [];
    relevant_meta.topics = [];
    relevant_meta.partof = [];
    relevant_meta.audience = [];
    relevant_meta.genre = [];
    relevant_meta.customization = [];
    relevant_meta.language = [];

    for (var tax_key in book._highlightResult.taxonomies) {
      var tax_terms = book._highlightResult.taxonomies[tax_key];

      for (var term_index in tax_terms) {
        var tax_term = tax_terms[term_index];
        if (tax_term.matchLevel !== "none" || tax_key === "lsb_tax_author") {
          if (
            tax_key === "lsb_tax_author" ||
            tax_key === "lsb_tax_illustrator" ||
            tax_key === "lsb_tax_translator"
          ) {
            relevant_meta.creators.push({
              value: tax_term.value,
              permalink: book.taxonomies_permalinks[tax_key][term_index]
            });
          } else if (tax_key === "lsb_tax_publisher") {
            relevant_meta.publishers.push({
              value: tax_term.value,
              permalink: book.taxonomies_permalinks[tax_key][term_index]
            });
          } else if (tax_key === "lsb_tax_lsb_cat") {
            relevant_meta.categories.push({
              value: tax_term.value,
              permalink: book.taxonomies_permalinks[tax_key][term_index]
            });
          } else if (tax_key === "lsb_tax_topic") {
            relevant_meta.topics.push({
              value: tax_term.value,
              permalink: book.taxonomies_permalinks[tax_key][term_index]
            });
          } else if (
            tax_key === "lsb_tax_series" ||
            tax_key === "lsb_tax_list"
          ) {
            relevant_meta.partof.push({
              value: tax_term.value,
              permalink: book.taxonomies_permalinks[tax_key][term_index]
            });
          } else if (
            tax_key === "lsb_tax_age" ||
            tax_key === "lsb_tax_audience"
          ) {
            relevant_meta.audience.push({
              value: tax_term.value,
              permalink: book.taxonomies_permalinks[tax_key][term_index]
            });
          } else if (
            tax_key === "lsb_tax_genre"
          ) {
            relevant_meta.genre.push({
              value: tax_term.value,
              permalink: book.taxonomies_permalinks[tax_key][term_index]
            });
          } else if (
            tax_key === "lsb_tax_customization"
          ) {
            relevant_meta.customization.push({
              value: tax_term.value,
              permalink: book.taxonomies_permalinks[tax_key][term_index]
            });
          } else if (
            tax_key === "lsb_tax_language"
          ) {
            relevant_meta.language.push({
              value: tax_term.value,
              permalink: book.taxonomies_permalinks[tax_key][term_index]
            });
          }
        }

        if (tax_term.matchLevel !== "none") {
          // Do not show relevant content when you have a hit in taxonomy
          useRelevantContent = false;
        }
      }
    }

    if (
      (book._highlightResult.lsb_isbn && book._highlightResult.lsb_isbn.matchLevel !== "none")
      || (book._highlightResult.lsb_published_year && book._highlightResult.lsb_published_year.matchLevel !== "none")
      || (book._highlightResult.post_title && book._highlightResult.post_title.matchLevel !== "none")
    ) {
      // Do not show relevant content when you have a hit on more specific content
      useRelevantContent = false;
    }

    if (useRelevantContent) {
      for (var snippet_index in book._snippetResult) {
        var snippet = book._snippetResult[snippet_index];
        if (snippet.matchLevel !== "none") {
          book.relevant_content = snippet.value;
          break;
        }
      }
    }

    book.relevant_meta = relevant_meta;
  }

  var search = instantsearch({
    appId: algolia.application_id,
    apiKey: algolia.search_api_key,
    indexName: algolia.indices.searchable_posts.name,
    urlSync: {
      mapping: {
        q: "s"
      },
      trackedParameters: ["query"]
    },
    searchParameters: {
      facetingAfterDistinct: true,
      attributesToSnippet: ["lsb_review:20", "lsb_quote:20"]
    },
    searchFunction: function (helper) {
      var savedPage = helper.state.page;
      var isSearchPage = $("body").hasClass("search");
      var mainSections = $("main");
      var searchResults = $("#search-page");
      var pageNav = $(".lsb-navbar-page");

      if (search.helper.state.query === "" && !isSearchPage) {
        mainSections.show();
        pageNav.show();
        searchResults.hide();
        return;
      }

      search.helper.setQueryParameter("distinct", true);
      search.helper.setQueryParameter("filters", "");
      search.helper.setPage(savedPage);
      helper.search();

      mainSections.hide();
      pageNav.hide();
      searchResults.show();
    }
  });

  // Search box widget
  $("#algolia-form input").each(function () {
    search.addWidget(
      instantsearch.widgets.searchBox({
        container: this,
        placeholder: "wefkweflk",
        wrapInput: false,
        autofocus: false
      })
    );
  });

  // Hits widget
  search.addWidget(
    instantsearch.widgets.hits({
      container: "#algolia-hits",
      hitsPerPage: 30,
      transformData: {
        item: function (book) {
          addRelevantMetaAndContent(book);
          return book;
        }
      },
      templates: {
        empty: wp.template("instantsearch-empty"),
        item: wp.template("instantsearch-hit")
      },
      cssClasses: {
        root: ["loop"],
        item: ["lsb_book", "summary"]
      }
    })
  );

  // Pagination widget
  search.addWidget(
    instantsearch.widgets.pagination({
      container: "#algolia-pagination",
      cssClasses: {
        root: "pagination"
      }
    })
  );

  // Start
  search.start();

  $searchInput = $("#algolia-form").each(function () {
    $(this).bind("submit", function (e) {
      e.preventDefault();
      $(this)
        .find("input")
        .blur();
      $(this)
        .find("button")
        .blur();
    });
  });
})(jQuery); // Fully reference jQuery after this point.
