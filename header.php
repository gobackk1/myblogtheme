<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script>
    //fontLoader
    window.WebFontConfig = {
      google: { families: ['Noto+Sans+JP:400,700'] },
      active: function () {
        sessionStorage.fonts = true;
      }
    };
    (function () {
      var wf = document.createElement('script');
      wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
      wf.type = 'text/javascript';
      wf.async = 'true';
      var s = document.getElementsByTagName('script')[0];
      s.parentNode.insertBefore(wf, s);
    })();
  </script>
  <noscript>
    <style>
      body{opacity: 1!important;}
    </style>
  </noscript>
  <?php wp_head(); ?>
  <link rel="icon" href="<?php echo esc_url(get_template_directory_uri()); ?>/favicon.ico">
  <link rel="apple-touch-icon" sizes="128x128" href="<?php echo esc_url(get_template_directory_uri()); ?>/apple-touch-icon.png">
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>
  <header class="header">
    <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
  </header>
  <?php
  if (has_nav_menu('drawer')) {
    $args = array(
      'container_class'     =>  'drawer',
      'theme_location' => 'drawer',
      'container'      => 'nav',
      'items_wrap'     => '<ul>%3$s</ul>'
    );
    wp_nav_menu($args);
  };
  ?>
  <?php if (has_nav_menu('primary')) : ?>
  <nav class="nav">
    <?php wp_nav_menu(array(
        'theme_location' => 'primary',
      )); ?>
  </nav>
  <?php endif ?>
