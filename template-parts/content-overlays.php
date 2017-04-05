<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package start
 */
?>
<article id="post-<?php the_ID(); ?>"  class="card">

  <img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id()) ?>" class="card-img-top img-fluid"/>
  <!--
	<div class="card-block">
		<div class="entry-header">
			<?php the_title( sprintf( '<h3 class="card-title mb-1"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
			<small class="text-muted"><?php echo the_time(); ?></small>
		</div>
	</div>-->
</article>
