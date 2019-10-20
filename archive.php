<?php get_header(); ?>
<main class="postlist main">
  <h1><?php the_archive_title(); ?></h1>
  <?php
    if (have_posts()) : while (have_posts()) : the_post();
    $cat = get_the_category();
    $cat_name = $cat[0]->cat_name;
  ?>
  <article class="post-card">
    <a href="<?php the_permalink(); ?>">
      <?php if (has_post_thumbnail()) : ?>
        <figure class="ofi">
          <?php the_post_thumbnail(); ?>
        </figure>
      <?php else : ?>
        <figure class="ofi">
          <img src="<?php echo esc_url(get_template_directory_uri()); ?>/default.jpg" alt="">
        </figure>
      <?php endif; ?>
      <div class="post-card-txt">
        <div class="inner">
          <h2 data-mh="groupA"><?php the_title(); ?></h2>
          <?php the_excerpt(); ?>
        </div>
      </div>
      <div class="post-card-info">
        <p class="post-card-cat"><?php echo esc_html($cat_name); ?></p>
        <time class="post-card-mod-date" datetime="<?php echo esc_attr(get_the_modified_date(DATE_W3C)); ?>">
          <i class="far fa-clock"></i><?php echo '最終更新日'.esc_html(get_the_modified_date('Y/m/d')); ?>
      </time>
      </div>
    </a>
  </article>
  <?php endwhile; endif; ?>  <?php the_posts_pagination(array(
  'prev_text' => '<i class="fas fa-angle-left"></i><span class="screen-reader-text">前へ</span>',
  'next_text' => '<span class="screen-reader-text">次へ</span><i class="fas fa-angle-right"></i>',
  )); ?>
</main>
<?php get_footer(); ?>
