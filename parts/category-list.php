<section>
  <h2 class="widgettitle">カテゴリー</h2>
  <ul class="category-list">
    <?php
      $args = array(
        'orderby' => 'name'
      );
      $categories = get_categories($args);
      foreach($categories as $category){
        $cat_link = get_category_link($category -> cat_ID);
        echo '<li class="category-item"><a href="'.$cat_link.'">'.$category->name.'<span class="cat-count">['.$category->count.']</span></a></li>';
      }
    ?>
    <?php wp_reset_postdata(); ?>
  </ul>
</section>