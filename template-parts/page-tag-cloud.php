<?php
/**
 * Template Name: 标签云
 *
 * @package leanstrap
 * @since leanstrap 0.5
 */
get_header(); ?>

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1>标签云</h1>
    </div>
</div>
<div class="container">
  <div class="entry-content pb-4">
    <?php wp_tag_cloud(); ?>
  </div>
</div>

<?php get_footer(); ?>
