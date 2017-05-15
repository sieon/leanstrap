<div class="row sticky-posts">
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
  <div class="col-md-6">
    <div class="card card-inverse">
      <?php
        // Post thumbnail.
        the_post_thumbnail('medium', ['class' => 'card-img']);
      ?>
      <div class="card-img-overlay">
        <h4 class="card-title"><?php the_title(); ?></h4>
      </div>
    </div>
  </div>
  <?php endwhile; wp_reset_postdata(); ?>
</div>
