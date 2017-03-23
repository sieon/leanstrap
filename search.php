<?php
/**
 * The template for displaying search results pages.
 *
 * @package start
 */

get_header(); ?>

	<div id="primary" class="container content-area">
		<div class="row">
			<div id="main" class="col-xl-8 col-lg-8 site-main" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header mb-3">
					<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'lean' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header><!-- .page-header -->

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
					/**
					 * Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called content-search.php and that will be used instead.
					 */
					get_template_part( 'template-parts/content', 'search' );
					?>

				<?php endwhile; ?>

				<?php start_the_posts_navigation(); ?>

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
