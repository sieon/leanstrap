<?php get_header();?>

  <div class="container">
    <div class="row">
      <div class="col-xl-8 col-lg-8">
  <!-- .col-  .col-sm-	.col-md-	.col-lg-	.col-xl--->

        <?php while ( have_posts() ) : the_post(); ?>

        <div class="page-header pb-2">
          <?php the_title( '<h1 class="mb-2">', '</h1>' ); ?>
          <p class="text-muted"><?php echo the_time(); ?></p>
        </div>


        <?php
    			// Post thumbnail.
    			lean_post_thumbnail();
    		?>
        <?php the_content(); ?>
        <hr>
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
