<?php

function related_posts( $post_num = 6 ) {
	global $post;
    echo '<div class="widget related-posts"><h3 class="card-header-2">你可能喜欢：</h3><div class="row">';
    $exclude_id = $post->ID;
    $posttags = get_the_tags(); $i = 0;
    if ( $posttags ) {
        $tags = ''; foreach ( $posttags as $tag ) $tags .= $tag->term_id . ',';
        $args = array(
            'post_status' => 'publish',
            'tag__in' => explode(',', $tags),
            'post__not_in' => explode(',', $exclude_id),
            'ignore_sticky_posts' => 1,
            'orderby' => 'comment_date',
            'posts_per_page' => $post_num
        );
        query_posts($args);
        while( have_posts() ) { the_post(); ?>
          <div class="col-md-4 col-6">
            <div class="card">
              <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
                <?php the_post_thumbnail('medium', ['class' => 'card-img-top']); ?>
              </a>
              <div class="card-block">
                <div class="card-title">
                  <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank"><?php the_title(); ?></a>
                </div>
              </div>
            </div>
          </div>
            <?php
            $exclude_id .= ',' . $post->ID; $i ++;
        }
		wp_reset_query();
    }
    if ( $i < $post_num ) {
        $cats = ''; foreach ( get_the_category() as $cat ) $cats .= $cat->cat_ID . ',';
        $args = array(
            'category__in' => explode(',', $cats),
            'post__not_in' => explode(',', $exclude_id),
            'ignore_sticky_posts' => 1,
            'orderby' => 'comment_date',
            'posts_per_page' => $post_num - $i
        );
        query_posts($args);
        while( have_posts() ) { the_post(); ?>
          <div class="col-md-4 col-6">
            <div class="card">
              <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
                <?php the_post_thumbnail('medium', ['class' => 'card-img-top rounded-0']); ?>
              </a>
              <div class="card-block">
                <div class="card-title">
                  <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank"><?php the_title(); ?></a>
                </div>
              </div>
            </div>
          </div>
            <?php $i++;
        }
		wp_reset_query();
    }
    if ( $i  == 0 )  echo '<div class="col-12"><p>没有相关文章!</p></div>';
    echo '</div></div>';
}
