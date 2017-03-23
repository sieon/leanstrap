<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package start
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('media clearfix'); ?>>
	<div class="media-body">
		<?php the_title( sprintf( '<h3 class="mt-0 mb-2"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="mb-2">
			<small><?php echo the_time(); ?></small>
		</div><!-- .entry-meta -->
		<?php endif; ?>

		<?php the_excerpt(); ?>

		<footer class="entry-footer">
			<small class="text-muted"><?php echo get_the_author(); ?>&nbsp;<?php start_entry_footer(); ?></small>
		</footer><!-- .entry-footer -->
	</div>
	<hr>
</article><!-- #post-## -->
