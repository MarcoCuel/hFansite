<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<?php setPostViews(get_the_ID()); ?>
	
	<section>
		<div class="container">
			<div class="reading-content">
				<div class="mb-4">
					<h2><?php echo the_title() ?></h2>

					<strong><a href="<?php echo home_url() ?>/c/forum/<?php echo $category->slug; ?>" class="text-orange"><?php echo $category->name; ?></strong></a></strong>
				</div>

				<div class="section-topic">
					<div class="side">
						<div class="avatar pixel lg">
							<img src="https://www.habbo.com.br/habbo-imaging/avatarimage?&user=<?php echo get_the_author_meta('user_login'); ?>&action=std&direction=2&head_direction=2&img_format=png&gesture=std&headonly=0&size=b" alt="<?php echo $current_user->user_login ?>">
						</div>
					</div>

					<div class="content">
						<div class="card">
							<div class="card-body">
								<div class="d-flex justify-content-between align-items-center mb-3">

									<h5 class="mb-0"><a class="text-inherit" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" data-toggle="tooltip" title="<?php echo get_the_author_meta('user_login'); ?>"><?php echo get_the_author(); ?></a></h5>

									<div class="text-muted mr-auto ml-2">
										<?php echo get_the_date(); ?>
									</div>

									<?php edit_post_link('Editar', '<div class="ml-auto">', '</div>', ''); ?>
								</div>

								<div>
									<?php the_content(); ?>
								</div>

								<hr>

								<div class="text-muted d-flex align-items-center">
									<div class="mr-auto"><?php echo get_simple_likes_button( get_the_ID() ); ?></div>
									<?php echo getPostViews(get_the_ID()); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
					
				<div class="comments-forum">
					<?php comments_template(); ?>
				</div>
			</div>
		</div>
	</section>
<?php endwhile; endif; ?>

<?php get_footer(); ?>