(function ($) {
  // Snippet from leseweb
  var lwfile = '2mao287pbt3p9dcqbuix.js';
  var lw = document.createElement('script');
  lw.type = 'text/javascript';
  lw.async = true;
  lw.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'speech.leseweb.dk/script/' + lwfile;
  var s = document.getElementsByTagName('script')[0];
  s.parentNode.insertBefore(lw, s);

  // Cutom code
  $playButton = $('.lsb_voice__play').each(function () {
    $(this).bind('click', function (e) {
      vFact_doplay();
      $(this).blur();
    });
  });

  $stopButton = $('.lsb_voice__stop').each(function () {
    $(this).bind('click', function (e) {
      vFact_dostop();
      $(this).blur();
    });
  });

  $settingsButton = $('.lsb_voice__settings').each(function () {
    $(this).bind('click', function (e) {
      vFact_showconfigbox();
      $(this).blur();
    });
  });

  $settingsButton = $('.lsb_voice__help').each(function () {
    $(this).bind('click', function (e) {
      vFact_dohelp();
      $(this).blur();
    });
  });

})(jQuery);