<?php
/**
 * Template Name: Full Width Page Template
 *
 * @package leanstrap
 * @since leanstrap 0.5
 */
get_header(); ?>

<div class="container p-a" id="site-content">
  <?php if ( have_posts() ) : // Start the Loop ?>
    <?php while ( have_posts() ) : the_post(); ?>
      <?php
        // 显示页面内容
        get_template_part( 'template-parts/content', 'page' );
      ?>
      <hr>
      <?php
        // If comments are open or we have at least one comment, load up the comment template
      //  if ( comments_open() || get_comments_number() ) :
          comments_template();
      //  endif;
      ?>
    <?php endwhile; ?>  <?php endif; ?>
</div><!--./container -->

<?php get_footer(); ?>
