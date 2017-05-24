<?php
/**
 * Enqueue scripts and styles.
 */
function lean_scripts() {

  wp_enqueue_style( 'lean-bootstrap', THEME_URI . '/assets/css/lean.css');
	wp_enqueue_style( 'lean-font-awesome', '//cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css');
  //wp_enqueue_style( 'lean-animate', THEME_URI . '/assets/css/animate.css');
  //wp_enqueue_style( 'lean-superfish', THEME_URI . '/assets/css/superfish.css');
  //wp_enqueue_style( 'lean-main', THEME_URI . '/assets/css/main.css');

  //jQuery first, then Tether, then Bootstrap JS.
	wp_enqueue_script( 'lean-jquery', THEME_URI . '/assets/js/jquery.js', array(), '20170416', true );
	wp_enqueue_script( 'lean-tether', '//cdn.bootcss.com/tether/1.4.0/js/tether.min.js', array(), '20170416', true );
	wp_enqueue_script( 'lean-bootstrap', THEME_URI . '/assets/js/bootstrap.min.js', array(), '20170417', true );
  wp_enqueue_script( 'lean-stickUp', THEME_URI . '/assets/js/jquery.pin.min.js', array(), '20170417', true );
  wp_enqueue_script( 'lean-main', THEME_URI . '/assets/js/main.js', array(), '20120206', true );
	wp_enqueue_script( 'lean-superfish', THEME_URI . '/assets/js/superfish.min.js', array(), '20120206', true );
	//wp_enqueue_script( 'lean-navigation', THEME_URI . '/assets/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'lean-skip-link-focus-fix', THEME_URI . '/assets/js/skip-link-focus-fix.js', array(), '20170416', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'lean_scripts' );
