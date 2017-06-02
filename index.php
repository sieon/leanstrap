<?php get_header(); ?>

<div class="jumbotron page-header mb-3">
  <div class="container">
    <h1 class="page-title">博客</h1>
  </div>
</div>

<div class="container mt-4">
  <div class="row">
    <div class="col-lg-8">
      <?php if ( have_posts() ) :?>
        <ul class="list-unstyled posts-list">
          <?php  while ( have_posts() ) : the_post();
            /* 显示内容 */
            get_template_part( 'template-parts/posts', 'list' );
          endwhile; ?>
        </ul>

        <div class="pagination pt-2 mt-2">
          <?php lean_pagination();?>
        </div>
      <?php else :
        get_template_part( 'template-parts/content', 'none' );
      endif;
      ?>
    </div><!--/.col-8-->

    <?php get_sidebar();?>
  </div><!--/.row-->

</div>
<?php get_footer(); ?>
