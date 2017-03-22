<?php
/**
 * start functions and definitions
 *
 * @package start
 */


 /**
  * WordPress 修改时间的显示格式为几天前
  * https://www.wpdaxue.com/time-ago.html
  */
 function Bing_filter_time(){
 	global $post ;
 	$to = time();
 	$from = get_the_time('U') ;
 	$diff = (int) abs($to - $from);
 	if ($diff <= 3600) {
 		$mins = round($diff / 60);
 		if ($mins <= 1) {
 			$mins = 1;
 		}
 		$time = sprintf(_n('%s 分钟', '%s 分钟', $mins), $mins) . __( '前' , 'Bing' );
 	}
 	else if (($diff <= 86400) && ($diff > 3600)) {
 		$hours = round($diff / 3600);
 		if ($hours <= 1) {
 			$hours = 1;
 		}
 		$time = sprintf(_n('%s 小时', '%s 小时', $hours), $hours) . __( '前' , 'Bing' );
 	}
 	elseif ($diff >= 86400) {
 		$days = round($diff / 86400);
 		if ($days <= 1) {
 			$days = 1;
 			$time = sprintf(_n('%s 天', '%s 天', $days), $days) . __( '前' , 'Bing' );
 		}
 		elseif( $days > 29){
 			$time = get_the_time(get_option('date_format'));
 		}
 		else{
 			$time = sprintf(_n('%s 天', '%s 天', $days), $days) . __( '前' , 'Bing' );
 		}
 	}
 	return $time;
 }
 add_filter('the_time','Bing_filter_time');


 // add custom active class in menu items 多余的 active
 /** function oxy_custom_active_item_class($classes = array(), $menu_item = false)
 {
     if (in_array('current-menu-item', $menu_item->classes)) {
         $classes[] = 'active';
     }
     return $classes;
 }
 add_filter('nav_menu_css_class', 'oxy_custom_active_item_class', 10, 2);**/


 if ( ! function_exists( 'lean_post_thumbnail' ) ) :
 /**
  * Display an optional post thumbnail.
  *
  * Wraps the post thumbnail in an anchor element on index views, or a div
  * element when on single views.
  *
  * @since Twenty Fifteen 1.0
  */
 function lean_post_thumbnail() {
 	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
 		return;
 	}

 	if ( is_singular() ) :
 	?>

 	<div class="post-thumbnail mb-4 float-left mr-5">
    <?php
      // Post thumbnail.
      the_post_thumbnail('post-thumbnail', ['class' => 'img-fluid']);
 		?>
 	</div><!-- .post-thumbnail -->

 	<?php else : ?>

 	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
 		<?php
      // Post thumbnail.
      the_post_thumbnail('post-thumbnail', ['class' => 'card-img-top img-fluid']);
 		?>
 	</a>
 	<?php endif; // End is_singular()
 }
 endif;


/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'start_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function start_setup() {
	require 'inc/class-Upbootwp_Walker_Nav_Menu.php';
	require 'inc/comment.php';
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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'start' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );


	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'start_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // start_setup
add_action( 'after_setup_theme', 'start_setup' );

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
		'before_widget' => '<aside id="%1$s" class="card card-block widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="card-title widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'lean_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function start_scripts() {
	wp_enqueue_style( 'start-style', get_stylesheet_uri() );

	//wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');

	wp_enqueue_script( 'start-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'start-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'start_scripts' );


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


/*
 ************** COMMENTS **************************
 <!-- <div class="media">
	 <img class="d-flex mr-3" src="..." alt="Generic placeholder image">
	 <div class="media-body">
		 <h5 class="mt-0">Media heading</h5>
		 Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.

		 <div class="media mt-3">
			 <a class="d-flex pr-3" href="#">
				 <img src="..." alt="Generic placeholder image">
			 </a>
			 <div class="media-body">
				 <h5 class="mt-0">Media heading</h5>
				 Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
			 </div>
		 </div>
	 </div>
 </div> -->
 */

/*************** COMMENTS ***************************/
function oxy_comment_callback($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;
    $tag = $depth === 1 ? 'li' : 'div'; ?>
    <<?php echo $tag ?> <?php comment_class('media media-comment mt-3'); ?>>

        <?php echo lean_get_avatar($comment, 48); ?>

        <div id="comment-<?php comment_ID(); ?>" class="media-body">
                    <h4 class="mt-0">
                        <strong>
                            <?php comment_author_link(); ?>
                        </strong>
												<small class="text-muted">
                        &nbsp;<?php comment_date(); ?>
												</small>
                        <strong class="comment-reply pull-right">
                            <?php comment_reply_link(array_merge($args, array('reply_text' => __('回复', 'lambda-td'), 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                        </strong>
                    </h4>
                    <?php comment_text(); ?>
    <?php
}

function oxy_comment_end_callback($comment, $args, $depth)
{
    // we need to add 1 to the depth to get this to work
    $tag = $depth + 1 === 1 ? 'li' : 'div'; ?>
        </div>
    </<?php echo $tag ?>>
    <?php
}

/**
 * Replaces default arguments used in comment_form function
 *
 * @return new defaults
 **/
function oxy_filter_comment_form_defaults($defaults)
{
    $commenter = wp_get_current_commenter();

    $defaults['fields']['author'] = '<div class="row"><div class="form-group col-md-4"><label for="author">' . __('名字 *', 'lambda-td') . '</label><input id="author" name="author" type="text" class="input-block-level form-control" value="' . esc_attr($commenter['comment_author']) .  '"/></div>';
    $defaults['fields']['email']  = '<div class="form-group col-md-4"><label for="email">' . __('邮箱 *', 'lambda-td') . '</label><input id="email" name="email" type="text" class="input-block-level form-control" value="' . esc_attr($commenter['comment_author_email']) . '" /></div>';
    $defaults['fields']['url'] = '<div class="form-group col-md-4"><label for="url">' . __('网站', 'lambda-td') . '</label><input id="url" name="url" type="text" class="input-block-level form-control" value="' . esc_attr($commenter['comment_author_url']) . '" /></div></div>';


    $defaults['comment_field'] = '<div class="row"><div class="form-group col-md-12"><label for="comment">' . __('留言内容', 'lambda-td') . '</label><textarea id="comment" name="comment" class="input-block-level form-control" rows="5"></textarea></div></div>';
    $defaults['format'] = 'html5';
    $defaults['comment_notes_after'] = '';
    $defaults['class_submit'] = 'btn btn-primary';

    return $defaults;
}
add_filter('comment_form_defaults', 'oxy_filter_comment_form_defaults');


/**
 * Creates the main header
 *
 * @return void
 * @author
 **/
if (!function_exists('oxy_create_nav_header')) {
    function oxy_create_nav_header()
    {
        global $post, $wp_query;
        $is_portfolio = false;
        $is_service = false;
        $is_staff = false;
        $is_blog = false;
        if (!is_null($post)) {
            $is_portfolio = $post->post_type === 'oxy_portfolio_image';
            $is_service = $post->post_type === 'oxy_service';
            $is_staff = $post->post_type === 'oxy_staff';
            $is_blog = oxy_query_is_blog();
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

        global $oxy_theme;

        if ($oxy_theme->get_option('header_top_bar') === 'on') {
            include(locate_template('partials/header/top-bar.php'));
        }


        // get the primary menu
        $menu_slug = null;
        $locations = get_nav_menu_locations();
        if (isset($locations['primary'])) {
            $primary_menu = wp_get_nav_menu_object($locations['primary']);
            if (false !== $primary_menu) {
                echo oxy_shortcode_menu( array(
                    'menu_slug'              => $primary_menu->slug,
                    'header_style'           => $oxy_theme->get_option('header_style'),
                    'header_sticky'          => $oxy_theme->get_option('header_sticky'),
                    'header_sticky_mobile'   => $oxy_theme->get_option('header_sticky_mobile'),
                    'header_capitalization'  => $oxy_theme->get_option('header_capitalization'),
                    'container_class'        => $oxy_theme->get_option('header_container')
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
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
