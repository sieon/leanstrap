<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1><?php the_title(); ?></h1>
    </div>
</div>

<div class="container" id="site-content">
  <div class="row">
    <div class="col-lg-8">
      <div class="entry-content">
        <?php the_content(); ?>
      </div>
        <hr>
        <?php
          // If comments are open or we have at least one comment, load up the comment template
        //  if ( comments_open() || get_comments_number() ) :
            comments_template();
        //  endif;
        ?>
      <?php endwhile;else: ?>
        <div class="page-header">
            <h1>Oh no!</h1>
        </div>

        <p>No content is appearing for this page!</p>
        <?php endif; ?>
    </div>
    <div class="col-lg-4">
      <?php get_sidebar();?>
    </div>
  </div>
</div><!--./container -->

<?php get_footer(); ?>
