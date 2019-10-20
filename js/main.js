document.addEventListener('DOMContentLoaded', function () {
  (function ($) {
    //smooth scroll
    $(function () {
      $('a[href^="#"]').click(function () {
        var speed = 400;
        var href = $(this).attr("href");
        var target = $(href == "#" || href == "" ? 'html' : href);
        var position = target.offset().top;
        $('body,html').animate({ scrollTop: position }, speed, 'swing');
        history.pushState(null, null, href);
        return false;
      });
    });

    //IEからアクセスしてきたら通知を出す
    var userAgent = window.navigator.userAgent.toLowerCase();
    if (userAgent.indexOf('msie') != -1 ||
      userAgent.indexOf('trident') != -1) {
      alert('このウェブサイトはInternet Explorerに対応しておりません。対応までしばらくお待ちください。')
    }
  })(jQuery);

});
