<?php get_header('2'); ?>

<div class="row">
  <div class="col-lg-8">
    <div class="main-content">
      <div class="hidden">
        <?php
        if ( have_posts() ) :
           while ( have_posts() ) : the_post(); ?>

            <?php
            /**
             * 显示内容
             */
            get_template_part( 'template-parts/content', 'bloglist' );
            ?>
        <?php endwhile; ?>
        <?php //lean_bootstrap_page_navi(''); ?>
      </div>
      <div class="more-list">数据加载中，请稍后...</div>
      <div class="load-more text-center"><a href="javascript:;" onClick="lean.loadMore();" class="btn btn-primary">浏览更多</a></div>


    </div>

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
