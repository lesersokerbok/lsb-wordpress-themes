(function ($) {

  if (typeof (ga) !== typeof (Function)) {
    return;
  }

  // Track Voice play
  $('.lsb_voice__play').each(function () {
    $(this).bind('click', function (e) {
      ga('send', 'event', 'Voice', 'play');
    });
  });

  $('.lsb_voice__stop').each(function () {
    $(this).bind('click', function (e) {
      ga('stop', 'event', 'Voice', 'stop');
    });
  });

  $('.lsb_voice__settings').each(function () {
    $(this).bind('click', function (e) {
      ga('stop', 'event', 'Voice', 'settings');
    });
  });

  $('.lsb_voice__help').each(function () {
    $(this).bind('click', function (e) {
      ga('stop', 'event', 'Voice', 'help');
    });
  });

})(jQuery);