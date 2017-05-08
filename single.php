<?php get_header();?>

<!-- .col-  .col-sm-	.col-md-	.col-lg-	.col-xl--->
<?php while ( have_posts() ) : the_post(); ?>
  <div class="container mt-5">
    <div class="row">
      <div class="col-lg-8">
        <header class="entry-header">
          <?php the_title('<h1 class="mb-4">', '</h1>'); ?>
          <p class="post-meta text-weakest mb-3">
            <small>
              <span><?php the_author(); ?></span>
              <span>&nbsp;&bull;&nbsp;</span>
              <time><?php the_time(); ?></time>
              <span>&nbsp;&bull;&nbsp;</span>
              <?php the_category(' / '); ?>
            </small>
          </p>
        </header>
        <?php
        // 显示页面内容
        get_template_part( 'formats/format', get_post_format() ); ?>

        <?php // 显示标签
        $posttags = get_the_tags();
        // var_dump( $posttags );
        if ( $posttags ) {
          echo '<div class="post-tags mb-3 text-center">';
          foreach( $posttags as $tag ) {
            echo '<a href="' . get_tag_link( $tag->term_id ) . '" class="btn btn-info mr-3 mb-2">' . $tag->name . '</a>';
          }
          echo '</div>';
        } ?>

        <?php
        //相关文章
        related_posts(); ?>

        <?php // 加载评论
        if ( comments_open() || get_comments_number() ) :
          comments_template();
        endif;
        ?>
        <?php endwhile; // end of the loop. ?>

      </div>

      <div class="col-lg-4 hidden-sm-down">
        <?php get_sidebar();?>
      </div>
    </div><!-- /.row -->
  </div><!-- /.container -->
<?php get_footer();?>
