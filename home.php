<?php get_header(); ?>

<div class="jumbotron jumbotron-fluid blue">
	<div class="container">
		<h1>Notícias</h1>
	</div>
</div>

<section>
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<h5 class="mb-3">Categorias</h5>
				<div class="tags grey">
					<?php
						$categories = get_categories();
						foreach($categories as $category) {
							echo '<a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a>';
						}
					?>
				</div>

				<h5 class="mt-5 mb-3">Tags</h5>
				<div class="tags">
					<?php the_tags('', ''); ?>
				</div>
			</div>
			<div class="col-md-9">
				<div class="row">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<div class="col-sm-6 col-md-4">
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
		</div>
	</div>
</section>

<?php get_footer(); ?>