<?php

function mytheme_setup()
{
  add_theme_support('post-thumbnails');
  add_theme_support('editor-styles');
  add_editor_style('editor-style.css');
  add_theme_support('title-tag');
  add_theme_support('wp-block-styles'); //グーテンベルグ由来のCSS
  add_theme_support('responsive-embeds'); //埋め込みコンテンツのレスポンシブ化
  add_theme_support( 'automatic-feed-links' );//RSSfeed
  add_theme_support('editor-font-sizes', array(
    array(
      'name' => '小',
      'size' => '12.8',
      'slug' => 'small',
    ),
    array(
      'name' => '中',
      'size' => '16',
      'slug' => 'medium',
    ),
    array(
      'name' => '大',
      'size' => '20',
      'slug' => 'large',
    ),
  ));
  register_nav_menus(array(
    'primary' => 'メイン',
    'drawer' => 'ドロワー',
    'sidebar' => 'サイドバー',
  ));
}
add_action('after_setup_theme', 'mytheme_setup');

//ウィジェット
function mytheme_widgets()
{
  register_sidebar(array(
    'id' => 'footer-nav',
    'name' => 'フッターナビ',
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget' => '</section>',
  ));
}
add_action('widgets_init', 'mytheme_widgets');

//scriptタグからtext属性を外す
if(!is_admin()){
  function replace_script_tag ( $tag ) {
    if (
      strpos( $tag, 'matchHeight.js' ) ||
      strpos( $tag, 'jquery-3.4.1.min.js' ) ||
      strpos( $tag, 'autoContents.js' ) ||
      strpos( $tag, 'main.js')
      ) {
      return str_replace( "type='text/javascript'", 'defer', $tag );
    }
    return str_replace( "type='text/javascript'", '', $tag );
  }
  add_filter( 'script_loader_tag', 'replace_script_tag' );
}

function mytheme_enqueue()
{
  wp_enqueue_style('mytheme-style', get_stylesheet_uri(), array(), date('U'));
  if(is_home()){
    wp_enqueue_script('matchHeight-js',get_template_directory_uri().'/js/lib/jquery.matchHeight.js',array('jquery'),null,false);
  }
  if(is_single()){
    wp_enqueue_script('autoContents-js',get_template_directory_uri().'/js/lib/autoContents.js',array('jquery'),null,false);
  }
  wp_enqueue_script('font-awesome','https://kit.fontawesome.com/b63bbc266c.js',array(),null,false);
  wp_enqueue_script('main-js',get_template_directory_uri().'/js/main.js',array('jquery'),null,false);
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue');

//jQueryをCDNから読みこむ
add_action( 'init', function() {
  if ( is_admin() ) {
    return;
  }
  $jquery_ver = null;
  $jquery_src = 'https://code.jquery.com/jquery-3.4.1.min.js';//replace_script_tagも書き換える
  wp_deregister_script( 'jquery' );
  wp_deregister_script( 'jquery-core' );
  wp_register_script( 'jquery', false, ['jquery-core'], $jquery_ver, true );
  wp_register_script( 'jquery-core', $jquery_src, [], $jquery_ver, false );
} );

//プラグインCSSをフッターで読み込む
function my_dequeue_plugin_files(){
  wp_dequeue_style('wp-block-library-theme');
}
add_action( 'wp_enqueue_scripts', 'my_dequeue_plugin_files', 9999);
add_action('wp_head', 'my_dequeue_plugin_files', 9999);

function my_enqueue_plugin_files(){
  wp_enqueue_style('wp-block-library-theme');
}
add_action('wp_footer', 'my_enqueue_plugin_files');

//CSSをフッターで読み込む
// function register_stylesheet() {
// 	wp_register_style('google-fonts', 'https://fonts.googleapis.com/css?family=Noto+Sans+JP:300,400,700&display=swap');
// }

// function prefix_add_footer_styles() {
//   wp_enqueue_style('mytheme-style', get_stylesheet_uri(), array('google-fonts'), date('U'));
// };
// add_action( 'wp_footer', 'prefix_add_footer_styles' );

//グーテンベルグ由来のCSSをHOMEでは読みこまない
function remove_both_css(){
  if(is_home()){
    wp_deregister_style('wp-block-library');
    wp_register_style('wp-block-library','');
  }
}
add_action('enqueue_block_assets','remove_both_css');

//body_class()にクラスを追加する
// function my_class_names($classes) {
//     $classes[] = 'scrollbarFix';
//     return $classes;
// }
// add_filter('body_class','my_class_names');

//概要（抜粋）の文字数調整
 function my_excerpt_length($length) {
  return 230;
 }
 add_filter('excerpt_length', 'my_excerpt_length', 999);

 //概要（抜粋）の省略文字
 function my_excerpt_more($more) {
  return '[...ReadMore]';
 }
 add_filter('excerpt_more', 'my_excerpt_more');

// ショートコードをウィジェットで有効に
add_filter('widget_text', 'do_shortcode' );

//imgタグのsrcset無効化
add_filter( 'wp_calculate_image_srcset', '__return_false' );

//画像の余計な要素を削除
add_filter( 'image_send_to_editor', 'remove_image_attribute', 10 );
add_filter( 'post_thumbnail_html', 'remove_image_attribute', 10 );
//remove width,height,title,class
function remove_image_attribute( $html ){
	$html = preg_replace( '/(width|height)="\d*"\s/', '', $html );
	$html = preg_replace( '/class=[\'"]([^\'"]+)[\'"]/i', '', $html );
	$html = preg_replace( '/title=[\'"]([^\'"]+)[\'"]/i', '', $html );
	return $html;
}

//絵文字を使わないなら
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
//ブログ投稿ツールを使わないなら
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
//WordPressのバージョンの表示をしないなら
remove_action('wp_head', 'wp_generator');
//ページ間の関係を示すrel=”prev”とrel=”next”を表示しないなら
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
//短縮URLの表示をしないなら
remove_action('wp_head', 'wp_shortlink_wp_head');
