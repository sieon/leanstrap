
<?php
/**
 * @package lean
 */
?>
<div id="post-<?php the_ID(); ?>"  class="">
	<?php the_title( sprintf( '<h1 class="">', esc_url( get_permalink() ) ), '</h1>' ); ?>
	<p class="">
		<?php
			/* translators: %s: Name of current post */
			the_content();
		?>
	</p>
</div>
