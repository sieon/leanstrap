<section class="slider">
  <div id="mySlider" class="flexslider">
    <ul class="slides">
      <?php
      query_posts( 'posts_per_page=3&post_type=carousel');
      while ( have_posts() ) : the_post();
      ?>
      <li>
        <?php
          // Post thumbnail.
          the_post_thumbnail('full', ['class' => ' ']);
        ?>
      </li>
      <?php endwhile;// end of the loop.
      wp_reset_postdata(); ?>
    </ul>
  </div>
</section>
<script type="text/javascript">
$(window).load(function() {
  $('.flexslider').flexslider({
    animation: "slide"
  });
});
</script>
