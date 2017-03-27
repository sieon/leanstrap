
<?php
/**
 * @package start
 */
?>
<div id="post-<?php the_ID(); ?>"  class="card card-block">
	<?php the_title( sprintf( '<h1 class="card-title">', esc_url( get_permalink() ) ), '</h1>' ); ?>
	<p class="card-text">
		<?php
			/* translators: %s: Name of current post */
			the_content();
		?>
	</p>
	<p class="card-text"><small class="text-muted"><?php lean_entry_footer(); ?></small></p>
</div>
