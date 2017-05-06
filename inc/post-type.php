<?php
/**
 *   Carousel
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
 *  首页栏目
 */

if ( ! function_exists( 'lean_post_column' ) ) {

 // Register Custom Taxonomy
 function lean_post_column() {

   $labels = array(
     'name'                       => _x( 'post-column', 'Taxonomy General Name', 'lean' ),
     'singular_name'              => _x( 'post-column', 'Taxonomy Singular Name', 'lean' ),
     'menu_name'                  => __( 'post-column', 'lean' ),
     'all_items'                  => __( 'All Column', 'lean' ),
     'parent_item'                => __( 'Parent Column', 'lean' ),
     'parent_item_colon'          => __( 'Parent Column:', 'lean' ),
     'new_item_name'              => __( 'New Column Name', 'lean' ),
     'add_new_item'               => __( 'Add New Column', 'lean' ),
     'edit_item'                  => __( 'Edit Column', 'lean' ),
     'update_item'                => __( 'Update Column', 'lean' ),
     'view_item'                  => __( 'View Column', 'lean' ),
     'separate_items_with_commas' => __( 'Separate Columns with commas', 'lean' ),
     'add_or_remove_items'        => __( 'Add or remove Columns', 'lean' ),
     'choose_from_most_used'      => __( 'Choose from the most used', 'lean' ),
     'popular_items'              => __( 'Popular Columns', 'lean' ),
     'search_items'               => __( 'Search Items', 'lean' ),
     'not_found'                  => __( 'Not Found', 'lean' ),
     'no_terms'                   => __( 'No items', 'lean' ),
     'items_list'                 => __( 'Items list', 'lean' ),
     'items_list_navigation'      => __( 'Items list navigation', 'lean' ),
   );
   $args = array(
     'labels'                     => $labels,
     'hierarchical'               => true,//创建像 category（true） 还是 tag（false） 的类目
     'public'                     => true,
     'show_ui'                    => true,
     'show_admin_column'          => true,//是否显示后台菜单栏中
     'show_in_nav_menus'          => false,//是否显示在菜单中
     'show_tagcloud'              => false,//是否显示在标签云中
     'rewrite'                    => false,//是否重写url
   );
   register_taxonomy( 'post-column', array( 'post' ), $args ); //关联 哪种 内容类型

 }
 add_action( 'init', 'lean_post_column', 0 );

}

 ?>
