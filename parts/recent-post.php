<?php
  $args = Array(
    'post_type' => 'post',
    'posts_per_page' => 5,
  );
  $wp_query = new WP_Query( $args );
?>
<section>
<h2 class="widgettitle">最近の投稿</h2>
<?php if($wp_query->have_posts()): ?>
<ul class="recent-posts">
<?php while($wp_query->have_posts()): $wp_query->the_post(); ?>
<?php
  $cat = get_the_category();
  $catname = $cat[0]->cat_name;
  $catslug = $cat[0]->slug;
?>
<li>
  <a href="<?php the_permalink(); ?>" class="recent-posts-link"><span class="recent-posts-cat <?php echo $catslug ?>">[<?php echo $catname; ?>]</span><?php the_title(); ?></a>
</li>
<?php endwhile; ?>
</ul>
<?php else: ?>
<p>現在投稿記事はありません。</p>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
</section>
