<?php
/**
 * @package lean
 */
require 'inc/setup.php';
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
require 'inc/widget.php'; // 注册小工具
require 'inc/enqueue.php';// 加载 js 和 css
require get_template_directory() . '/inc/nav-header.php';// 不知道其作用
require get_template_directory() . '/inc/template-tags.php';//模板标签
require get_template_directory() . '/inc/extras.php';//Custom functions that act independently of the theme templates.
require get_template_directory() . '/inc/jetpack.php';//Load Jetpack compatibility file.
require get_template_directory() . '/inc/custom-comments.php';
require get_template_directory() . '/inc/pagination.php';// 支持 Bs4 翻页
require get_template_directory() . '/inc/post-type-slides.php';// 注册内容类型 以支持 CAROUSEL AND 首页栏目
require get_template_directory() . '/inc/post-type-product.php';// 相关文章
//require get_template_directory() . '/inc/taxonomy.php';// 相关文章

require get_template_directory() . '/inc/post-views.php';// 文章阅读量
require get_template_directory() . '/inc/related-posts.php';// 相关文章

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
