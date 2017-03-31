<?php
/**
 * start functions and definitions
 *
 * @package lean
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
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
	require 'inc/class-lean_Walker_Nav_Menu.php';
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
function lean_scripts() {

  wp_enqueue_style( 'lean-bootstrap', get_template_directory_uri() . '/assets/bootstrap4/dist/css/bootstrap.css');
	wp_enqueue_style( 'lean-style', get_stylesheet_uri() );
	wp_enqueue_style( 'lean-font-awesome', '//cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css');


  //jQuery first, then Tether, then Bootstrap JS.
	wp_enqueue_script( 'lean-jquery', 'https://cdn.bootcss.com/jquery/3.1.1/jquery.slim.min.js', array(), '20130115', true );
	wp_enqueue_script( 'lean-tether', 'https://cdn.bootcss.com/tether/1.4.0/js/tether.min.js', array(), '20130115', true );
	wp_enqueue_script( 'lean-bootstrap', 'https://cdn.bootcss.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js', array(), '20130115', true );
	//wp_enqueue_script( 'lean-masonry', get_template_directory_uri() . '/assets/js/masonry.pkgd.min.js', array(), '20120206', true );
	wp_enqueue_script( 'lean-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'lean-holder', get_template_directory_uri() . 'assets/js/holder.js', array(), '20170327', true );

	wp_enqueue_script( 'lean-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20130115', true );

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

/*************** COMMENTS  评论   为了符合bootstrap media ***************************/
function lean_comment_callback($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;
    $tag = $depth === 1 ? 'li' : 'div'; ?>
    <<?php echo $tag ?> <?php comment_class('media comment mb-3'); ?>>

        <?php echo lean_get_avatar($comment, 48); ?>
        <div id="comment-<?php comment_ID(); ?>" class="media-body">
					<h5 class="comment-title mt-0">
						<?php comment_author_link(); ?> - <?php comment_date(); ?>
	          <p class="comment-reply float-right">
	              <?php comment_reply_link(array_merge($args, array('reply_text' => __('回复', 'lean'), 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
	          </p>
      		</h5>
      <?php comment_text(); ?>
    <?php
}

function lean_comment_end_callback($comment, $args, $depth)
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
function lean_filter_comment_form_defaults($defaults)
{
    $commenter = wp_get_current_commenter();

    $defaults['fields']['author'] = '<div class="row"><div class="form-group col-md-4"><label for="author">' . __('名字 *', 'lean') . '</label><input id="author" name="author" type="text" class="input-block-level form-control" value="' . esc_attr($commenter['comment_author']) .  '"/></div>';
    $defaults['fields']['email']  = '<div class="form-group col-md-4"><label for="email">' . __('邮箱 *', 'lean') . '</label><input id="email" name="email" type="text" class="input-block-level form-control" value="' . esc_attr($commenter['comment_author_email']) . '" /></div>';
    $defaults['fields']['url'] = '<div class="form-group col-md-4"><label for="url">' . __('网站', 'lean') . '</label><input id="url" name="url" type="text" class="input-block-level form-control" value="' . esc_attr($commenter['comment_author_url']) . '" /></div></div>';


    $defaults['comment_field'] = '<div class="row"><div class="form-group col-md-12"><label for="comment">' . __('留言内容', 'lean') . '</label><textarea id="comment" name="comment" class="input-block-level form-control" rows="5"></textarea></div></div>';
    $defaults['format'] = 'html5';
    $defaults['comment_notes_after'] = '';
    $defaults['class_submit'] = 'btn btn-primary';

    return $defaults;
}
add_filter('comment_form_defaults', 'lean_filter_comment_form_defaults');


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
 * Customizer additions.
 */
//require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';



/**
 *   customizer-library   https://github.com/devinsays/customizer-library
 *   demo   https://github.com/devinsays/customizer-library-demo
 */

// Helper library for the theme customizer.
require get_template_directory() . '/inc/customizer-library/customizer-library.php';

// Define options for the theme customizer.
require get_template_directory() . '/inc/customizer-options.php';

// Output inline styles based on theme customizer selections.
require get_template_directory() . '/inc/styles.php';

// Additional filters and actions based on theme customizer selections.
require get_template_directory() . '/inc/mods.php';


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
