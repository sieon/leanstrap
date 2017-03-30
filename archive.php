<?php get_header('2'); ?>


<div class="row">
  <div class="col-lg-8">
    <?php if ( have_posts() ) : ?>
    <?php
    lean_the_archive_title( '<h1 class="card-title">', '</h1>' );
    lean_the_archive_description( '<p class="card-subtitle">', '</p>' );
    ?>
    <?php while ( have_posts() ) : the_post(); ?>
        <?php
        /**
         * 显示内容
         */
        get_template_part( 'template-parts/content', 'bloglist' );
        ?>
    <?php endwhile; ?>
    <?php lean_bootstrap_page_navi(''); ?>
    <?php else : ?>
    <?php get_template_part( 'template-parts/content', 'none' ); ?>
    <?php endif;
    // Reset Post Data
    wp_reset_postdata(); ?>
  </div>

  <div class="col-xl-4 col-lg-4">
    <?php get_sidebar();?>
  </div>


</div>

<?php get_footer(); ?>
