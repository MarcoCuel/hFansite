<?php get_header(); ?>

<div class="jumbotron jumbotron-fluid pink text-center">
	<div class="container">
		<h1>Artes destaque</h1>
	</div>
</div>

<section>
	<div class="container">
		<div class="row">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<div class="col-md-4">
					<?php get_template_part( 'template-parts/card-gallery') ?>
				</div>
			<?php endwhile; else: ?>
				<div class="card">
					<div class="card-body text-center text-muted">
						<strong>Nenhuma obra</strong>
					</div>
				</div>
			<?php endif; ?>
		</div>

		<div class="pagination"><?php the_pagination(); ?></div>
	</div>
</section>

<?php get_footer(); ?>