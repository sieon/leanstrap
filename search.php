<?php
/**
 * 搜索结果页面
 */
get_header(); ?>

<div id="primary" class="container mt-3">
	<div class="row">
		<div class="col-lg-8">

			<?php if ( have_posts() ) : ?>

			<header class="jumbotron page-header">
				<h1 class="page-title"><?php printf( esc_html__( '“%s”的搜索结果：', 'lean' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header>

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template-parts/posts', 'list' ); ?>
			<?php endwhile; ?>
			<?php else : ?>
				<?php get_template_part( 'template-parts/content', 'none' ); ?>
			<?php endif; ?>
		</div>

		<div class="col-lg-4">
			<?php get_sidebar(); ?>
		</div>
	</div>
</div><!-- #primary -->
<?php get_footer(); ?>
