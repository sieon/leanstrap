<?php get_header(); ?>

<div class="container">
  <div class="row">
    <div class="col-lg-8">
      <?php
      if ( have_posts() ) :
        while ( have_posts() ) : the_post();
        /* 显示内容 */
        get_template_part( 'template-parts/content', 'bloglist' );
      endwhile; ?>
        <div class="pagination pt-2 mt-2">
          <?php lean_pagination();?>
        </div>
      <?php else :
        get_template_part( 'template-parts/content', 'none' );
      endif;
      ?>
    </div><!--/.col-8-->

    <div class="col-lg-4">
      <?php get_sidebar();?>
    </div>
  </div><!--/.row-->

</div>
<?php get_footer(); ?>
