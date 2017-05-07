<?php
/**
 * Template Name: 首页模板 2
 */
get_header(); ?>

<div class="container">
  <!--./横幅广告 start--->
  <div class="mb-3">
      <?php if ( !dynamic_sidebar('home-ad-1') ) { _e('','lean'); } //广告 ?>
    </div>
<!--./横幅广告 end--->

  <div class="row">
    <div class="col-lg-9">
      <div class="row mb-3">
        <!--幻灯片--->
        <div class="col-lg-6">
          <div id="homeMainCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
              <?php $slider = get_posts(array('post_type' => 'carousel', 'posts_per_page' => 3)); ?>
              <?php $count = 0; ?>
              <?php foreach($slider as $slide): ?>
              <div class="carousel-item <?php echo ($count == 0) ? 'active' : ''; ?>">
                <a href="<?php echo get_post_meta($slide->ID, "lean_slide_url", $single = true); ?>">
                <img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($slide->ID)) ?>" class="d-block" />
                <div class="container">
                  <div class="carousel-caption d-none d-md-block">
                    <h3><?php echo $slide->post_title; ?><h3>
                    <p><?php echo $slide->post_content; ?></p>
                  </div>
                </div>
                </a>
              </div>
              <?php $count++; ?>
              <?php endforeach; ?>
            </div>
            <a class="carousel-control-prev" href="#homeMainCarousel" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#homeMainCarousel" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
        <!--主编推荐--->
        <div class="col-lg-6">
          <?php get_template_part( 'template-parts/hd', 'sticky-list' ); ?>
        </div>
      </div><!---./row-->

      <!---滚动-->
      <div class="row mb-3">
        <div class="col-lg-12">
          <p class="text-roll"><small>这是一个滚动条</small></p>
        </div>
      </div>
      <!---两个栏目-->
      <div class="row">
        <div class="col-lg-6">
          <?php if ( !dynamic_sidebar('home-block-1') ) { _e('','lean'); } ?>
        </div>
        <div class="col-lg-6">
          <?php if ( !dynamic_sidebar('home-block-2') ) { _e('','lean'); } ?>
        </div>
      </div>
    </div><!--./col-lg-9--->

    <!--产品--->
    <div class="col-lg-3 hidden-md-down">
      <?php if ( !dynamic_sidebar('home-ad-2') ) { _e('','lean'); } ?>
    </div>
  </div>

  <!-- banner ad 2-->
  <div class="row ad-2 mb-3 hidden-sm-down">
    <div class="col-lg-12"><?php if ( !dynamic_sidebar('home-ad-3') ) { _e('','lean'); } ?></div>
  </div>

  <div class="row">

    <div class="col-lg-8">
      <?php get_template_part( 'template-parts/hd', 'graphic' ); ?>
      <?php
      $sticky = get_option( 'sticky_posts' );
      $args = array(
        'posts_per_page' => '10',
        'post_type' => 'post',
        'caller_get_posts' => 1,
        'ignore_sticky_posts' =>1,
        'tag__not_in' => array(179,178),
        'post__not_in' => $sticky
      );
      query_posts( $args );
      while ( have_posts() ) : the_post();
      /* 显示内容 */
        get_template_part( 'template-parts/posts', 'list' );
      endwhile;wp_reset_postdata();
      ?>
    </div>
    <div class="col-lg-4 hidden-sm-down">
      <?php get_sidebar();?>
    </div>
  </div>
</div><!--./container-->
<?php get_footer(); ?>
