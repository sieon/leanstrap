<?php
/**
 * 搜索结果页面
 */
get_header(); ?>

<?php if ( have_posts() ) : ?>

<header class="jumbotron">
	<div class="container">
		<h1><?php printf( esc_html__( '“%s”的搜索结果：', 'lean' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
	</div>
</header>

<div id="primary" class="container mt-4">
	<div class="row">
		<div class="col-lg-8 offset-md-2">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template-parts/posts', 'list' ); ?>
			<?php endwhile; ?>
			<?php else : ?>
				<?php get_template_part( 'template-parts/content', 'none' ); ?>
			<?php endif; ?>
		</div>

	</div><!-- #row-->
</div><!-- #container -->
<?php get_footer(); ?>
