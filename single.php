<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<?php setPostViews(get_the_ID()); ?>

	<div class="jumbotron jumbotron-fluid news cover">
		<?php if ( has_post_thumbnail() ) : ?>
			<img src="<?php echo the_post_thumbnail_url(); ?>" class="full">
		<?php else : ?>
			<img src="<?php bloginfo('template_directory'); ?>/assets/image/default-cover.png" class="full" alt="<?php the_title(); ?>" />
		<?php endif; ?>

		<div class="container text-center">

			<?php the_category(); ?>

			<h1><?php echo the_title() ?></h1>

			<div class="infos">
				<div class="mx-3 mt-3">
					<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" class="d-flex align-items-center">
						<div class="avatar pixel sm mr-2">
							<img src="https://www.habbo.com.br/habbo-imaging/avatarimage?&user=<?php echo the_author_meta( 'user_login'); ?>&action=std&direction=2&head_direction=2&img_format=png&gesture=std&headonly=0&size=s" alt="<?php echo $current_user->user_login ?>">
						</div>

						<span data-toggle="tooltip" title="<?php echo get_the_author_meta('user_login'); ?>"><?php echo get_the_author(); ?></span>
					</a>
				</div>

				<div class="mx-3 mt-3">
					<i class="fas fa-calendar mr-2"></i>
					<?php echo get_the_date(); ?>
				</div>

				<div class="mx-3 mt-3">
					<a href="#comments"><i class="fas fa-comment-alt mr-2"></i>
					<?php echo get_comments_number_text(); ?></a>
				</div>

				<?php edit_post_link('Editar', '<div class="mx-3 mt-3"><i class="fas fa-pen mr-2"></i> ', '</div>', '', 'text-inherit'); ?>
			</div>
		</div>
	</div>

	<section>
		<div class="container">
			<div class="reading-content">
				<div class="article-text">
					<?php the_content(); ?>
				</div>
				<div class="d-flex align-items-center mt-4">
					<div class="tags">
						<?php the_tags('<i class="fas fa-tag"></i>', ''); ?>
					</div>
					<div class="d-flex align-items-center text-muted ml-auto">
						<?php echo get_simple_likes_button( get_the_ID() ); ?> <span class="ml-1">curtidas</span>
				

						<i class="fas fa-eye fa-fw mr-2 ml-4"></i> <?php echo getPostViews(get_the_ID()); ?>
					</div>
				</div>
			</div>
			<div class="reading-content size-b my-4">
				<?php get_template_part( 'template-parts/related') ?>
			</div>
			<div class="reading-content">
				<?php comments_template(); ?>
			</div>
		</div>
	</section>

<?php endwhile;?>
<?php endif; ?>

<?php get_footer(); ?>