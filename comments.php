<?php
/**
 * Main functions file
 *
 * @package Lambda
 * @subpackage Frontend
 * @since 0.1
 *
 * @copyright (c) 2015 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.50.0
 */

if ( post_password_required() )
    return;
?>
<?php if ( have_comments() ) : ?>
<div class="comments padded" id="comments">
    <div class="comments-head">
        <h3>
            <?php
                printf( _n( '1 条评论', '%s 条评论', get_comments_number(), 'lean' ), number_format_i18n( get_comments_number() ) );
            ?>
        </h3>
        <small>
            <?php //_e( '加入讨论', 'lean' ); ?>
        </small>
    </div>
    <ul class="comments-list comments-body media-list list-unstyled">
        <?php wp_list_comments( array(
            'callback'     => 'lean_comment_callback',
            'end-callback' => 'lean_comment_end_callback',
            'style'        => 'div'
        )); ?>
    </ul>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
    <nav id="comment-nav-below" class="navigation" role="navigation">
        <ul class="pager">
        <li class="previous"><?php previous_comments_link( __( '&larr; Older', 'lean' ) ); ?></li>
        <li class="next"><?php next_comments_link( __( 'Newer &rarr;', 'lean' ) ); ?></li>
        </ul>
    </nav>
    <?php endif; // check for comment navigation ?>

    <?php
    /* If there are no comments and comments are closed, let's leave a note.
     * But we only want the note on posts and pages that had comments in the first place.
     */
    if ( ! comments_open() && get_comments_number() ) : ?>
    <br>
    <h3 class="nocomments text-center"><?php _e( 'Comments are closed.', 'lean' ); ?></h3>
    <?php endif; ?>

</div>
<?php endif; ?>

<?php comment_form(); ?>
