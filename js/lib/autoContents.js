(function ($) {
  $(window).on('load', function () {
    //目次自動生成
    var $headlines = $('.blocks h2');//目次にしたいh2
    var $subHeadlines = $('.blocks h3');//目次にしたいh3
    var $contentsPosition = $('.single-ttl-bg');//この要素の下に目次を挿入する
    var headlinesLength = $headlines.length;
    var subHeadlinesLength = $subHeadlines.length;
    var subHeadCount = 0;

    initContents();

    function initContents() {
      createContents();
      setAnchors();
    }

    //目次のDOM生成
    function createContents() {
      var contentsList = $('<div class="contents-list">');
      var title = $('<h3>', { text: '目次' });
      var frag = $(document.createDocumentFragment());
      var list = $('<ul>');
      for (var i = 0; i < headlinesLength; i++) {
        var text = $headlines[i].textContent;
        var listItem = $('<li></li>');
        var anchor = $('<a></a>', {
          href: '#a' + i,
          text: text
        });
        listItem.append(anchor);
        var h3 = $headlines.eq(i).nextUntil('h2', 'h3');
        if (h3.length) {
          var subFrag = $(document.createDocumentFragment());
          var subList = $('<ul>');
          for (var j = 0; j < h3.length; j++) {
            var subListItem = $('<li></li>');
            var subText = h3.get(j).textContent;
            var subAnchor = $('<a></a>', {
              href: '#a_' + subHeadCount,
              text: subText
            });
            subListItem.append(subAnchor);
            subFrag.append(subListItem);
            subHeadCount++;
          }
          subList.append(subFrag);
          listItem.append(subList);
        }
        frag.append(listItem);
      }
      list.append(frag);
      contentsList.append(title).append(list);
      $contentsPosition.after(contentsList);
      $('.contents-list').on('click', 'a[href^="#"]', function () {
        var speed = 400;
        var href = $(this).attr("href");
        var target = $(href == "#" || href == "" ? 'html' : href);
        var position = target.offset().top;
        $('body,html').animate({ scrollTop: position }, speed, 'swing');
        history.pushState(null, null, href);
        return false;
      });
    }

    //目次にしたタイトルにアンカーをつける
    function setAnchors() {
      $headlines.each(function (i) {
        this.id = 'a' + i;
      });
      $subHeadlines.each(function (i) {
        this.id = 'a_' + i;
      });
    }
  });
})(jQuery);
