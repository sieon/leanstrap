<div id="sticky-posts" class="card">
  <div class="card-block">
    <div class="row">
      <?php  wp_reset_query();//wp_reset_postdata();
      $args = array(
        'posts_per_page' => '4',
        'post_type' => 'post',
        'tag' => 'facebook',
        'caller_get_posts' => 1
      );
      query_posts( $args );

      while ( have_posts() ) : the_post();
      ?>
        <div class="col-lg-3 col-6">
          <?php the_post_thumbnail('medium', ['class' => 'card-img-top rounded-0']); ?>
          <?php the_title( sprintf( '<h2 class="card-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
        </div>
      <?php endwhile; wp_reset_query(); ?>
    </div>
  </div>
</div>
