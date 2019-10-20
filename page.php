<?php get_header(); ?>
<main class="page-main">
  <?php if(have_posts()): the_post(); ?>
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
    <?php echo '</div>' ?>
    <div class="single-contents">
      <?php the_content(); ?>
    </div>
  </article>
  <?php endif; ?>
</main>
<?php get_footer(); ?>
