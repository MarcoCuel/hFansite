<?php
// My custom comments output html
function better_comments_forum( $comment, $args, $depth ) {

	// Get correct tag used for the comments
	if ( 'div' === $args['style'] ) {
		$tag       = 'div';
		$add_below = 'comment';
	} else {
		$tag       = 'li';
		$add_below = 'div-comment';
	} ?>

	<<?php echo $tag; ?> id="comment-<?php comment_ID() ?>">

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
			<div class="card">
				<div class="card-body">
					<div id="div-comment-<?php comment_ID() ?>" class="section-topic">
					<?php } ?>
						<div class="side">
							<?php
								$comment_id = $commentID;
								$comment = get_comment( $comment_id );
								$comment_author_id = $comment -> user_id;

								$avatar = get_the_author_meta('user_login', $comment_author_id);
								$display_name = get_the_author_meta('display_name', $comment_author_id);
							?>
								
							<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), $avatar ); ?>">
								<div class="user-avatar lg d-md-none">
									<?php echo get_avatar( $comment, 56 ); ?>
								</div>
							</a>

							<div class="infos">

								<h5 class="mb-md-3 mb-1" data-toggle="tooltip" title="<?php echo $avatar ?>"><a class="text-inherit author-name" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), $avatar ); ?>"><?php echo $display_name; ?></a></h5>

								<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), $avatar ); ?>">
									<div class="user-avatar xl d-none d-md-block">
										<?php echo get_avatar( $comment, 128 ); ?>
									</div>
								</a>

								<?php get_template_part( 'template-parts/ranking-forum-comment') ?>
							</div>
						</div>

						<div class="content">
							<div class="infos">
								<div class="mr-auto d-flex align-items-center">
									<?php echo get_simple_likes_button( get_comment_ID(), 1 ); ?>

									<span class="mx-2">·</span>

									<?php
									printf(
										__( '%1$s' ),
										get_comment_date()
									); ?>
								</div>

								<div> 
									<?php edit_comment_link( '<i class="fas fa-pen" data-toggle="tooltip" title="Editar"></i>', '', '<span class="mx-2">·</span>' ); ?>

									<a href="#comment" class="text-inherit quote-link" data-toggle="tooltip" title="Citar"><i class="fas fa-quote-right" ></i></a> <span class="mx-2">·</span>

									<a class="text-inherit" href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">#<?php comment_ID() ?></a>
								</div>
							</div>

							<div class="comment-txt order-1">
								<?php comment_text(); ?>
							</div>
						</div>
		<?php
		if ( 'div' != $args['style'] ) { ?>
					</div>
				</div>
			</div>
		<?php }
	// IMPORTANT: Note that we do NOT close the opening tag, WordPress does this for us
		break;
	endswitch; // End comment_type check.
}