<?php
/*
Template Name: 首页模板 */

get_header('2');
?>

<div class="row">
  <div class="col-xl-8 col-lg-8">
    <div class="row">
      <div class="col-lg-12">
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
        <?php
        $mySlidePosts = new WP_Query( 'posts_per_page=3&tag=slide' );
        if ( have_posts() ) :
          while ( have_posts() ) :
            $mySlidePosts->the_post();?>
            <div class="carousel-item">
              <?php lean_post_thumbnail(); ?>
            </div>

        <?php
          endwhile;
        endif;wp_reset_postdata();?>
          </div>
        </div>
      </div>

      <div class="col-lg-12">
        <?php

        $args = array(
          'posts_per_page' => '10',
          'post_type' => 'post',
          'tag__not_in' => 'slide'
        );
        $myListPosts = new WP_Query( $args );
        if ( have_posts() ) :
          while ( have_posts() ) :
            $myListPosts->the_post();?>

              <?php lean_post_thumbnail();the_title();the_content(); ?>

        <?php
          endwhile;
        endif;
        wp_reset_postdata();
        ?>
      </div>

    </div>
  </div>

  <div class="col-xl-4 col-lg-4">
    <?php get_sidebar();?>
  </div>
</div>

<?php get_footer();?>
