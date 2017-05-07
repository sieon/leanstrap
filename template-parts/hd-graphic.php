<div class="card">
  <div class="widget-header">
    产品推荐
  </div>
  <div class="row">
    <?php wp_reset_query();
    $args = array(
      'posts_per_page' => '4',
      'post_type' => 'post',
      'tag' => 'home-graphic',
      'tag__not_in' => array(178),
      'caller_get_posts' => 1
    );
    query_posts( $args );

    while ( have_posts() ) : the_post();
    ?>
      <div class="col-lg-3 col-6">
        <div class="card">
          <?php the_post_thumbnail('medium', ['class' => 'card-img-top rounded-0']); ?>
          <div class="card-block">
            <?php the_title( sprintf( '<h2 class="card-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
          </div>
        </div>
      </div>
    <?php endwhile; wp_reset_query(); ?>
  </div>
</div>
