<?php
/**
 * Template Name: Front Page Template
 */
 add_action('wp_enqueue_scripts', 'flexslider_js_css');
 function flexslider_js_css(){
     wp_enqueue_script('flexslider', get_template_directory_uri() . '/assets/js/flexslider-min.js', array('jquery'), '20130129', true );
     wp_enqueue_style('flexslider', get_template_directory_uri() . '/assets/css/flexslider.css');
 }
 add_action('wp_footer', 'init_flexslider');
 function init_flexslider(){
     ?>
     <script type="text/javascript">
         jQuery(document).ready(function(){
             jQuery('.flexslider').flexslider({
               controlNav: false,
             });
         });
     </script>
     <?php
 }

get_header('noad'); ?>
<div class="container">

  <div class="flexslider">
    <ul class="slides">
      <?php
      $args = array(
        'posts_per_page' => '10',
        'post_type' => 'slides',
        'caller_get_posts' => 1,
        'ignore_sticky_posts' =>1,
        'tax_query' => array(
          array(
            'taxonomy'=> 'slides-category',
            'field' => 'slug',
            'terms'=>'home-main-slides-1'
          )
        )
      );
      query_posts( $args );
      while ( have_posts() ) : the_post(); ?>
      <li>
        <img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id(get_the_ID())); ?>" />
        <p class="flex-caption"><?php the_title( sprintf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a>' ); ?></p>
      </li>
      <?php endwhile; wp_reset_postdata(); ?>
    </ul>
  </div>

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
