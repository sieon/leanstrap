<?php
/**
 * Template Name: Front Page Template
 *
 * Description: A page template that provides a key component of WordPress as a CMS
 * by meeting the need for a carefully crafted introductory page. The front page template
 * in Twenty Twelve consists of a page content area for adding text, images, video --
 * anything you'd like -- followed by front-page-only widgets in one or two columns.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */


get_header('2'); ?>

<div class="row">
  <div class="col-lg-12">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class=""></li>
        <li data-target="#myCarousel" data-slide-to="1" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="2" class=""></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="carousel-item">
          <img class="first-slide" src="http://demo.qingzhuti.com/wp-content/uploads/2017/03/ballet-1376250_640.jpg" alt="First slide">
          <div class="container">
            <div class="carousel-caption d-none d-md-block text-left">
              <h1>Example headline.</h1>
              <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
            </div>
          </div>
        </div>
        <div class="carousel-item active">
          <img class="second-slide" src="http://demo.qingzhuti.com/wp-content/uploads/2017/03/133009858417.jpg" alt="Second slide">
          <div class="container">
            <div class="carousel-caption d-none d-md-block">
              <h1>Another example headline.</h1>
              <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <img class="third-slide" src="http://demo.qingzhuti.com/wp-content/uploads/2017/03/coast-192979-e1490516430557.jpg" alt="Third slide">
          <div class="container">
            <div class="carousel-caption d-none d-md-block text-right">
              <h1>One more for good measure.</h1>
              <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
            </div>
          </div>
        </div>
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
  </div>
  <div class="col-lg-12">
    <?php
    $args = array(
      'post_type' => 'post' ,
      'tag' => 'slide',
      'posts_per_page' => '1'
      //'post__in' => get_option( 'sticky_posts' )
    );
    $myPosts = new WP_Query($args);
    while ( $myPosts->have_posts() ) : $myPosts->the_post();
    ?>
    <section class="jumbotron text-center">
      <?php the_title( '<h1 class="jumbotron-heading">', '</h1>' ); ?>
      <p class="lead text-muted"><?php the_excerpt();?></p>
      <p>
        <a href="#" class="btn btn-primary">下载</a>
        <a href="#" class="btn btn-secondary">了解更多</a>
      </p>
    </section>ß
    <?php endwhile;
    // Reset Post Data
    wp_reset_postdata();
    ?>
  </div>

  <div class="col-lg-8">
    <?php
    query_posts( 'posts_per_page=10');
    if ( have_posts() ) :
       while ( have_posts() ) : the_post(); ?>

        <?php
        /**
         * 显示内容
         */
        get_template_part( 'template-parts/content', 'bloglist' );
        ?>
    <?php endwhile; ?>
      <?php else : ?>
      <?php get_template_part( 'template-parts/content', 'none' ); ?>
      <?php endif;     // Reset Post Data
        wp_reset_postdata();?>
  </div>

  <div class="col-xl-4 col-lg-4">
    <?php get_sidebar();?>
  </div>
</div><!--/.row-->

<?php get_footer(); ?>
