<?php get_header(); ?>

<div class="jumbotron jumbotron-fluid">
	<div class="container text-center">
		<h1><?php the_title(); ?></h1>
	</div>
</div>

<section>
	<div class="container">
		<div class="row">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<div class="col-sm-6 col-md-4 col-lg-3">
					<?php get_template_part( 'template-parts/card-news') ?>
				</div>
			<?php endwhile; else: ?>
				<div class="card">
					<div class="card-body text-center text-muted">
						<strong>Nenhuma notícia</strong>
					</div>
				</div>
			<?php endif; ?>
		</div>

		<div class="pagination"><?php the_pagination(); ?></div>
	</div>
</section>

<?php get_footer(); ?>