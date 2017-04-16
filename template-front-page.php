<?php
/**
 * Template Name: Front Page Template
 */
get_header(); ?>

<div class="container">
  <div class="row">
    <div class="col-lg-8">
      <div class="row">
        <div class="col-12 mb-2">
          <?php get_template_part( 'template-parts/content', 'carousel' ); ?>
        </div>

        <div class="col-12">
          <?php
          query_posts( 'posts_per_page=10');
          if ( have_posts() ) : while ( have_posts() ) : the_post();
          // 显示内容
          get_template_part( 'template-parts/content', 'list-2' );?>

          <?php
            endwhile;
          else :
            get_template_part( 'template-parts/content', 'none' );
          endif;
          // Reset Post Data
          wp_reset_postdata();
          ?>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <?php get_sidebar();?>
    </div>
  </div><!--/.row-->
</div>

<?php get_footer(); ?>
