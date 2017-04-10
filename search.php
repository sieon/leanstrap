<?php
/**
 * 搜索结果页面
 */
get_header(); ?>

<div id="primary" class="container">
	<div class="row">
		<div id="main" class="col-lg-8 site-main" role="main">
			<div class="main-content">

				<?php if ( have_posts() ) : ?>
				<header class="page-header mb-3">
					<h1 class="page-title"><?php printf( esc_html__( '“%s”的搜索结果：', 'lean' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header><!-- .page-header -->
				<div class="hidden">
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php
					//
					get_template_part( 'template-parts/content', 'search' );
					?>

				<?php endwhile; ?>
			</div>
			<div class="more-list">数据加载中，请稍后...</div>
			<div class="load-more text-center"><a href="javascript:;" onClick="lean.loadMore();" class="btn btn-primary">浏览更多</a></div>
			</div>
		<?php else : ?>
			<?php get_template_part( 'template-parts/content', 'none' ); ?>
		<?php endif; ?>
		</div><!-- #main -->
		
		<div class="col-xl-4 col-lg-4">
			<?php get_sidebar(); ?>
		</div>
	</div>
</div><!-- #primary -->
<?php get_footer(); ?>
