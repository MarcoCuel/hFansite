<?php get_header(); ?>

<div class="jumbotron jumbotron-fluid orange">
	<div class="container">
		<h1><?php single_term_title(); ?></h1>
	</div>
</div>

<section>
	<div class="container">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div class="card">
				<div class="card-body text-center text-muted">
					<?php echo the_content() ?>
				</div>
			</div>
		<?php endwhile; else: ?>
			<div class="card">
				<div class="card-body text-center text-muted">
					<strong>Nada aqui</strong>
				</div>
			</div>
		<?php endif; ?>

		<div class="pagination"><?php the_pagination(); ?></div>
	</div>
</section>

<?php get_footer(); ?>