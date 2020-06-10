<?php get_header(); ?>

<div class="jumbotron jumbotron-fluid pink">
	<div class="container d-flex align-items-center">
		<h1><?php esc_html_e( 'Gallery', 'hfansite' ); ?></h1> <a href="<?php echo home_url() ?>/nova-arte" class="btn btn-light ml-4">Nova arte</a>
	</div>
</div>

<section>
	<div class="container">
		<div class="row">
			<div class="col-md-3 pr-md-3 mb-4">
				<h5 class="mb-3"><?php esc_html_e( 'Tags', 'hfansite' ); ?></h5>
				<div class="tags grey">
					<?php
						$categories = get_terms( 'tags_gallery' );

						foreach($categories as $category) {
							echo '<a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a>';
						}
					?>
				</div>

				<h5 class="mb-3 mt-5">Arte destaque</h5>
				<?php
					$args = array(
						'posts_per_page' => 1,
						'post_type' => 'galeria',
						'order' => 'DESC',
						'tax_query' => array(
							array(
								'taxonomy' => 'category_gallery',
								'field' => 'slug',
								'terms' => 'destaque'
							)
						)
					);

					$query = new WP_Query( $args );
				?>

				<?php if (  $query->have_posts() ) : while (  $query->have_posts() ) :  $query->the_post(); ?>
					<?php get_template_part( 'template-parts/card', 'gallery') ?>
				<?php endwhile; else: ?>
					<div class="card">
						<div class="card-body text-center text-muted">
							<strong>Nenhuma arte</strong>
						</div>
					</div>
				<?php endif; ?>
				<?php wp_reset_postdata(); ?>


			</div>
			<div class="col-md-9 pl-md-3">
				<div class="row">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<div class="col-sm-6 col-md-4 mb-4">
							<?php get_template_part( 'template-parts/card-gallery') ?>
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