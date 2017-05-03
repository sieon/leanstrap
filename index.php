<?php get_header(); ?>
<div class="container mt-3">
    <?php if ( !dynamic_sidebar('home-ad-1') ) { _e('','lean'); } //广告 ?>
</div>
<div class="jumbotron jumbotron-fluid mt-3">
    <div class="container">
      <h1 class="header-title">博客</h1>
    </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-lg-8">
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
