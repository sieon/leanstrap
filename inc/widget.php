<?php
/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */

/**
 * Remove Default Widgets
 */
function unregister_widgets() {
  unregister_widget( 'WP_Widget_RSS' );
  unregister_widget( 'WP_Widget_Pages' );
  //unregister_widget( 'WP_Widget_Search' );
  unregister_widget( 'WP_Widget_Recent_Comments' );
  unregister_widget( 'WP_Nav_Menu_Widget' );
}

add_action( 'widgets_init', 'unregister_widgets' );

function lean_widgets_init() {
  register_sidebar( array(
  	'name'          => esc_html__( '边栏', 'lean' ),
  	'id'            => 'sidebar-1',
  	'description'   => '这是默认的边栏。',
  	'before_widget' => '<aside id="%1$s" class="card %2$s">',
  	'after_widget'  => '</div></aside>',
  	'before_title'  => '<h3 class="card-header-2">',
  	'after_title'   => '</h3><div class="card-block">',
  ) );
  register_sidebar( array(
    'name'          => esc_html__( '首页区块1', 'lean' ),
    'id'            => 'home-block-1',
    'description'   => '没有子card。',
    'before_widget' => '<div id="%1$s" class="card %2$s">',
    'after_widget'  => '</div></div>',
    'before_title'  => '<h3 class="card-header">',
  	'after_title'   => '</h3><div class="card-block">',
  ) );
  register_sidebar( array(
    'name'          => esc_html__( '首页区块2', 'lean' ),
    'id'            => 'home-block-2',
    'description'   => '没有子card',
    'before_widget' => '<div id="%1$s" class="card %2$s">',
    'after_widget'  => '</div></div>',
    'before_title'  => '<h3 class="card-header">',
  	'after_title'   => '</h3><div class="card-block">',
  ) );
  register_sidebar( array(
  	'name'          => esc_html__( '底部 1', 'lean' ),
  	'id'            => 'footer-1',
  	'description'   => '这个地方是一定要放菜单。',
  	'before_widget' => '',
  	'after_widget'  => '',
  	'before_title'  => '',
  	'after_title'   => '',
  ) );
  register_sidebar( array(
    'name'          => esc_html__( '顶部广告', 'lean' ),
    'id'            => 'home-ad-1',
    'description'   => '这是顶部的长条广告。',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="card-header widget-header">',
    'after_title'   => '</h3>',
  ) );
  register_sidebar( array(
    'name'          => esc_html__( '右侧产品', 'lean' ),
    'id'            => 'home-ad-2',
    'description'   => '',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h3 class="card-header widget-header">',
    'after_title'   => '</h3>',
  ) );
  register_sidebar( array(
    'name'          => esc_html__( '三个广告', 'lean' ),
    'id'            => 'home-ad-3',
    'description'   => '',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h3 class="widget-header">',
    'after_title'   => '</h3>',
  ) );
}
add_action( 'widgets_init', 'lean_widgets_init' );
