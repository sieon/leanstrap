<?php
/**
 * Template Name: 播放器评测
 */
get_header(); ?>

<div class="container mt-3" id="site-content">
  <div class="row">
    <div class="col-lg-8">
      <div class="jumbotron page-header">
        <h1 class="page-title"><?php the_title(); ?></h1>
      </div>
      <?php
      $args = array(
        'posts_per_page' => '10',
        'post_type' => 'post',
        'caller_get_posts' => 1,
        'ignore_sticky_posts' =>1,
        'cat'=> 5,
        'tag'=>'bofangqi'
        //'tag__not_in' => array(179,178),
        //'post__not_in' => $sticky
      );
      query_posts( $args );
      while ( have_posts() ) : the_post();
      /* 显示内容 */
        get_template_part( 'template-parts/posts', 'list' );
      endwhile;wp_reset_postdata();
      ?>
    </div>
    <div class="col-lg-4 hidden-sm-down">
      <?php get_sidebar();?>
    </div>
  </div>
</div><!--./container -->

<?php get_footer(); ?>
