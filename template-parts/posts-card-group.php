<div class="card-group">
  <?php
  query_posts( 'posts_per_page=3');
  while ( have_posts() ) : the_post(); ?>
    <a href="<?php the_permalink();?>">
  <article id="post-<?php the_ID(); ?>" class="card card-inverse">

      <img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id()) ?>" class="card-img"/>
    	<div class="card-img-overlay">
    		<div class="entry-header">
    			<?php the_title( sprintf( '<h3 class="card-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
    			<p class="card-text"><small class="text-muted"><?php echo the_time(); ?></small></p>
    		</div>
    	</div>

  </article>
</a>
  <?php endwhile;
  // Reset Post Data
  wp_reset_postdata();
  ?>
</div>
