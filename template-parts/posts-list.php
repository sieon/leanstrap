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


						<div class="entry-footer clearfix mt-2 mb-2">
							<small class="text-weakest">
								<?php
								if ( is_sticky() && is_home() && ! is_paged() ) {
									printf( '<div class="sticky-post hidden-sm-down">%s<span class="oblique-line">&nbsp;&bull;&nbsp;</span></div> ', __( '特色', 'lean' ) );
								}?>
								<div class="post-author hidden-sm-down">
									<?php the_author(); ?><span class="oblique-line">&nbsp;&bull;&nbsp;</span>
								</div>
								<div class="post-time">
									<?php the_time();?>
								</div>
								<div class="post-categories ml-4 hidden-sm-down">
									<i class="fa fa-tags" aria-hidden="true"></i>&nbsp;
									<?php the_category(' '); ?>
								</div>
								<div class="float-right">
									<?php if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
										comments_popup_link( sprintf( __( '去抢首评<span class="screen-reader-text"> on %s</span>', 'lean' ), get_the_title() ) );
									}
									?>
							 </div>
							</small>
						</div><!-- .entry-footer -->

			<div class="entry-excerpt">
				<?php the_excerpt(); ?>
			</div>
		</div>
	</div>
</div><!-- #post-## -->
