<?php get_header(); ?>

<div class="jumbotron jumbotron-fluid red">
	<div class="container">
		<h1><a href="<?php echo home_url() ?>/evento">Eventos</a> <span class="angle"><i class="fas fa-chevron-right"></i></span> <?php single_term_title(); ?></h1>
	</div>
</div>

<section>
	<div class="container">
		<div class="row">
			<div class="col-md-3 pr-md-3 mb-4">
				<h5>Tags</h5>
				<div class="tags grey mt-3">
					<?php
						$categories = get_terms([
							'taxonomy' => 'tags_event',
							'hide_empty' => false,
						]);
						foreach($categories as $category) {
							echo '<a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a>';
						}
					?>
				</div>

			</div>
			<div class="col-md-9 pl-md-3">
				<div class="row">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<div class="col-sm-6">
							<?php get_template_part( 'template-parts/card-event') ?>
						</div>
					<?php endwhile; else: ?>
						<div class="card">
							<div class="card-body text-center text-muted">
								<strong>Nenhum evento</strong>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="pagination"><?php the_pagination(); ?></div>
	</div>
</section>

<?php get_footer(); ?>