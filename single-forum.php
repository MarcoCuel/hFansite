<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<?php setPostViews(get_the_ID()); ?>
	
	<section>
		<div class="container">
			<div class="reading-content size-b">
				<div class="mb-4">
					<h2><?php echo the_title() ?></h2>

					<strong><a href="<?php echo home_url() ?>/c/forum/<?php echo $category->slug; ?>" class="text-orange"><?php echo $category->name; ?></strong></a></strong>
				</div>

				<div class="card">
					<div class="card-body">
						<div class="section-topic">
							<div class="side">
								<div class="avatar pixel lg d-md-none">
									<img src="https://www.habbo.com.br/habbo-imaging/avatarimage?&user=<?php echo get_the_author_meta('user_login'); ?>&action=std&direction=2&head_direction=2&img_format=png&gesture=std&headonly=0&size=b" alt="<?php echo $current_user->user_login ?>">
								</div>

								<div class="infos">
									<h5 class="mb-md-3 mb-1"><a class="text-inherit" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" data-toggle="tooltip" title="<?php echo get_the_author_meta('user_login'); ?>"><?php echo get_the_author(); ?></a></h5>

									<div class="avatar pixel xl d-none d-md-block">
										<img src="https://www.habbo.com.br/habbo-imaging/avatarimage?&user=<?php echo get_the_author_meta('user_login'); ?>&action=std&direction=2&head_direction=2&img_format=png&gesture=std&headonly=0&size=l" alt="<?php echo $current_user->user_login ?>">
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
										<?php edit_post_link('Editar', '<span class="mx-1">·</span>', '', ''); ?>
									</div>
								</div>

								<div class="order-1">
									<?php the_content(); ?>
								</div>
							</div>
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