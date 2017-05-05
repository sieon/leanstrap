<?php
/**
 * start functions and definitions
 *
 * @package lean
 */

 /*  Loads Custom Widgets
 /* ------------------------------------ */
 load_template( get_template_directory() . '/inc/widgets/alx-tabs.php' );
 //load_template( get_template_directory() . '/functions/widgets/alx-video.php' );
 //load_template( get_template_directory() . '/inc/widgets/alx-posts.php' );
 load_template( get_template_directory() . '/inc/widgets/lean-posts.php' );
 load_template( get_template_directory() . '/inc/widgets/lean-sidebar-posts.php' );
//支持bs4 navbar
require 'inc/bootstrap-wp-navwalker.php';

// Widgets
//require get_template_directory() . '/inc/widgets/posts.php';
//require get_template_directory() . '/inc/widgets/mywidget.php';
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

//图片延迟加载
add_filter ('the_content', 'lazyload');
function lazyload($content) {
	global $post;
	$loadimg_url=get_bloginfo('template_directory').'/assets/img/lazy_loading.gif';
	if(!is_page()) {
		$content=preg_replace('/<img(.+)src=[\'"]([^\'"]+)[\'"](.*)>/i',"<img\$1data-original=\"\$2\" src=\"$loadimg_url\"\$3>",$content);
	}
	return $content;
}


/**
 * 为日历增加样式
 */
add_filter('get_calendar','calendar_class_add');
function calendar_class_add($content){
	return preg_replace("/<table(.*)>/i","<table class='table' $1>",$content);
}

if ( ! function_exists( 'lean_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function lean_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on start, use a find and replace
	 * to change 'start' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'start', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	the_post_thumbnail('thumbnail');       // Thumbnail (default 150px x 150px max)
	the_post_thumbnail('medium');          // Medium resolution (default 300px x 300px max)
	the_post_thumbnail('large');           // Large resolution (default 640px x 640px max)
	the_post_thumbnail('full');            // Original image resolution (unmodified)


	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'lean' ),
		'blogroll' => esc_html__( '友情链接', 'lean' ),
		'about' => esc_html__( '关于', 'lean' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );


  add_theme_support( 'post-formats', array(
  'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
  ) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'lean_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // lean_setup
add_action( 'after_setup_theme', 'lean_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function lean_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( '边栏', 'lean' ),
		'id'            => 'sidebar-1',
		'description'   => '这是默认的边栏。',
		'before_widget' => '<aside id="%1$s" class="card %2$s">',
		'after_widget'  => '</div></aside>',
		'before_title'  => '<h3 class="card-header-2">',
		'after_title'   => '</h3><div class="card-block">',
	) );
	register_sidebar( array(
		'name'          => esc_html__( '首页主轮播图', 'lean' ),
		'id'            => 'home-main-slider',
		'description'   => '首页轮播图。',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
  register_sidebar( array(
    'name'          => esc_html__( '首页区块1', 'lean' ),
    'id'            => 'home-block-1',
    'description'   => '没有子card。',
    'before_widget' => '<div id="%1$s" class="card %2$s">',
    'after_widget'  => '</div></div>',
    'before_title'  => '<h3 class="card-header">',
		'after_title'   => '</h3><div class="card-block">',
  ) );
  register_sidebar( array(
    'name'          => esc_html__( '首页区块2', 'lean' ),
    'id'            => 'home-block-2',
    'description'   => '没有子card',
    'before_widget' => '<div id="%1$s" class="card %2$s">',
    'after_widget'  => '</div></div>',
    'before_title'  => '<h3 class="card-header">',
		'after_title'   => '</h3><div class="card-block">',
  ) );
  register_sidebar( array(
    'name'          => esc_html__( '首页区块 3', 'lean' ),
    'id'            => 'home-block-3',
    'before_widget' => '<div id="%1$s" class="card widget %2$s">',
    'after_widget'  => '</div></div>',
    'before_title'  => '<h3 class="card-header widget-header">',
		'after_title'   => '</h3><div class="card-block">',
  ) );
  register_sidebar( array(
    'name'          => esc_html__( '首页区块 4', 'lean' ),
    'id'            => 'home-block-4',
    'description'   => '首页区块4。',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="widget-header">',
		'after_title'   => '</h3>',
  ) );
	register_sidebar( array(
		'name'          => esc_html__( '底部 1', 'lean' ),
		'id'            => 'footer-1',
		'description'   => '这个地方是一定要放菜单。',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
  register_sidebar( array(
    'name'          => esc_html__( '顶部广告', 'lean' ),
    'id'            => 'home-ad-1',
    'description'   => '这是顶部的长条广告。',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="card-header widget-header">',
    'after_title'   => '</h3>',
  ) );
  register_sidebar( array(
    'name'          => esc_html__( '右侧产品', 'lean' ),
    'id'            => 'home-ad-2',
    'description'   => '',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h3 class="card-header widget-header">',
    'after_title'   => '</h3>',
  ) );
  register_sidebar( array(
    'name'          => esc_html__( '三个广告', 'lean' ),
    'id'            => 'home-ad-3',
    'description'   => '',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h3 class="widget-header">',
    'after_title'   => '</h3>',
  ) );
}
add_action( 'widgets_init', 'lean_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function lean_scripts() {

  wp_enqueue_style( 'lean-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css');
	wp_enqueue_style( 'lean-font-awesome', '//cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css');
	wp_enqueue_style( 'lean-flexslider', get_template_directory_uri() . '/assets/css/flexslider.css');
  wp_enqueue_style( 'lean-animate', get_template_directory_uri() . '/assets/css/animate.css');
  //wp_enqueue_style( 'lean-superfish', get_template_directory_uri() . '/assets/css/superfish.css');
  wp_enqueue_style( 'lean-main', get_template_directory_uri() . '/assets/css/main.css');

  //jQuery first, then Tether, then Bootstrap JS.
	wp_enqueue_script( 'lean-jquery', get_template_directory_uri() . '/assets/js/jquery.js', array(), '20170416', true );
	wp_enqueue_script( 'lean-tether', '//cdn.bootcss.com/tether/1.4.0/js/tether.min.js', array(), '20170416', true );
	wp_enqueue_script( 'lean-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), '20170417', true );
  wp_enqueue_script( 'lean-main', get_template_directory_uri() . '/assets/js/main.js', array(), '20120206', true );
	wp_enqueue_script( 'lean-flexslider', get_template_directory_uri() . '/assets/js/flexslider-min.js', array(), '20170416', true );
	wp_enqueue_script( 'lean-superfish', get_template_directory_uri() . '/assets/js/superfish.min.js', array(), '20120206', true );
	wp_enqueue_script( 'lean-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'lean-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20170416', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'lean_scripts' );


function lean_get_avatar( $id_or_email, $size = 96, $default = '', $alt = '', $args = null ) {
    $defaults = array(
        // get_avatar_data() args.
        'size'          => 96,
        'height'        => null,
        'width'         => null,
        'default'       => get_option( 'avatar_default', 'mystery' ),
        'force_default' => false,
        'rating'        => get_option( 'avatar_rating' ),
        'scheme'        => null,
        'alt'           => '',
        'class'         => null,
        'force_display' => false,
        'extra_attr'    => '',
    );

    if ( empty( $args ) ) {
        $args = array();
    }

    $args['size']    = (int) $size;
    $args['default'] = $default;
    $args['alt']     = $alt;

    $args = wp_parse_args( $args, $defaults );

    if ( empty( $args['height'] ) ) {
        $args['height'] = $args['size'];
    }
    if ( empty( $args['width'] ) ) {
        $args['width'] = $args['size'];
    }

    if ( is_object( $id_or_email ) && isset( $id_or_email->comment_ID ) ) {
        $id_or_email = get_comment( $id_or_email );
    }

    /**
     * Filters whether to retrieve the avatar URL early.
     *
     * Passing a non-null value will effectively short-circuit get_avatar(), passing
     * the value through the {@see 'get_avatar'} filter and returning early.
     *
     * @since 4.2.0
     *
     * @param string $avatar      HTML for the user's avatar. Default null.
     * @param mixed  $id_or_email The Gravatar to retrieve. Accepts a user_id, gravatar md5 hash,
     *                            user email, WP_User object, WP_Post object, or WP_Comment object.
     * @param array  $args        Arguments passed to get_avatar_url(), after processing.
     */
    $avatar = apply_filters( 'pre_get_avatar', null, $id_or_email, $args );

    if ( ! is_null( $avatar ) ) {
        /** This filter is documented in wp-includes/pluggable.php */
        return apply_filters( 'get_avatar', $avatar, $id_or_email, $args['size'], $args['default'], $args['alt'], $args );
    }

    if ( ! $args['force_display'] && ! get_option( 'show_avatars' ) ) {
        return false;
    }

    $url2x = get_avatar_url( $id_or_email, array_merge( $args, array( 'size' => $args['size'] * 2 ) ) );

    $args = get_avatar_data( $id_or_email, $args );

    $url = $args['url'];

    if ( ! $url || is_wp_error( $url ) ) {
        return false;
    }

    $class = array( 'avatar', 'avatar-' . (int) $args['size'], 'photo', 'd-flex', 'mr-3' );

    if ( ! $args['found_avatar'] || $args['force_default'] ) {
        $class[] = 'avatar-default';
    }

    if ( $args['class'] ) {
        if ( is_array( $args['class'] ) ) {
            $class = array_merge( $class, $args['class'] );
        } else {
            $class[] = $args['class'];
        }
    }

    $avatar = sprintf(
        "<img alt='%s' src='%s' srcset='%s' class='%s' height='%d' width='%d' %s/>",
        esc_attr( $args['alt'] ),
        esc_url( $url ),
        esc_attr( "$url2x 2x" ),
        esc_attr( join( ' ', $class ) ),
        (int) $args['height'],
        (int) $args['width'],
        $args['extra_attr']
    );

    /**
     * Filters the avatar to retrieve.
     *
     * @since 2.5.0
     * @since 4.2.0 The `$args` parameter was added.
     *
     * @param string $avatar      &lt;img&gt; tag for the user's avatar.
     * @param mixed  $id_or_email The Gravatar to retrieve. Accepts a user_id, gravatar md5 hash,
     *                            user email, WP_User object, WP_Post object, or WP_Comment object.
     * @param int    $size        Square avatar width and height in pixels to retrieve.
     * @param string $alt         Alternative text to use in the avatar image tag.
     *                                       Default empty.
     * @param array  $args        Arguments passed to get_avatar_data(), after processing.
     */
    return apply_filters( 'get_avatar', $avatar, $id_or_email, $args['size'], $args['default'], $args['alt'], $args );
}


/**
 * Remove Default Widgets
 **/
function unregister_widgets() {
  unregister_widget( 'WP_Widget_RSS' );
  unregister_widget( 'WP_Widget_Pages' );
  unregister_widget( 'WP_Widget_Search' );
  unregister_widget( 'WP_Widget_Recent_Comments' );
  unregister_widget( 'WP_Nav_Menu_Widget' );
}
add_action( 'widgets_init', 'unregister_widgets' );


/**
 * Creates the main header
 *
 * @return void
 * @author
 **/
if (!function_exists('lean_create_nav_header')) {
    function lean_create_nav_header()
    {
        global $post, $wp_query;
        $is_portfolio = false;
        $is_service = false;
        $is_staff = false;
        $is_blog = false;
        if (!is_null($post)) {
            $is_portfolio = $post->post_type === 'lean_portfolio_image';
            $is_service = $post->post_type === 'lean_service';
            $is_staff = $post->post_type === 'lean_staff';
            $is_blog = lean_query_is_blog();
        }

        // check for page overrides
        if (is_page() || $is_blog || $is_portfolio || $is_staff || $is_service || $wp_query->is_404) {
            // if we are on the blog page make sure you use the blog page id for transparancy option
            $page_id = $is_blog ? get_option('page_for_posts') : $post->ID;

            // are we showing the top nav?
            if (get_post_meta($page_id, THEME_SHORT . '_site_top_nav', true) === 'hide') {
                return;
            }
        }

        global $lean_theme;

        if ($lean_theme->get_option('header_top_bar') === 'on') {
            include(locate_template('partials/header/top-bar.php'));
        }


        // get the primary menu
        $menu_slug = null;
        $locations = get_nav_menu_locations();
        if (isset($locations['primary'])) {
            $primary_menu = wp_get_nav_menu_object($locations['primary']);
            if (false !== $primary_menu) {
                echo lean_shortcode_menu( array(
                    'menu_slug'              => $primary_menu->slug,
                    'header_style'           => $lean_theme->get_option('header_style'),
                    'header_sticky'          => $lean_theme->get_option('header_sticky'),
                    'header_sticky_mobile'   => $lean_theme->get_option('header_sticky_mobile'),
                    'header_capitalization'  => $lean_theme->get_option('header_capitalization'),
                    'container_class'        => $lean_theme->get_option('header_container')
                ));
            }
        }
    }
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/custom-comments.php';

// 支持bs4菜单
require get_template_directory() . '/inc/pagination.php';

/**
 *   下一段代码
 *
 */
 if ( ! function_exists('lean_carousels_post_type') ) {

 // Register Custom Post Type
 function lean_carousels_post_type() {

 	$labels = array(
 		'name'                  => _x( 'Carousels', 'Post Type General Name', 'lean' ),
 		'singular_name'         => _x( 'Carousel', 'Post Type Singular Name', 'lean' ),
 		'menu_name'             => __( 'Carousels', 'lean' ),
 		'name_admin_bar'        => __( 'Carousel', 'lean' ),
 		'archives'              => __( 'Carousel Archives', 'lean' ),
 		'attributes'            => __( 'Carousel Attributes', 'lean' ),
 		'parent_item_colon'     => __( 'Parent Carousel:', 'lean' ),
 		'all_items'             => __( 'All Carousels', 'lean' ),
 		'add_new_item'          => __( 'Add New Carousel', 'lean' ),
 		'add_new'               => __( 'Add Carousel', 'lean' ),
 		'new_item'              => __( 'New Carousel', 'lean' ),
 		'edit_item'             => __( 'Edit Carousel', 'lean' ),
 		'update_item'           => __( 'Update Carousel', 'lean' ),
 		'view_item'             => __( 'View Carousel', 'lean' ),
 		'view_items'            => __( 'View Carousels', 'lean' ),
 		'search_items'          => __( 'Search Carousel', 'lean' ),
 		'not_found'             => __( 'Not found', 'lean' ),
 		'not_found_in_trash'    => __( 'Not found in Trash', 'lean' ),
 		'featured_image'        => __( 'Featured Image', 'lean' ),
 		'set_featured_image'    => __( 'Set featured image', 'lean' ),
 		'remove_featured_image' => __( 'Remove featured image', 'lean' ),
 		'use_featured_image'    => __( 'Use as featured image', 'lean' ),
 		'insert_into_item'      => __( 'Insert into item', 'lean' ),
 		'uploaded_to_this_item' => __( 'Uploaded to this item', 'lean' ),
 		'items_list'            => __( 'Items list', 'lean' ),
 		'items_list_navigation' => __( 'Items list navigation', 'lean' ),
 		'filter_items_list'     => __( 'Filter items list', 'lean' ),
 	);
 	$args = array(
 		'label'                 => __( 'Carousel', 'lean' ),
 		'description'           => __( 'Carousel Description', 'lean' ),
 		'labels'                => $labels,
 		'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes', ),
 		'taxonomies'            => array( 'carousel-category' ),
 		'hierarchical'          => true,
 		'public'                => true,
 		'show_ui'               => true,
 		'show_in_menu'          => true,
 		'menu_position'         => 5,
 		'show_in_admin_bar'     => true,
 		'show_in_nav_menus'     => true,
 		'can_export'            => true,
 		'has_archive'           => false,
 		'exclude_from_search'   => false,
 		'publicly_queryable'    => true,
 		'capability_type'       => 'page',
 	);
 	register_post_type( 'carousel', $args );

 }
 add_action( 'init', 'lean_carousels_post_type', 0 );

 }

 if ( ! function_exists( 'lean_carousel_category' ) ) {

// Register Custom Taxonomy
function lean_carousel_category() {

	$labels = array(
		'name'                       => _x( 'carousel-category', 'Taxonomy General Name', 'lean' ),
		'singular_name'              => _x( 'carousel-category', 'Taxonomy Singular Name', 'lean' ),
		'menu_name'                  => __( 'carousel-category', 'lean' ),
		'all_items'                  => __( 'All categories', 'lean' ),
		'parent_item'                => __( 'Parent Category', 'lean' ),
		'parent_item_colon'          => __( 'Parent Category:', 'lean' ),
		'new_item_name'              => __( 'New Category Name', 'lean' ),
		'add_new_item'               => __( 'Add New Category', 'lean' ),
		'edit_item'                  => __( 'Edit Category', 'lean' ),
		'update_item'                => __( 'Update Category', 'lean' ),
		'view_item'                  => __( 'View Category', 'lean' ),
		'separate_items_with_commas' => __( 'Separate categories with commas', 'lean' ),
		'add_or_remove_items'        => __( 'Add or remove Categories', 'lean' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'lean' ),
		'popular_items'              => __( 'Popular Categories', 'lean' ),
		'search_items'               => __( 'Search Items', 'lean' ),
		'not_found'                  => __( 'Not Found', 'lean' ),
		'no_terms'                   => __( 'No items', 'lean' ),
		'items_list'                 => __( 'Items list', 'lean' ),
		'items_list_navigation'      => __( 'Items list navigation', 'lean' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'rewrite'                    => false,
	);
	register_taxonomy( 'carousel-category', array( 'carousel' ), $args );

}
add_action( 'init', 'lean_carousel_category', 0 );

}

/**
 * 9IPHP <Post views statistics> in the theme.
 *
 * 文章阅读量统计
 * @version 1.0
 * @package Specs
 * @copyright 2014 all rights reserved
 *
 */
function specs_set_post_views($postID) {
	if (!current_user_can('level_10')) {
	    $count_key = 'post_views_count';
	    $count = get_post_meta($postID, $count_key, true);
	    if($count==''){
	        $count = 0;
	        delete_post_meta($postID, $count_key);
	        add_post_meta($postID, $count_key, '0');
	    }else{
	      $count++;
	      update_post_meta($postID, $count_key, $count);
	    }
	}
}
function specs_get_post_views($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}

function related_posts( $post_num = 6 ) {
	global $post;
    echo '<div class="widget"><h3 class="widget-header">你可能喜欢：</h3><div class="row">';
    $exclude_id = $post->ID;
    $posttags = get_the_tags(); $i = 0;
    if ( $posttags ) {
        $tags = ''; foreach ( $posttags as $tag ) $tags .= $tag->term_id . ',';
        $args = array(
            'post_status' => 'publish',
            'tag__in' => explode(',', $tags),
            'post__not_in' => explode(',', $exclude_id),
            'ignore_sticky_posts' => 1,
            'orderby' => 'comment_date',
            'posts_per_page' => $post_num
        );
        query_posts($args);
        while( have_posts() ) { the_post(); ?>
          <div class="col-md-4 col-6">
            <div class="card">
              <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
                <?php the_post_thumbnail('medium', ['class' => 'card-img-top']); ?>
              </a>
              <div class="card-block">
                <div class="card-title">
                  <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank"><?php the_title(); ?></a>
                </div>
              </div>
            </div>
          </div>
            <?php
            $exclude_id .= ',' . $post->ID; $i ++;
        }
		wp_reset_query();
    }
    if ( $i < $post_num ) {
        $cats = ''; foreach ( get_the_category() as $cat ) $cats .= $cat->cat_ID . ',';
        $args = array(
            'category__in' => explode(',', $cats),
            'post__not_in' => explode(',', $exclude_id),
            'ignore_sticky_posts' => 1,
            'orderby' => 'comment_date',
            'posts_per_page' => $post_num - $i
        );
        query_posts($args);
        while( have_posts() ) { the_post(); ?>
          <div class="col-md-4 col-6">
            <div class="card">
              <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
                <?php the_post_thumbnail('medium', ['class' => 'card-img-top rounded-0']); ?>
              </a>
              <div class="card-block">
                <div class="card-title">
                  <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank"><?php the_title(); ?></a>
                </div>
              </div>
            </div>
          </div>
            <?php $i++;
        }
		wp_reset_query();
    }
    if ( $i  == 0 )  echo '<div class="col-12"><p>没有相关文章!</p></div>';
    echo '</div></div>';
}

function lean_wp_tag_cloud( $args = '' ) {
    $defaults = array(
        'smallest' => 1, 'largest' => 1, 'unit' => 'rem', 'number' => 45,
        'format' => 'flat', 'separator' => "\n", 'orderby' => 'name', 'order' => 'ASC',
        'exclude' => '', 'include' => '', 'link' => 'view', 'taxonomy' => 'post_tag', 'post_type' => '', 'echo' => true
    );
    $args = wp_parse_args( $args, $defaults );

    $tags = get_terms( $args['taxonomy'], array_merge( $args, array( 'orderby' => 'count', 'order' => 'DESC' ) ) ); // Always query top tags

    if ( empty( $tags ) || is_wp_error( $tags ) )
        return;

    foreach ( $tags as $key => $tag ) {
        if ( 'edit' == $args['link'] )
            $link = get_edit_term_link( $tag->term_id, $tag->taxonomy, $args['post_type'] );
        else
            $link = get_term_link( intval($tag->term_id), $tag->taxonomy );
        if ( is_wp_error( $link ) )
            return;

        $tags[ $key ]->link = $link;
        $tags[ $key ]->id = $tag->term_id;
    }

    $return = wp_generate_tag_cloud( $tags, $args ); // Here's where those top tags get sorted according to $args

    /**
     * Filters the tag cloud output.
     *
     * @since 2.3.0
     *
     * @param string $return HTML output of the tag cloud.
     * @param array  $args   An array of tag cloud arguments.
     */
    $return = apply_filters( 'wp_tag_cloud', $return, $args );

    if ( 'array' == $args['format'] || empty($args['echo']) )
        return $return;

    echo $return;
}
