<?php
/**
 * Template Name: Front Page Template
 */
 add_action('wp_enqueue_scripts', 'flexslider_js_css');
 function flexslider_js_css(){
     wp_enqueue_script('flexslider', get_template_directory_uri() . '/assets/js/flexslider-min.js', array('jquery'), '20130129', true );
     wp_enqueue_style('flexslider', get_template_directory_uri() . '/assets/css/flexslider.css');
 }
 add_action('wp_footer', 'init_flexslider');
 function init_flexslider(){
     ?>
     <script type="text/javascript">
         jQuery(document).ready(function(){
             jQuery('.flexslider').flexslider({
               controlNav: false,
             });
         });
     </script>
     <?php
 }

get_header(); ?>
<div class="container">

  <div class="row">
    <div class="col-md-8">
      <div class="flexslider mb-3">
        <ul class="slides">
          <?php
          $args = array(
            'posts_per_page' => '10',
            'post_type' => 'slides',
            'caller_get_posts' => 1,
            'ignore_sticky_posts' =>1,
            'tax_query' => array(
              array(
                'taxonomy'=> 'slides-category',
                'field' => 'slug',
                'terms'=>'home-main-slides-2'
              )
            )
          );
          query_posts( $args );
          while ( have_posts() ) : the_post(); ?>
          <li>
            <img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id(get_the_ID())); ?>" />
            <p class="flex-caption"><?php the_title( sprintf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a>' ); ?></p>
          </li>
          <?php endwhile; wp_reset_postdata(); ?>
        </ul>
      </div>

      <div class="card-deck sticky-posts mb-3">
        <?php get_template_part( 'template-parts/content', 'sticky' ); ?>
      </div>

      <div class="latest-articles">
        <h3 class="mb-2">最新发表</h3>
        <?php
        $sticky = get_option( 'sticky_posts' );
        $args = array(
          'posts_per_page' => '10',
          'post_type' => 'post',
          'caller_get_posts' => 1,
          'ignore_sticky_posts' =>1,
          'post__not_in' => $sticky
        );
        query_posts( $args );
        while ( have_posts() ) : the_post();
        /* 显示内容 */
        get_template_part( 'template-parts/posts', 'list' );
        endwhile;wp_reset_postdata();
        ?>
        <div class="read-more pt-3 text-center">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>/blog" class="btn btn-info btn-lg btn-block">查看更多</a>
        </div>
      </div>
    </div>
      <?php get_sidebar();?>
  </div><!--/.row-->
</div>

<?php get_footer(); ?>
