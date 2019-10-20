<div>
  <button class="open-btn" aria-expanded="false" aria-controls="drawer" type="button">
  <span class="open-btn__line"></span>
  <span class="open-btn__line"></span>
  <span class="open-btn__line"></span>
</button>
<div class="drawer" aria-expanded="false">
  <div class="drawer__overlay"></div>
  <nav class="drawer__nav">
    <button class="close-btn" aria-expanded="false" aria-controls="drawer" type="button">
      <span class="close-btn__line"></span>
      <span class="close-btn__line"></span>
    </button>
    <?php if(is_active_sidebar('footer-nav')): ?>
    <aside class="footer-nav">
      <?php get_template_part('parts/recent-post') ?>
      <?php dynamic_sidebar('footer-nav'); ?>
    </aside>
    <?php endif ?>
  </nav>
</div>
</div>
