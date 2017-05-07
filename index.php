<?php get_header(); ?>
<div class="container mt-3">
    <?php if ( !dynamic_sidebar('home-ad-1') ) { _e('','lean'); } //广告 ?>
</div>

<div class="container mt-3">
  <div class="row">
    <div class="col-lg-8">
      <div class="jumbotron page-header">
        <h1 class="page-title">博客</h1>
      </div>
        <?php if ( have_posts() ) :?>
        <?php  while ( have_posts() ) : the_post();
          /* 显示内容 */
          get_template_part( 'template-parts/posts', 'list' );
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
