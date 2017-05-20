<?php
/**
 * Enqueue scripts and styles.
 */
function lean_scripts() {

  wp_enqueue_style( 'lean-bootstrap', get_template_directory_uri() . '/assets/css/lean.css');
	wp_enqueue_style( 'lean-font-awesome', '//cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css');
	//wp_enqueue_style( 'lean-flexslider', get_template_directory_uri() . '/assets/css/flexslider.css');
  //wp_enqueue_style( 'lean-animate', get_template_directory_uri() . '/assets/css/animate.css');
  //wp_enqueue_style( 'lean-superfish', get_template_directory_uri() . '/assets/css/superfish.css');
  //wp_enqueue_style( 'lean-main', get_template_directory_uri() . '/assets/css/main.css');

  //jQuery first, then Tether, then Bootstrap JS.
	wp_enqueue_script( 'lean-jquery', get_template_directory_uri() . '/assets/js/jquery.js', array(), '20170416', true );
	wp_enqueue_script( 'lean-tether', '//cdn.bootcss.com/tether/1.4.0/js/tether.min.js', array(), '20170416', true );
	wp_enqueue_script( 'lean-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), '20170417', true );
  wp_enqueue_script( 'lean-stickUp', get_template_directory_uri() . '/assets/js/jquery.pin.min.js', array(), '20170417', true );
  wp_enqueue_script( 'lean-main', get_template_directory_uri() . '/assets/js/main.js', array(), '20120206', true );
	//wp_enqueue_script( 'lean-flexslider', get_template_directory_uri() . '/assets/js/flexslider-min.js', array(), '20170416', true );
	wp_enqueue_script( 'lean-superfish', get_template_directory_uri() . '/assets/js/superfish.min.js', array(), '20120206', true );
	wp_enqueue_script( 'lean-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'lean-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20170416', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'lean_scripts' );
