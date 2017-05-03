<div class="card" style="border: 0px;">
  <h2 class="card-header mb-4">主编推荐</h2>
  <div class="card-deck">
    <?php
    query_posts( 'posts_per_page=2&post_type=post');
    while ( have_posts() ) : the_post();
    ?>
        <div class="card card-posts" style="border: 0px;">
          <?php
            // Post thumbnail.
            the_post_thumbnail('full', ['class' => 'card-img-top']);
          ?>
          <h2 class="card-title mt-2"><?php the_title(); ?></h2>
          <div class="card-text text-muted entry-excerpt"><?php the_excerpt(); ?></div>
        </div>
    <?php endwhile; wp_reset_postdata(); ?>
  </div>
</div>
