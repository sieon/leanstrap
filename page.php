<?php get_header(); ?>

<div class="container p-a mt-3" id="site-content">
  <?php if ( have_posts() ) : // Start the Loop ?>
    <?php while ( have_posts() ) : the_post(); ?>
			<?php
				// 显示页面内容
				get_template_part( 'template-parts/content', 'page' );
			?>
    <?php endwhile; ?>  <?php endif; ?>
</div><!--./container -->

<?php get_footer(); ?>
