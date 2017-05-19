
  <?php
  $sticky = get_option( 'sticky_posts' );
  $args = array(
    'posts_per_page' => '2',
    'post_type' => 'post',
    'caller_get_posts' => 1,
    'ignore_sticky_posts' =>1,
    'post__not_in' => $sticky
  );
  query_posts( $args);
  while ( have_posts() ) : the_post();
  ?>
  <!-- <div class="col-md-6"> -->
    <div class="card">
      <!-- <a href="<?php //the_permalink(); ?>"> -->
        <?php
          // Post thumbnail.
          the_post_thumbnail('medium', ['class' => 'card-img']);
        ?>
        <div class="card-block">
          <?php
          echo '<div class="posts-categories mb-2">';
  				foreach((get_the_category()) as $category) {
  					echo  '<span class="badge badge-warning">'.$category->cat_name.'</span>&nbsp;';
  				}
  				echo "</div>"; ?>
  		    <?php the_title( sprintf( '<p class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></p>' ); ?>
          <?php //echo '<p class="card-text entry-excerpt">'.wp_trim_words( get_the_excerpt(), 50, '...' ).'</p>';?>
          <p class="card-text entry-footer"><small><?php the_time('j M, Y'); ?></small></p>
        </div>
      <!-- </a> -->
    </div>
  <!-- </div> -->
  <?php endwhile; wp_reset_postdata(); ?>
