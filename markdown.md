WP Query

源文件: wp-includes/class-wp-query.php

Loop

### 标准 Loop
```
<?php

// The Query
$the_query = new WP_Query( $args );

// The Loop
if ( $the_query->have_posts() ) {
    echo '<ul>';
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
        echo '<li>' . get_the_title() . '</li>';
    }
    echo '</ul>';
} else {
    // no posts found
}
/* Restore original Post Data */
wp_reset_postdata();
```

### Standard Loop (Alternate)

```
<?php
// the query
$the_query = new WP_Query( $args ); ?>

<?php if ( $the_query->have_posts() ) : ?>

    <!-- pagination here -->

    <!-- the loop -->
    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
        <h2><?php the_title(); ?></h2>
    <?php endwhile; ?>
    <!-- end of the loop -->

    <!-- pagination here -->

    <?php wp_reset_postdata(); ?>

<?php else : ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>
```

### 多个 Loop

```
<?php

// The Query
$query1 = new WP_Query( $args );

// The Loop
while ( $query1->have_posts() ) {
    $query1->the_post();
    echo '<li>' . get_the_title() . '</li>';
}

/* Restore original Post Data
 * NB: Because we are using new WP_Query we aren't stomping on the
 * original $wp_query and it does not need to be reset with
 * wp_reset_query(). We just need to set the post data back up with
 * wp_reset_postdata().
 */
wp_reset_postdata();


/* The 2nd Query (without global var) */
$query2 = new WP_Query( $args2 );

// The 2nd Loop
while ( $query2->have_posts() ) {
    $query2->the_post();
    echo '<li>' . get_the_title( $query2->post->ID ) . '</li>';
}

// Restore original Post Data
wp_reset_postdata();

?>
```
Methods and Properties

#### Properties 属性

- `$query`

    WP 类的全局属性

- `$query_vars`

    An associative array containing the dissected $query: an array of the query variables and their respective values.

- `$queried_object`

    Applicable if the request is a category, author, permalink or Page. Holds information on the requested category, author, post or Page.

- `$queried_object_id`

    If the request is a category, author, permalink or post / page, holds the corresponding ID.

- `$posts`

    Gets filled with the requested posts from the database.

- `$post_count`

    The number of posts being displayed.

- `$found_posts`

    The total number of posts found matching the current query parameters

- `$max_num_pages`

    The total number of pages. Is the result of $found_posts / $posts_per_page

- `$current_post`

    (available during The Loop) Index of the post currently being displayed.

- `$post`

    (available during The Loop) The post currently being displayed.

- `$is_single, $is_page, $is_archive, $is_preview, $is_date, $is_year, $is_month, $is_time, $is_author, $is_category, $is_tag, $is_tax, $is_search, $is_feed, $is_comment_feed, $is_trackback, $is_home, $is_404, $is_comments_popup, $is_admin, $is_attachment, $is_singular, $is_robots, $is_posts_page, $is_paged`

    Booleans dictating what type of request this is. For example, the first three represent ‘is it a permalink?’, ‘is it a Page?’, ‘is it any type of archive page?’, respectively.
