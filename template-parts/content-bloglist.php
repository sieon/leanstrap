<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package start
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('entry border-b mb-3'); ?>>
	<div class="row">
		<?php if(has_post_thumbnail()) : ?>
		<div class="col-4 col-lg-3 mb-3 pb-1">
			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
				<?php
					// Post thumbnail.
					lean_post_thumbnail();
				?>
			</a>
		</div>
		<div class="col-8 col-lg-9 mb-3 pb-1">
		<?php else : ?>
		<div class="col-12 mb-3 pt-3">
		<?php endif; ?>

			<header class="entry-header mb-3">
				<?php the_title( sprintf( '<h3 class="mb-3"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
			</header>

			<div class="entry-excerpt">
				<?php the_excerpt(); ?>
			</div>

			<footer class="entry-footer pb-2">
				<small>
					<?php lean_entry_meta(); ?>
				</small>
			</footer><!-- .entry-footer -->
		</div>

	</div><!--./row -->
</article><!-- #post-## -->
