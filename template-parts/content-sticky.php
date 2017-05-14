<div class="widget">
  <h2 class="widget-header mb-4">主编推荐</h2>
  <div class="card-deck">
    <?php
    $sticky = get_option( 'sticky_posts' );
    $args = array(
      'posts_per_page' => '4',
      'post_type' => 'post',
      'caller_get_posts' => 1,
      'ignore_sticky_posts' =>1,
      'post__not_in' => $sticky
    );
    query_posts( $args);
    while ( have_posts() ) : the_post();
    ?>
        <div class="card">
          <?php
            // Post thumbnail.
            the_post_thumbnail('full', ['class' => 'card-img-top rounded-0']);
          ?>
          <h2 class="card-title mt-2"><?php the_title(); ?></h2>
          <div class="card-text text-muted entry-excerpt"><?php the_excerpt(); ?></div>
        </div>
    <?php endwhile; wp_reset_postdata(); ?>
  </div>
</div>
