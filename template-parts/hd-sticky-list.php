<div id="sticky-posts" class="card">
  <div class="card-block">
    <ul>
      <?php  wp_reset_query();//wp_reset_postdata();.
      $args = array(
        'posts_per_page' => '1',
        'post_type' => 'post',
        'post__in' => get_option( 'sticky_posts' ),
        'caller_get_posts' => 1
      );
      query_posts( $args );
      while ( have_posts() ) : the_post();
      ?>
      <li class="feature-posts">
        <?php the_title( sprintf( '<h2><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
      </li>
    <?php endwhile; wp_reset_query(); ?>
      <?php
      $args = array(
        'posts_per_page' => '7' ,
        'post_type' => 'post',
        'post__in' => get_option( 'sticky_posts' ),
        'offset' => '1',
        'caller_get_posts' => 1
      );
      query_posts( $args );
      while ( have_posts() ) : the_post();
      ?>
      <li>
        <span>
          <?php $categories = get_the_category();
          if ( ! empty( $categories ) ) {
            echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '&nbsp;|&nbsp;</a>';
          } ?>
        </span>
        <?php the_title( sprintf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a>' ); ?>
      </li>
      <?php endwhile; wp_reset_query(); ?>
    </ul>
  </div>
</div>
