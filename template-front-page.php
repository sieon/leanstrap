<?php
/**
 * Template Name: Front Page Template
 */
get_header(); ?>

<div id="myCarousel" class="carousel slide" data-ride="carousel">
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
  <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<?php get_template_part( 'template-parts/content', 'flexslider' ); ?>

<div class="container">
  <div class="row">
    <div class="col-lg-9">
      <div class="row">
        <div class="col-12"><?php get_template_part( 'template-parts/content', 'sticky' ); ?></div>
        <div class="col-12 mb-3"><?php if ( !dynamic_sidebar('home-block-1') ) { _e('','lean'); } ?></div>
        <div class="col-lg-6 mb-3"><?php if ( !dynamic_sidebar('home-block-2') ) { _e('','lean'); } ?></div>
        <div class="col-lg-6 mb-3"><?php if ( !dynamic_sidebar('home-block-3') ) { _e('','lean'); } ?></div>
        <div class="col-12 mb-3"><?php if ( !dynamic_sidebar('home-block-4') ) { _e('','lean'); } ?></div>
      </div>
    </div>
    <div class="col-lg-3">
      <?php get_sidebar();?>
    </div>
  </div><!--/.row-->
</div>

<?php get_footer(); ?>
