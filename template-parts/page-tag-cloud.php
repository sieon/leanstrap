<?php
/**
 * Template Name: 标签云
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
    <?php wp_tag_cloud(); wp_list_categories();wp_list_pages();?>

  </div>
</div><!--/.row-->

<?php get_footer(); ?>
