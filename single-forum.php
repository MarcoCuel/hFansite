<?php get_header(); ?>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php setPostViews(get_the_ID()); ?>
		
		<section>
			<div class="container">
				<div class="reading-content size-b">
					<div class="mb-4">
						<h2><?php echo the_title() ?></h2>
						<?php $category = get_the_terms( $post->ID, 'category_forum' ); ?>
						<strong><a href="<?php echo home_url() ?>/c/forum/<?php echo $category[0]->slug; ?>" class="text-orange"><?php echo $category[0]->name; ?></strong></a></strong>
					</div>

					<div class="card">
						<div class="card-body">
							<div class="section-topic">
								<div class="side">
									<div class="user-avatar lg d-md-none">
										<?php echo get_avatar( get_the_author_meta( 'ID' ), 56 ); ?>
									</div>

									<div class="infos">
										<h5 class="mb-md-3 mb-1"><a class="text-inherit" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" data-toggle="tooltip" title="<?php echo get_the_author_meta('user_login'); ?>"><?php echo get_the_author(); ?></a></h5>

										<div class="user-avatar xl d-none d-md-block">
											<?php echo get_avatar( get_the_author_meta( 'ID' ), 128 ); ?>
										</div>

										<?php get_template_part( 'template-parts/ranking-forum') ?>
									</div>
								</div>

								<div class="content">
									<div class="infos">
										<div class="mr-auto d-flex align-items-center">
											<?php echo get_simple_likes_button( get_the_ID() ); ?>
											<span class="mx-2">·</span>
											<?php echo get_the_date(); ?>
										</div>

										<div>
											<?php echo getPostViews(get_the_ID()); ?>

											<?php global $current_user; wp_get_current_user();
											$author_id = get_the_author_meta('ID');
											$current_id = $current_user->ID;
											$is_editor = current_user_can('editor') || current_user_can('administrator');

											if ((is_user_logged_in() && $author_id === $current_id) || $is_editor) { ?>
												<span class="mx-1">·</span> <a class="text-primary text-link" data-toggle="modal" data-target="#editModal">Editar</a>
											<?php } ?>
										</div>
									</div>

									<div class="order-1">
										<?php the_content(); ?>
									</div>
								</div>

								<?php
									if ((is_user_logged_in() && $author_id === $current_id) || $is_editor) {
										get_template_part( 'templates/edit-post');
									}
								?>
							</div>
						</div>
					</div>
						
					<div class="comments-forum">
						<?php comments_template('/comments-forum.php'); ?>
					</div>
				</div>
			</div>
		</section>
	<?php endwhile; endif; ?>

<?php get_footer(); ?>