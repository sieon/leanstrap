<?php
/**
 * 文章列表
 * @package lean
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
	<div class="row">
		<?php if(has_post_thumbnail()) : ?>
		<div class="col-4">
			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
		    <?php
		      // Post thumbnail.
		      the_post_thumbnail('medium', ['class' => 'd-block rounded']);
		    ?>
		  </a>
		</div>
		<div class="col-8">
		<?php else : ?>
		<div class="col-12">
		<?php endif; ?>

			<?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>

						<div class="entry-meta clearfix mt-2 mb-2">
							<small class="text-weakest">
								<?php lean_entry_meta(); ?>
							</small>
						</div><!-- .entry-footer -->

			<div class="entry-excerpt">
				<?php the_excerpt(); ?>
			</div>
		</div>
	</div>
</div><!-- #post-## -->
