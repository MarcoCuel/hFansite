<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<?php setPostViews(get_the_ID()); ?>

	<div class="jumbotron jumbotron-fluid purple">
		<div class="container text-center">
			<h1><?php echo the_title() ?></h1>
		</div>
	</div>

	<section>
		<div class="container">
			<div class="reading-content">
				<div class="article-text">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</section>

<?php endwhile;?>
<?php endif; ?>

<?php get_footer(); ?>