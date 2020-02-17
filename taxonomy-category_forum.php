<?php get_header(); ?>

<div class="jumbotron jumbotron-fluid orange">
	<div class="container">
		<h1><a href="<?php echo home_url() ?>/forum">Fórum</a> <span class="angle"><i class="fas fa-chevron-right"></i></span> <?php single_term_title(); ?></h1>
	</div>
</div>

<section>
	<div class="container">
		<div class="row">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<div class="col-md-6">
					<?php get_template_part( 'template-parts/card-topic') ?>
				</div>
			<?php endwhile; else: ?>
				<div class="card">
					<div class="card-body text-center text-muted">
						<strong>Nenhum tópico</strong>
					</div>
				</div>
			<?php endif; ?>
		</div>

		<div class="pagination"><?php the_pagination(); ?></div>
	</div>
</section>

<?php get_footer(); ?>