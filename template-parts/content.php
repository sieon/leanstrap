<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package start
 */
?>

<div id="post-<?php the_ID(); ?>"  class="card">

	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
		<?php
			// Post thumbnail.
			lean_post_thumbnail();
		?>
	</a>
	<div class=" card-block">
		<?php the_title( sprintf( '<h4 class="card-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
		<p class="card-text">
			<?php
				/* translators: %s: Name of current post */
				the_excerpt();
			?>
			<a href="<?php echo get_permalink(); ?>" class="btn btn-primary" rel="nofollow">阅读全文</a>
		</p>
		<p class="card-text"><small class="text-muted"><?php start_entry_footer(); ?></small></p>
	</div>
</div>
