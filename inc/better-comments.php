<?php
// My custom comments output html
function better_comments( $comment, $args, $depth ) {

	// Get correct tag used for the comments
	if ( 'div' === $args['style'] ) {
		$tag       = 'div';
		$add_below = 'comment';
	} else {
		$tag       = 'li';
		$add_below = 'div-comment';
	} ?>

	<<?php echo $tag; ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID() ?>">

	<?php
	// Switch between different comment types
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' : ?>
		<div class="pingback-entry"><span class="pingback-heading"><?php esc_html_e( 'Pingback:' ); ?></span> <?php comment_author_link(); ?></div>
	<?php
		break;
		default :

		if ( 'div' != $args['style'] ) { ?>
			<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
		<?php } ?>
			<div class="comment-author">

				<?php
					$comment_id = $commentID;
					$comment = get_comment( $comment_id );
					$comment_author_id = $comment -> user_id;

					$avatar = get_the_author_meta('user_login', $comment_author_id);
					$display_name = get_the_author_meta('display_name', $comment_author_id);
				?>
					
				<?php if( '0' == $comment->comment_parent ): ?>
					<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), $avatar ); ?>">
						<div class="avatar pixel lg">
							<img src="https://www.habbo.com.br/habbo-imaging/avatarimage?&user=<?php echo $avatar ?>&action=std&direction=2&head_direction=2&img_format=png&gesture=std&headonly=0&size=b" alt="<?php echo $current_user->user_login ?>">
						</div>
					</a>
				<? else: ?>
					<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), $avatar ); ?>">
						<div class="avatar pixel">
							<img src="https://www.habbo.com.br/habbo-imaging/avatarimage?&user=<?php echo $avatar ?>&action=std&direction=2&head_direction=2&img_format=png&gesture=std&headonly=0&size=s" alt="<?php echo $current_user->user_login ?>">
						</div>
					</a>
				<?php endif; ?>
			</div><!-- .comment-author -->
			<div class="comment-details">
				<div class="comment-meta commentmetadata">
					<div class="author" data-toggle="tooltip" title="<?php echo $avatar; ?>"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), $avatar ); ?>"><?php echo $display_name; ?></a></div>

					<?php
						global $post;
						if ( $comment->user_id === $post->post_author ) { echo '<span class="badge badge-primary ml-2 mr-auto">Autor</span>'; }
					?>

					<?php
				edit_comment_link( __( 'Edit' ), '  ', '' ); ?>
				</div><!-- .comment-meta -->
				<div class="comment-text"><?php comment_text(); ?></div><!-- .comment-text -->
				<?php
				// Display comment moderation text
				if ( $comment->comment_approved == '0' ) { ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em><br/><?php
				} ?>
				<div class="reply">
				<div><?php echo get_simple_likes_button( get_comment_ID(), 1 ); ?></div> <span class="mx-2">·</span> 
				<?php
				// Display comment reply link
				comment_reply_link( array_merge( $args, array(
					'add_below' => $add_below,
					'depth'     => $depth,
					'max_depth' => $args['max_depth']
				) ) ); ?>

				<?php if( '0' == $comment->comment_parent ): ?>
					<span class="mx-2">·</span> 
				<?php endif; ?>

				<a class="time" href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"><?php
					printf(
						__( '%1$s' ),
						get_comment_date()
					); ?>
				</a>
				</div>
			</div><!-- .comment-details -->
	<?php
		if ( 'div' != $args['style'] ) { ?>
			</div>
		<?php }
	// IMPORTANT: Note that we do NOT close the opening tag, WordPress does this for us
		break;
	endswitch; // End comment_type check.
}