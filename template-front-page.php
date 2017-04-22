<?php
/**
 * Template Name: Front Page Template
 */
get_header(); ?>

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class"display-1">轻主题，做最用心的那个。</h1>
        <p class="lead">做爱做的事。</p>
    </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-lg-8">
      <div class="row">
        <?php get_template_part( 'template-parts/content', 'sticky' ); ?>
        <div class="col-12 mb-5">
          <div class="card" style="border: 0px;">
            <h3 class="card-title">特色文章</h3>
            <?php get_template_part( 'template-parts/card', 'list' ); ?>
          </div>
        </div>
        <div class="col-12 mb-3">
          <div class="card" style="border: 0px;">
            <h3 class="card-title">最新文章</h3>
            <?php get_template_part( 'template-parts/content', 'list-2' ); ?>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3  offset-lg-1">
      <?php get_sidebar();?>
    </div>
  </div><!--/.row-->
</div>

<?php get_footer(); ?>
