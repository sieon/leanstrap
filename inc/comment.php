<?php

/**
 * 评论列表的显示
 */
if ( ! function_exists( 'bootstrapwp_comment' ) ) :
function bootstrapwp_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	  // 用不同于其它评论的方式显示 trackbacks 。
	?>
	<div <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'bootstrapwp' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'bootstrapwp' ), '<span class="edit-link">', '</span>' ); ?>
		</p>
	<?php
		break;
		default :
		// 开始正常的评论
		global $post;
	 ?>
	<div <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="media comment">
			<div class="d-flex mr-3">
  			<?php // 显示评论作者头像
  			  echo get_avatar( $comment, 64 );
  			?>
			</div>
			<?php // 未审核的评论显示一行提示文字
			  if ( '0' == $comment->comment_approved ) : ?>
  			<p class="comment-awaiting-moderation">
  			  <?php _e( '你的评论正在审核。', 'bootstrapwp' ); ?>
  			</p>
			<?php endif; ?>
			<div class="media-body">
				<h5 class="mt-0">
  				<?php // 显示评论作者名称
  				    printf( '%1$s %2$s',
  						get_comment_author_link(),
  						// 如果当前文章的作者也是这个评论的作者，那么会出现一个标签提示。
  						( $comment->user_id === $post->post_author ) ? '<span class="label label-info"> ' . __( '博主', 'bootstrapwp' ) . '</span>' : ''
  					);
  				?>
  		    <small>
    				<?php // 显示评论的发布时间
    				    printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
    						esc_url( get_comment_link( $comment->comment_ID ) ),
    						get_comment_time( 'c' ),
    					  // 翻译: 1: 日期, 2: 时间
    						sprintf( __( '%1$s %2$s', 'fenikso' ), get_comment_date(), get_comment_time() )
    					);
    				?>
  				</small>
				</h5>
				<?php // 显示评论内容
				  comment_text();
				?>
				<?php // 显示评论的编辑链接
				  edit_comment_link( __( '编辑', 'lean' ), '<p class="edit-link">', '</p>' );
				?>
				<div class="reply">
					<?php // 显示评论的回复链接
					  comment_reply_link( array_merge( $args, array(
					    'reply_text' =>  __( '回复', 'lean' ),
					    'after'      =>  '',
					    'depth'      =>  $depth,
					    'max_depth'  =>  $args['max_depth'] ) ) );
					?>
				</div>
			</div>
		</article>
	<?php
		break;
	endswitch; // end comment_type check
}
endif;
