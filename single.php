<?php get_header();?>
<div class="container">
  <div class="row">
    <div class="col-xl-8 col-lg-8">

        <!-- .col-  .col-sm-	.col-md-	.col-lg-	.col-xl--->
        <?php while ( have_posts() ) : the_post(); ?>
          <?php
            // 显示页面内容
            get_template_part( 'template-parts/content', 'single' );
          ?>
          <?php
            // If comments are open or we have at least one comment, load up the comment template
            if ( comments_open() || get_comments_number() ) :
              comments_template();
            endif;
          ?>
        <?php endwhile; // end of the loop. ?>
    </div>
    <div class="col-xl-4 col-lg-4">
      <?php get_sidebar();?>
    </div>
  </div><!-- /.row -->
</div><!-- /.container -->

<?php get_footer();?>
