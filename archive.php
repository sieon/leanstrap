<?php get_header(); ?>


  <div class="container p-a" id="site-content">

    <?php if ( have_posts() ) : ?>

    <div class="card-columns">

      <div class="card bg-faded">
        <div class="card-block">
          <?php
            lean_the_archive_title( '<h1 class="card-title">', '</h1>' );
            lean_the_archive_description( '<p class="card-subtitle">', '</p>' );
          ?>
        </div>
      </div><!-- .page-header -->

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
