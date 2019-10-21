<?php get_header(); ?>
<main class="single-main">
  <?php if(have_posts()): while(have_posts()):the_post(); ?>
  <article <?php post_class('blocks'); ?>>
    <?php
      $thumbnail_id = get_post_thumbnail_id();
      if(has_post_thumbnail()){
        $thumbnail_url = get_the_post_thumbnail_url();
      } else {
        $thumbnail_url = get_template_directory_uri().'/default.jpg';
      }
      echo '<div class="single-ttl-bg" style="background-image:url('.esc_url($thumbnail_url).');">';
    ?>
    <h1><?php the_title(); ?></h1>
    <div class="info-list">
      <?php the_category(); ?>
      <div class="info-list-date">
        <time class="p-time" datetime="<?php echo esc_attr(get_the_date(DATE_W3C)); ?>">
          <i class="far fa-clock"></i>
          <?php echo esc_html(get_the_date('Y/m/d')).'公開'; ?>
        </time>
        <?php if(get_the_date() != get_the_modified_date()): ?>
        <time class="p-time" datetime="<?php echo esc_attr(get_the_modified_date(DATE_W3C)); ?>">
          <i class="far fa-clock"></i>
          <?php echo esc_html(get_the_modified_date('Y/m/d')).'更新'; ?>
        </time>
        <?php endif; ?>
      </div>
    </div>
    <?php echo '</div>' ?>
    <div class="single-contents">
      <?php the_content(); ?>
    </div>
  </article>
  <?php endwhile; endif; ?>
  <?php the_post_navigation(); ?>
</main>
<?php get_footer(); ?>
