<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package start
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('entry media mb-4 border-b row'); ?>>

	<?php if ( lean_post_thumbnail() ) { ?>
	<div class="col-lg-3">
		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
			<?php
				// Post thumbnail.
				lean_post_thumbnail();
			?>
		</a>
	</div>
	<div class="media-body col-lg-9">
	<?php } else { ?>
		<div class="media-body col-lg-12">
	<?php }?>
		<header class="entry-header">
			<?php the_title( sprintf( '<h3 class="mt-0 mb-2"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>

			<?php if ( 'post' == get_post_type() ) : ?>
			<div class="mb-2">
				<small><?php echo the_time(); ?></small>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header>

		<div class="entry-content">
			<?php the_excerpt(); ?>
		</div>

		<footer class="entry-footer">
			<small class="text-muted"><?php echo get_the_author(); ?>&nbsp;<?php start_entry_footer(); ?></small>
		</footer><!-- .entry-footer -->
	</div>
	<hr>
</article><!-- #post-## -->
