<?php
/**
 * Template Name: Front Page Template
 *
 * Description: A page template that provides a key component of WordPress as a CMS
 * by meeting the need for a carefully crafted introductory page. The front page template
 * in Twenty Twelve consists of a page content area for adding text, images, video --
 * anything you'd like -- followed by front-page-only widgets in one or two columns.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */


get_header('2'); ?>

<div class="row">
  <div class="col-lg-12">
    <?php
    $args = array(
      'post_type' => 'post' ,
      'tag' => 'slide',
      'posts_per_page' => '1'
      //'post__in' => get_option( 'sticky_posts' )
    );
    $myPosts = new WP_Query($args);
    while ( $myPosts->have_posts() ) : $myPosts->the_post();
    ?>
    <section class="jumbotron text-center">
      <?php the_title( '<h1 class="jumbotron-heading">', '</h1>' ); ?>
      <p class="lead text-muted"><?php the_excerpt();?></p>
      <p>
        <a href="#" class="btn btn-primary">下载</a>
        <a href="#" class="btn btn-secondary">了解更多</a>
      </p>
    </section>
    <?php endwhile;
    // Reset Post Data
    wp_reset_postdata();
    ?>
  </div>

  <div class="col-lg-8">
    <?php
    query_posts( 'posts_per_page=10');
    if ( have_posts() ) :
       while ( have_posts() ) : the_post(); ?>

        <?php
        /**
         * 显示内容
         */
        get_template_part( 'template-parts/content', 'bloglist' );
        ?>
    <?php endwhile; ?>
      <?php else : ?>
      <?php get_template_part( 'template-parts/content', 'none' ); ?>
      <?php endif;     // Reset Post Data
        wp_reset_postdata();?>
  </div>

  <div class="col-xl-4 col-lg-4">
    <?php get_sidebar();?>
  </div>
</div><!--/.row-->

<?php get_footer(); ?>
