<?php get_header(); ?>

<div class="jumbotron jumbotron-fluid <?php if ( has_post_thumbnail() ) : ?>cover<?php endif; ?>">
	<?php if ( has_post_thumbnail() ) : ?>
		<img src="<?php echo the_post_thumbnail_url(); ?>" class="full">
	<?php endif; ?>
	<div class="container">
		<h1><?php echo the_title() ?></h1>
	</div>
</div>

<section>
	<div class="container">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; else: ?>
			nada aqui
		<?php endif; ?>
	</div>
</section>

<?php get_footer(); ?>