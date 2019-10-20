<?php if (comments_open()) { ?>
  <div class="comments">
    <p>誤字・脱字・他にもっと良いコードの書き方がある・間違った内容のものがあるなど、何かお気づきの点がありましたら、お気軽にコメントください。</p>
    <?php if(have_comments()){ ?>
    <ol class="comments-list">
      <?php wp_list_comments(); ?>
    </ol>
    <?php } ?>
    <?php comment_form(); ?>
  </div>
<?php } ?>
