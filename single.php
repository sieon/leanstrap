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

        <div class="post-tools pb-3 pt-1 text-center">
          <p><button type="button" class="btn btn-danger btn-lg">&nbsp;&nbsp;赏&nbsp;&nbsp;</button></p>
        </div>

        <?php // 显示标签
        $posttags = get_the_tags();
        // var_dump( $posttags );
        if ( $posttags ) {
          echo '<div class="post-tags mb-3 text-center">';
          foreach( $posttags as $tag ) {
            echo '<a href="' . get_tag_link( $tag->term_id ) . '" class="badge badge-pill badge-success mr-3">' . $tag->name . '</a>';
          }
          echo '</div>';
        } ?>

        <!-- <div class="post-tools pb-3 pt-1">
          <div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></div>
          <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"2","bdSize":"32"},"share":{},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
        </div> -->
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
