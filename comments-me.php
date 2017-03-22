<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package lean
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="card comments-area">
	<?php // You can lean editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
	<h2 class="card-header comments-title">
		<?php
			printf(
				esc_html( _nx( '&ldquo;%2$s&rdquo;上有 1 条评论', '&ldquo;%2$s&rdquo;上有 %1$s 条评论 ', get_comments_number(), 'comments title', 'lean' ) ),
				number_format_i18n( get_comments_number() ),
				'<span>' . get_the_title() . '</span>'
			);
		?>
	</h2>

	<div class="card-block">


		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'lean' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'lean' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'lean' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>

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


			<?php
				wp_list_comments( array(
					'style'      => 'div',
					'short_ping' => true,
					'callback'     =>  'bootstrapwp_comment'
				) );
			?>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'lean' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'lean' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'lean' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( '评论被关闭.', 'lean' ); ?></p>
	<?php endif; ?>

	<?php
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );

$comment_form_args = array(
    // 添加评论内容的文本域表单元素
  	'comment_field'         => '<label for="comment" class="control-label">' .
          	                    _x( 'Comment', 'noun' ) .
          	                   '</label>
          	                    <textarea id="comment" name="comment" cols="45" rows="5" class="form-control" aria-required="true">
          	                    </textarea>',
    // 评论之前的提示内容
  	'comment_notes_before'  => ' ',
  	// 评论之后的提示内容
  	'comment_notes_after'   => ' ',
  	// 默认的字段，用户未登录时显示的评论字段
  	'fields'                => apply_filters( 'comment_form_default_fields', array(
    // 作者名称字段
		'author'                => '<label for="author" class="control-label">' .  __( '姓名', 'bootstrapwp' ) . '</label> ' .   ( $req ? '<span class="required help-inline">*</span>' : '' ) .
                		            '<div class="controls">' .
                		            '<input id="author"class="form-control" placeholder="author" name="author" type="text" value="' .  esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />'.
                		            '</div>',
    // 电子邮件字段
		'email'                 => '<label for="email" class="control-label">' .    __( 'Email', 'lean' ) .   '</label> ' . ( $req ? '<span class="required help-inline">*</span>' : '' ) .
                		            '<div class="controls">' .
                		            '<input id="email" class="form-control" placeholder="email" name="email" type="text" value="' .
                		             esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />' .
                		             '</div>',
    // 网站地址字段
  	'url'                   => '<label for="url" class="control-label">' .     __( '网站', 'bootstrapwp' ) .  '</label>' .   ( $req ? '<span class="required help-inline">*</span>' : '' ) .
                  		          '<div class="controls">' .
                  		          '<input id="url" class="form-control"  placeholder="网址"authorname="url" type="text" value="' .
                  		           esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></br></div>' )
) );
?>
<?php comment_form( $comment_form_args ); ?>
	</div>
</div><!-- #comments -->
