/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 *
 * Google CDN, Latest jQuery
 * To use the default WordPress version of jQuery, go to lib/config.php and
 * remove or comment out: add_theme_support('jquery-cdn');
 * ======================================================================== */

(function($) {
  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Roots = {
    // All pages
    common: {
      init: function() {
        // JavaScript to be fired on all pages

        function toggleScroll($scrollArea, $leftButton, $rightButton) {
          var scrollLeftPos = $scrollArea.scrollLeft();
          var scrollWidth = $scrollArea.get(0).scrollWidth;
          var width = $scrollArea.width();

          if (scrollLeftPos > 0) {
            $leftButton.show();
          } else {
            $leftButton.hide();
          }

          if (scrollWidth - scrollLeftPos > width) {
            $rightButton.show();
          } else {
            $rightButton.hide();
          }
        }

        function doToggleScroll($scrollArea) {
          toggleScroll(
            $scrollArea,
            $scrollArea.children(".lsb_scroll__button.is-left"),
            $scrollArea.children(".lsb_scroll__button.is-right")
          );
        }

        $(".lsb_scroll__button").click(function() {
          $scrollArea = $(this).parent(".lsb_scroll");
          $scrollStep = Math.min($scrollArea.width() * 0.8, 500);
          $scrollPrefix = $(this).data("scroll") === "left" ? "-=" : "+=";
          $scrollArea.animate(
            {
              scrollLeft: $scrollPrefix + $scrollStep + "px"
            },
            500
          );
        });

        $(window).resize(function() {
          $(".lsb_scroll").each(function() {
            doToggleScroll($(this));
          });
        });

        $(".lsb_scroll").scroll(function() {
          doToggleScroll($(this));
        });

        $(".lsb_scroll").each(function() {
          doToggleScroll($(this));
        });
      }
    },
    // Home page
    home: {
      init: function() {
        // JavaScript to be fired on the home page
      }
    },

    // Books
    single_lsb_book: {
      init: function() {
        // JavaScript to be fired on a book page

        $(".lsb_library select").change(function() {
          var selectedCounty = $(this).val();

          $(".lsb_library table").addClass("hidden");
          $(".lsb_library table").removeClass("show");

          if (selectedCounty) {
            $(".lsb_library table." + selectedCounty).removeClass("hidden");
            $(".lsb_library table." + selectedCounty).addClass("show");
          }
        });
      }
    },

    // About us page, note the change from about-us to about_us.
    about_us: {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var namespace = Roots;
      funcname = funcname === undefined ? "init" : funcname;
      if (
        func !== "" &&
        namespace[func] &&
        typeof namespace[func][funcname] === "function"
      ) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      UTIL.fire("common");

      $.each(document.body.className.replace(/-/g, "_").split(/\s+/), function(
        i,
        classnm
      ) {
        UTIL.fire(classnm);
      });
    }
  };

  $(document).ready(UTIL.loadEvents);
})(jQuery); // Fully reference jQuery after this point.
