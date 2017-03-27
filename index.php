<?php get_header('2'); ?>

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

  <div class="col-lg-12">
    <div class="card-columns">
      <?php if ( have_posts() ) : ?>

    		<?php /* Start the Loop */ ?>
    		<?php while ( have_posts() ) : the_post(); ?>

    			<?php
    				/* Include the Post-Format-specific template for the content.
    				 * If you want to override this in a child theme, then include a file
    				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
    				 */
    				get_template_part( 'template-parts/content', get_post_format() );
    			?>
        <?php endwhile; ?>
    </div>
  </div><!--／正文 -->
  <div class="col-lg-12">
  <?php lean_bootstrap_page_navi(''); ?>

  <?php else : ?>

  <?php get_template_part( 'template-parts/content', 'none' ); ?>

  <?php endif;     // Reset Post Data
    wp_reset_postdata();?>
  </div>
</div><!--/.row-->

<?php get_footer(); ?>
