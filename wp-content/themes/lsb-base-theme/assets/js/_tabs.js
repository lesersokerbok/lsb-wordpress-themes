(function($) {
  $(".lsb_tabs__nav-item").click(function() {
    var id = $(this).data("id");
    $container = $(this).closest(".lsb_tabs");

    $container.find(":not([data-id='" + id + "'])").removeClass("is-active");
    $container.find("[data-id='" + id + "']").toggleClass("is-active");
  });
})(jQuery); // Fully reference jQuery after this point.
