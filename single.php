<?php get_header();?>


<?php while ( have_posts() ) : the_post(); ?>

  <div class="bw" id="content site-content">
    <div class="container">
      <div class="by">
        <?php the_title( '<h1 class="p-a">', '</h1>' ); ?>
        <!-- <p><?php //lean_posted_on(); ?></p> -->
      </div>
    </div>
  </div>

<div class="container">
  <div class="row">
    <div class="col-lg-8">
      
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
    <div class="col-lg-4">
      <?php get_sidebar();?>
    </div>
  </div>


</div>
<?php get_footer();?>
