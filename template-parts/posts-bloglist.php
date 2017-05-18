<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package start
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('entry border-bottom-1pt-3 pb-2'); ?>>
	<div class="row">
		<?php if(has_post_thumbnail()) : ?>
		<div class="col-4 col-lg-3">
			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
				<?php
					// Post thumbnail.
					lean_post_thumbnail();
				?>
			</a>
		</div>
		<div class="col-8 col-lg-9">
		<?php else : ?>
		<div class="col-12">
		<?php endif; ?>

			<header class="entry-header mb-3">
				<?php the_title( sprintf( '<h3><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
			</header>

			<div class="entry-excerpt">
				<?php the_excerpt(); ?>
			</div>

			<footer class="entry-footer">
				<p>
					<small>
						<?php
						if ( is_sticky() && is_home() && ! is_paged() ) {
							printf( '<span class="sticky-post">%s</span> ', __( '特色', 'lean' ) );
						}?>

						<?php the_time();?>

						<?php if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
								echo ' <span class="comments-link">';
								/* translators: %s: post title */
								comments_popup_link( sprintf( __( '去评论<span class="sr-only sr-only-focusable"> on %s</span>', 'lean' ), get_the_title() ) );
								echo '</span>';
							}
						 ?>
					</small>
				</p>
			</footer><!-- .entry-footer -->
		</div>
	</div><!--./row -->
</article><!-- #post-## -->
