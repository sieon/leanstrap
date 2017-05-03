<?php

function unregister_widgets() {
  unregister_widget( 'WP_Widget_RSS' );
  unregister_widget( 'WP_Widget_Pages' );
  unregister_widget( 'WP_Widget_Search' );
  unregister_widget( 'WP_Widget_Recent_Comments' );
  unregister_widget( 'WP_Nav_Menu_Widget' );
}
add_action( 'widgets_init', 'unregister_widgets' );
