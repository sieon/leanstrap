<div id="myCarousel" class="carousel slide mb-4" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1" class=""></li>
    <li data-target="#myCarousel" data-slide-to="2" class=""></li>
  </ol>
  <div class="carousel-inner" role="listbox">
    <?php $slider = get_posts(array('post_type' => 'carousel', 'posts_per_page' => 3)); ?>
    <?php $count = 0; ?>
    <?php foreach($slider as $slide): ?>
    <div class="carousel-item <?php echo ($count == 0) ? 'active' : ''; ?>">
      <img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($slide->ID)) ?>" class="d-block img-fluid rounded silde-img"/>
      <!--
      <div class="container">
        <div class="carousel-caption d-none d-md-block">
          <h2><?php echo $slide->post_title; ?><h2>
          <p><?php echo $slide->post_content; ?></p>
        </div>
      </div>
      -->
    </div>
    <?php $count++; ?>
    <?php endforeach; ?>
  </div>
  <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">上一个</span>
  </a>
  <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">下一个</span>
  </a>
</div>

<script type="text/javascript">
jQuery(document).ready(function($) {
    $('.carousel').carousel({
      interval: 500
    })
});
$(".img-fluid img").addClass("carousel-inner img-responsive img-rounded");
</script>
