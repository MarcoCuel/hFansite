<?php get_header(); ?>

<div class="jumbotron jumbotron-fluid hero">
	<div class="container">
		<h1 class="my-3"><?php echo bloginfo('name'); ?></h1>
	</div>
</div>

<section>
	<div class="container">
		<div class="row">
			<div class="col-md-3 pr-md-3">

				<div class="section-title">
					<h3>Publicidade</h3>
				</div>

				<?php
					$args = array(
						'post_type' => 'publicidade',
						'order' => 'DESC',
					);
					$count = 0;
					$query = new WP_Query( $args );
				?>
				<?php if ( $query->have_posts() ) : ?>
					<div class="card">
						<div id="carouselAds" class="carousel ads slide" data-ride="carousel">
							<ol class="carousel-indicators">
								<?php while ( $query->have_posts() ) : $query->the_post(); ?>
									<li data-target="#carouselAds" data-slide-to="<?php echo ($count)?>" class="<?php echo ($count == 0) ? 'active' : ''; ?>"></li>
								<?php $count++; ?>
								<?php endwhile; ?>
							</ol>
							<div class="carousel-inner">
								<?php $count = 0; ?>
								<?php while ( $query->have_posts() ) : $query->the_post(); ?>
									<div class="carousel-item <?php echo ($count == 0) ? 'active' : ''; ?>">
										<img src="<?php echo the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
										<div class="carousel-caption">
											<h5><?php the_title(); ?></h5>
											<div><?php the_content(); ?></div>
										</div>
									</div>
								<?php $count++; ?>
								<?php endwhile; ?>
							</div>
						</div>
					</div>
				<?php else: ?>
					<div class="card">
						<div class="card-body text-center text-muted">
							<strong>Nenhuma publicidade</strong>
						</div>
					</div>
				<?php endif; ?>
				<?php wp_reset_postdata(); ?>

				<div class="section-title mt-4">
					<h3>Parceiros</h3>
					<strong><a href="<?php echo home_url() ?>#">Saiba mais</a></strong>
				</div>

				<div class="card">
					<div class="card-body text-muted pixel d-flex justify-content-center align-items-center">

						<?php
							$args = array(
								'post_type' => 'parceiro',
								'order' => 'DESC',
							);

							$query = new WP_Query( $args );
						?>

						<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
							<div class="px-2" data-toggle="tooltip" title="<?php the_title(); ?>">
								<img src="<?php echo the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
							</div>
						<?php endwhile; else: ?>
							<strong>Nenhum ainda</strong>
						<?php endif; ?>
						<?php wp_reset_postdata(); ?>
					</div>
				</div>
			</div>
			<div class="col-md-9 pl-md-3">
				<div class="section-title">
					<h3>Notícias</h3>
					<strong><a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">Ver tudo</a></strong>
				</div>

				<div class="row">
					<?php
						$args = array(
							'posts_per_page' => 6,
							'post_type' => 'post',
							'order' => 'DESC',
						);

						$query = new WP_Query( $args );
					?>

					<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
						<div class="col-sm-6 col-lg-4">
							<?php get_template_part( 'template-parts/card', 'news') ?>
						</div>
					<?php endwhile; else: ?>
						<div class="card">
							<div class="card-body text-center text-muted">
								<strong>Nenhuma notícia</strong>
							</div>
						</div>
					<?php endif; ?>
					<?php wp_reset_postdata(); ?>
				</div>
			</div>
		</div>
	</div>
</section>

<section>
	<div class="container">
		<div class="row">
			<div class="col-lg-9 pr-lg-3">
				<div class="section-title">
					<h3>Fórum</h3>
					<strong><a href="<?php echo home_url() ?>/forum">Ver tudo</a></strong>
				</div>

				<div class="row">
					<?php
						$args = array(
							'posts_per_page' => 8,
							'post_type' => 'forum',
							'order' => 'DESC',
						);

						$query = new WP_Query( $args );
					?>

					<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
						<div class="col-sm-6">
							<?php get_template_part( 'template-parts/card', 'topic') ?>
						</div>
					<?php endwhile; else: ?>
						<div class="card">
							<div class="card-body text-center text-muted">
								<strong>Nenhum tópico</strong>
							</div>
						</div>
					<?php endif; ?>
					<?php wp_reset_postdata(); ?>
				</div>

				<div class="section-title mt-4">
					<h3>Coisas grátis</h3>
					<strong><a href="<?php echo home_url() ?>/categorias/coisas-gratis">Ver tudo</a></strong>
				</div>

				<div class="row">
					<?php
						$args = array(
							'posts_per_page' => 6,
							'category_name' => 'coisas-gratis',
							'post_type' => 'post',
							'order' => 'DESC',
						);

						$query = new WP_Query( $args );
					?>

					<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
						<div class="col-4 col-sm-3 col-lg-2">
							<?php get_template_part( 'template-parts/card', 'free') ?>
						</div>
					<?php endwhile; else: ?>
						<div class="card">
							<div class="card-body text-center text-muted">
								<strong>Nada ainda</strong>
							</div>
						</div>
					<?php endif; ?>
					<?php wp_reset_postdata(); ?>
				</div>
			</div>

			<div class="col-lg-3 pl-lg-3">
				<div class="section-title">
					<h3>Eventos</h3>
					<strong><a href="<?php echo home_url() ?>/evento">Ver tudo</a></strong>
				</div>

				<div class="row">
					<?php
						$args = array(
							'posts_per_page' => 4,
							'post_type' => 'evento',
							'order' => 'DESC',
						);

						$query = new WP_Query( $args );
					?>

					<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
						<div class="col-sm-6 col-md-4 col-lg-12">
							<?php get_template_part( 'template-parts/card', 'event') ?>
						</div>
					<?php endwhile; else: ?>
						<div class="col-12">
							<div class="card">
								<div class="card-body text-center text-muted">
									<strong>Nenhum evento</strong>
								</div>
							</div>
						</div>
					<?php endif; ?>
					<?php wp_reset_postdata(); ?>
				</div>

				<div class="section-title mt-4">
					<h3>Parceiros</h3>
					<strong><a href="<?php echo home_url() ?>#">Saiba mais</a></strong>
				</div>

				<div class="card">
					<div class="card-body text-muted pixel d-flex justify-content-center align-items-center">

						<?php
							$args = array(
								'post_type' => 'parceiro',
								'order' => 'DESC',
							);

							$query = new WP_Query( $args );
						?>

						<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
							<div class="p-2" data-toggle="tooltip" title="<?php the_title(); ?>">
								<img src="<?php echo the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
							</div>
						<?php endwhile; else: ?>
							<strong>Nenhum ainda</strong>
						<?php endif; ?>
						<?php wp_reset_postdata(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section>
	<div class="container">
		<div class="section-title">
			<h3>Galeria</h3>
			<strong><a href="<?php echo home_url() ?>/galeria">Ver tudo</a></strong>
		</div>


		<div class="row">
			<?php
				$args = array(
					'posts_per_page' => 4,
					'post_type' => 'galeria',
					'order' => 'DESC',
				);

				$query = new WP_Query( $args );
			?>

			<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class="col-sm-6 col-md-4 col-lg-3">
					<?php get_template_part( 'template-parts/card', 'gallery') ?>
				</div>
			<?php endwhile; else: ?>
				<div class="card">
					<div class="card-body text-center text-muted">
						<strong>Nenhuma arte</strong>
					</div>
				</div>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
		</div>
	</div>
</section>

<section>
	<div class="container pt-3">
		<div class="row">
			<div class="col-sm-6 col-lg-4 pr-md-3">
				<div class="section-title">
					<h3>Ranking de comentários</h3>
				</div>

				<?php get_template_part( 'template-parts/ranking') ?>

			</div>
			<div class="col-sm-6 col-lg-4 px-md-3">
				<div class="section-title">
					<h3>Usuários destaque</h3>
				</div>

				<div class="list">
					<?php
						$args = array(
							'posts_per_page' => 2,
							'post_type' => 'destaque',
							'order' => 'DESC',
						);

						$query = new WP_Query( $args );
					?>

					<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
						<?php get_template_part( 'template-parts/card', 'featured') ?>
					<?php endwhile; else: ?>
						<div class="card">
							<div class="card-body text-center text-muted">
								<strong>Nada ainda</strong>
							</div>
						</div>
					<?php endif; ?>
					<?php wp_reset_postdata(); ?>
				</div>
			</div>
			<div class="col-sm-6 col-lg-4 px-md-3">
				<div class="section-title">
					<h3>Arte destaque</h3>
					<strong><a href="<?php echo home_url() ?>/c/galeria/destaque">Ver todas</a></strong>
				</div>
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

				<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
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
		</div>
	</div>
</section>

<?php get_footer(); ?>