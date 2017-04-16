<div class="card-group">
    <?php
    query_posts( 'posts_per_page=3&tag=slide');
    if ( have_posts() ) : while ( have_posts() ) : the_post();
    get_template_part( 'template-parts/content', 'overlays' );

     endwhile;
    else :
      get_template_part( 'template-parts/content', 'none' );
    endif;
    // Reset Post Data
    wp_reset_postdata();
    ?>
</div>
