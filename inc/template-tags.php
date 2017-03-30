<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package start
 */


/**
  * next posts link
  *
  */
 function lean_get_next_posts_link( $label = null, $max_page = 0 ) {
 	global $paged, $wp_query;

 	if ( !$max_page )
 		$max_page = $wp_query->max_num_pages;

 	if ( !$paged )
 		$paged = 1;

 	$nextpage = intval($paged) + 1;

 	if ( null === $label )
 		$label = __( 'Next Page &raquo;' );

 	if ( !is_single() && ( $nextpage <= $max_page ) ) {
 		/**
 		 * Filter the anchor tag attributes for the next posts page link.
 		 *
 		 * @since 2.7.0
 		 *
 		 * @param string $attributes Attributes for the anchor tag.
 		 */
 		$attr = apply_filters( 'next_posts_link_attributes', '' );

 		return '<a class="page-link" href="' . next_posts( $max_page, false ) . "\" $attr>" . preg_replace('/&([^#])(?![a-z]{1,8};)/i', '&#038;$1', $label) . '</a>';
 	}
 }

 function lean_next_posts_link( $label = null, $max_page = 0 ) {
 	echo lean_get_next_posts_link( $label, $max_page );
 }


/**
 * previous posts link
 */

 function lean_get_previous_posts_link( $label = null ) {
 	global $paged;

 	if ( null === $label )
 		$label = __( '&laquo; Previous Page' );

 	if ( !is_single() && $paged > 1 ) {
 		/**
 		 * Filter the anchor tag attributes for the previous posts page link.
 		 *
 		 * @since 2.7.0
 		 *
 		 * @param string $attributes Attributes for the anchor tag.
 		 */
 		$attr = apply_filters( 'previous_posts_link_attributes', '' );
 		return '<a class="page-link" href="' . previous_posts( false ) . "\" $attr>". preg_replace( '/&([^#])(?![a-z]{1,8};)/i', '&#038;$1', $label ) .'</a>';
 	}
 }


/**
 * page navi
 */

 function lean_bootstrap_page_navi($before = '', $after = '') {
   global $wpdb, $wp_query;
   $request = $wp_query->request;
   $posts_per_page = intval(get_query_var('posts_per_page'));
   $paged = intval(get_query_var('paged'));
   $numposts = $wp_query->found_posts;
   $max_page = $wp_query->max_num_pages;
   if ( $numposts <= $posts_per_page ) { return; }
   if(empty($paged) || $paged == 0) {
     $paged = 1;
   }
   $pages_to_show = 7;
   $pages_to_show_minus_1 = $pages_to_show-1;
   $half_page_start = floor($pages_to_show_minus_1/2);
   $half_page_end = ceil($pages_to_show_minus_1/2);
   $lean_page = $paged - $half_page_start;
   if($lean_page <= 0) {
     $lean_page = 1;
   }
   $end_page = $paged + $half_page_end;
   if(($end_page - $lean_page) != $pages_to_show_minus_1) {
     $end_page = $lean_page + $pages_to_show_minus_1;
   }
   if($end_page > $max_page) {
     $lean_page = $max_page - $pages_to_show_minus_1;
     $end_page = $max_page;
   }
   if($lean_page <= 0) {
     $lean_page = 1;
   }
   echo $before.'<nav><ul class="pagination">'."";
   if ($paged > 1) {
     $first_page_text = "首页";
     echo '<li class="page-item"><a href="'.get_pagenum_link().'" title="' . __('首页','wpbootstrap') . '" class="page-link">'.$first_page_text.'</a></li>';
   }

   $prevposts = lean_get_previous_posts_link( __('上一页','wpbootstrap') );
   if($prevposts) { echo '<li class="page-item">' . $prevposts  . '</li>'; }
   else { echo '<li class="page-item disabled"><a href="#" class="page-link">' . __('上一页','wpbootstrap') . '</a></li>'; }

   for($i = $lean_page; $i  <= $end_page; $i++) {
     if($i == $paged) {
       echo '<li class="page-item active"><a href="#" class="page-link">'.$i.'</a></li>';
     } else {
       echo '<li class="page-item"><a href="'.get_pagenum_link($i).'" class="page-link">'.$i.'</a></li>';
     }
   }
   echo '<li class="page-item">';
   lean_next_posts_link( __('下一页','wpbootstrap') );
   echo '</li>';
   if ($end_page < $max_page) {
     $last_page_text = "&raquo;";
     echo '<li class="page-item"><a href="'.get_pagenum_link($max_page).'" title="' . __('Last','wpbootstrap') . '" class="page-link">'.$last_page_text.'</a></li>';
   }
   echo '</ul></nav>'.$after."";
 }


 /**
  * Posts pagination
  */
	if (!function_exists( 'upbootwp_content_nav')):
	/**
	 * Display navigation to next/previous pages when applicable
	 */
	function upbootwp_content_nav($nav_id) {
		global $wp_query, $post;

		// Don't print empty markup on single pages if there's nowhere to navigate.
		if ( is_single() ) {
			$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
			$next = get_adjacent_post( false, '', false );

			if ( ! $next && ! $previous )
				return;
		}

		// Don't print empty markup in archives if there's only one page.
		if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
			return;

		$nav_class = ( is_single() ) ? 'post-navigation' : 'paging-navigation';

		?>
		<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>">
			<h4 class="screen-reader-text"><?php _e( 'Post navigation', 'upbootwp' ); ?></h4>

		<?php if ( is_single() ) : // navigation links for single posts ?>

			<div class="row">
				<div class="col-md-4">
					<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'upbootwp' ) . '</span> %title' ); ?>
				</div><!-- .col-md-4 -->
				<div class="col-md-4 col-nav-next">
					<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'upbootwp' ) . '</span>' ); ?>
				</div><!-- .col-md-4 -->
			</div><!-- .row -->

		<?php elseif ($wp_query->max_num_pages > 1 && (is_home() || is_archive() || is_search())) : // navigation links for home, archive, and search pages ?>
			<div class="row">
				<div class="col-md-4">

					<?php if (get_next_posts_link()) : ?>
					<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'upbootwp' ) ); ?></div>
					<?php endif; ?>

				</div><!-- .col-md-4 -->
				<div class="col-md-4 col-nav-next">

					<?php if (get_previous_posts_link()) : ?>
					<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'upbootwp' ) ); ?></div>
					<?php endif; ?>

				</div><!-- .col-md-4 -->
			</div><!-- .row -->

		<?php endif; ?>

		</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
		<?php
	}
	endif; // upbootwp_content_nav


if ( ! function_exists( 'lean_the_posts_navigation' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function lean_the_posts_navigation() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav>
		<ul class="pager">
		<?php if ( get_next_posts_link() ) : ?>
			<li><?php next_posts_link( esc_html__( '下一页', 'start' ) ); ?></li>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<li><?php previous_posts_link( esc_html__( '上一页', 'start' ) ); ?></li>
			<?php endif; ?>
		</ul>
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'lean_the_post_navigation' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function lean_the_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'start' ); ?></h2>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', '%title' );
				next_post_link( '<div class="nav-next">%link</div>', '%title' );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'lean_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function lean_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
		//esc_attr( get_the_modified_date( 'c' ) ),
		//esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( '发表于 %s', 'post date', 'start' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( '%s', 'post author', 'start' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="byline"> ' . $byline . '</span>'. $posted_on . '</span>';

}
endif;

if ( ! function_exists( 'lean_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function lean_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'start' ) );
		if ( $categories_list && lean_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( '发表在 %1$s', 'start' ) . '</span>', $categories_list );
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'start' ) );
		if ( $tags_list ) {
			printf( '&nbsp;<span class="tags-links">' . esc_html__( '标签： %1$s', 'start' ) . '</span>', $tags_list );
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '&nbsp;<span class="comments-link">';
		comments_popup_link( esc_html__( '去评论', 'start' ), esc_html__( '1 条评论', 'start' ), esc_html__( '% 条评论', 'start' ) );
		echo '</span>';
	}

	edit_post_link( esc_html__( '编辑', 'start' ), '<span class="edit-link">', '</span>' );
}
endif;

if ( ! function_exists( 'lean_the_archive_title' ) ) :
/**
 * Shim for `lean_the_archive_title()`.
 *
 * Display the archive title based on the queried object.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function lean_the_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = sprintf( esc_html__( '%s', 'start' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( esc_html__( '标签: %s', 'start' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( esc_html__( '作者: %s', 'start' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( esc_html__( '年: %s', 'start' ), get_the_date( esc_html_x( 'Y', 'yearly archives date format', 'start' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( esc_html__( '月: %s', 'start' ), get_the_date( esc_html_x( 'F Y', 'monthly archives date format', 'start' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( esc_html__( '日: %s', 'start' ), get_the_date( esc_html_x( 'F j, Y', 'daily archives date format', 'start' ) ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = esc_html_x( 'Asides', 'post format archive title', 'start' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = esc_html_x( 'Galleries', 'post format archive title', 'start' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = esc_html_x( 'Images', 'post format archive title', 'start' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = esc_html_x( 'Videos', 'post format archive title', 'start' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = esc_html_x( 'Quotes', 'post format archive title', 'start' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = esc_html_x( 'Links', 'post format archive title', 'start' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = esc_html_x( 'Statuses', 'post format archive title', 'start' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = esc_html_x( 'Audio', 'post format archive title', 'start' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = esc_html_x( 'Chats', 'post format archive title', 'start' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( esc_html__( 'Archives: %s', 'start' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( esc_html__( '%1$s: %2$s', 'start' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = esc_html__( 'Archives', 'start' );
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		echo $before . $title . $after;
	}
}
endif;

if ( ! function_exists( 'lean_the_archive_description' ) ) :
/**
 * Shim for `lean_the_archive_description()`.
 *
 * Display category, tag, or term description.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function lean_the_archive_description( $before = '', $after = '' ) {
	$description = apply_filters( 'get_the_archive_description', term_description() );

	if ( ! empty( $description ) ) {
		/**
		 * Filter the archive description.
		 *
		 * @see term_description()
		 *
		 * @param string $description Archive description to be displayed.
		 */
		echo $before . $description . $after;
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function lean_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'lean_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'lean_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so lean_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so lean_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in lean_categorized_blog.
 */
function lean_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'lean_categories' );
}
add_action( 'edit_category', 'lean_category_transient_flusher' );
add_action( 'save_post',     'lean_category_transient_flusher' );

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
/** function lean_custom_active_item_class($classes = array(), $menu_item = false)
{
    if (in_array('current-menu-item', $menu_item->classes)) {
        $classes[] = 'active';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'lean_custom_active_item_class', 10, 2);**/


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

 <div class="post-thumbnail mb-4">
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

if ( ! function_exists( 'lean_carousel_post_thumbnail' ) ) :
/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 * @since Twenty Fifteen 1.0
 */
function lean_carousel_post_thumbnail() {
 if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
   return;
 }

 if ( is_singular() ) :
 ?>

 <div class="post-thumbnail mb-4">
   <?php
     // Post thumbnail.
     the_post_thumbnail('post-thumbnail', ['class' => 'img-fluid']);
   ?>
 </div><!-- .post-thumbnail -->

 <?php else : ?>

 <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
   <?php
     // Post thumbnail.
     the_post_thumbnail('post-thumbnail', ['class' => 'd-block img-fluid']);
   ?>
 </a>
 <?php endif; // End is_singular()
}
endif;
