<?php get_header(); ?>

  <section class="jumbotron text-center">
    <div class="container">
      <h1 class="jumbotron-heading">WordPress Bootstrap4 Theme Framework</h1>
      <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don't simply skip over it entirely.</p>
      <p>
        <a href="#" class="btn btn-primary">Download</a>
        <!-- <a href="#" class="btn btn-secondary">Secondary action</a> -->
      </p>
    </div>
  </section>



  <div class="container p-a" id="site-content">
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
  </div>
  <div class="container">
  <?php lean_bootstrap_page_navi(''); ?>

  <?php else : ?>

    <?php get_template_part( 'template-parts/content', 'none' ); ?>

  <?php endif; ?>
  </div>

<?php get_footer(); ?>
