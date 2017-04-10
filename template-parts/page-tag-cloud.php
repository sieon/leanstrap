<?php
/**
 * Template Name: 标签云
 *
 * @package leanstrap
 * @since leanstrap 0.5
 */
get_header(); ?>

<div class="container p-a">
  <h1 class="">标签云</h1>
  <div class="content">
    <?php wp_tag_cloud(); //wp_list_categories();wp_list_pages();?>
  </div>
</div>

<?php get_footer(); ?>
