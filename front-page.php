<?php
/**
 * Template Name: 首页 3
 */
get_header(); ?>

<?php get_template_part( 'template-parts/content', 'carousel' ); ?>

<div class="container">
  <div id="main-content" class="row main-content">
    <div class="col-lg-8">
      <div class="card-deck sticky-posts mb-3">
        <?php get_template_part( 'template-parts/content', 'sticky' ); ?>
      </div>

      <div class="latest-articles">
        <h3 class="mb-2">最新发表</h3>
        <?php
        //$sticky = get_option( 'sticky_posts' );
        $args = array(
          'posts_per_page' => '10',
          'post_type' => 'post',
          //'caller_get_posts' => 1,
          //'ignore_sticky_posts' =>1,
          'post__not_in' => get_option( 'sticky_posts' )
        );
        query_posts( $args );
        while ( have_posts() ) : the_post();
        /* 显示内容 */
        get_template_part( 'template-parts/posts', 'list' );
        endwhile;wp_reset_postdata();
        ?>
        <div class="read-more pt-3 text-center">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>/blog" class="btn btn-info btn-block">查看更多</a>
        </div>
      </div>
    </div>
      <?php get_sidebar();?>
  </div><!--/.row-->
</div>

<?php get_footer(); ?>
