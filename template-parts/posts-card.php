<div class="card-group">
<?php
query_posts( 'posts_per_page=3&ignore_sticky_posts=1');
while ( have_posts() ) : the_post(); ?>

  <article id="post-<?php the_ID(); ?>" class="card card-list">
    <a href="<?php the_permalink(); ?>"><img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id()) ?>" class="card-img-top img-fluid"/></a>
  	<div class="card-block">
  		<div class="entry-header">
  			<?php the_title( sprintf( '<h3 class="card-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
  		</div>
    </div>
    <div class="card-footer">
      <small class="text-muted"><?php echo the_time(); ?></small>
    </div>
  </article>

<?php endwhile;
// Reset Post Data
wp_reset_postdata();
?>
</div>
