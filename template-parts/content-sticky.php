<?php
query_posts( 'posts_per_page=2&post_type=carousel');
while ( have_posts() ) : the_post();
?>
<div class="col-6 mb-3">
  <div class="card">
  <?php
    // Post thumbnail.
    the_post_thumbnail('full', ['class' => 'card-img-top']);
  ?>
  <div class="card-block">
    <h2 class="card-title"><?php the_title(); ?></h2>
    <div class="card-text"><?php the_excerpt(); ?></div>
  </div>
  </div>
</div>
<?php endwhile;wp_reset_postdata(); ?>
