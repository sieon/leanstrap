<?php get_header(); ?>

<div class="container" id="site-content">
  <div class="row">
    <div class="col-lg-8">
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
    </div>
    <div class="col-lg-4">
      <?php get_sidebar();?>
    </div>
  </div>
</div><!--./container -->

<?php get_footer(); ?>
