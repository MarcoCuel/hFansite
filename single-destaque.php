<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<?php setPostViews(get_the_ID()); ?>

	<div class="jumbotron jumbotron-fluid purple">
		<div class="container text-center">
			<h5 class="mb-4">Usuário destaque</h5>

			<div class="d-flex justify-content-center align-items-center">
				<div class="avatar pixel lg mr-2">
					<a href="<?php echo get_author_posts_url('', $name); ?>"><img src="https://www.habbo.com.br/habbo-imaging/avatarimage?&user=<?php echo $name; ?>&action=std&direction=2&head_direction=2&img_format=png&gesture=std&headonly=0&size=b" alt="<?php the_title(); ?>"></a>
				</div>
				<h2 class="mb-0 mt-2"><?php echo the_title() ?></h2>
			</div>
		</div>
	</div>

	<section>
		<div class="container">
			<div class="reading-content">
				<div class="article-text text-center">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</section>

<?php endwhile;?>
<?php endif; ?>

<?php get_footer(); ?>