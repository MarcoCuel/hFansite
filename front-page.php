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
				<div class="sidebar">
					<?php dynamic_sidebar( 'sidebar_top' ); ?>
				</div>
			</div>
			<div class="col-md-9 pl-md-3">
				<div>
					<?php dynamic_sidebar( 'content_top' ); ?>
				</div>
			</div>
		</div>
	</div>
</section>

<section>
	<div class="container">
		<div class="row">
			<div class="col-lg-9 pr-lg-3">
				<div>
					<?php dynamic_sidebar( 'content_middle' ); ?>
				</div>
			</div>

			<div class="col-lg-3 pl-lg-3">
				<div class="sidebar">
					<?php dynamic_sidebar( 'sidebar_middle' ); ?>
				</div>

				<div class="section-title mt-4">
					<h3>Novos usuários</h3>
				</div>

				<?php

				?>

				<div class="card">
					<div class="card-body last-users">
						<div class="row">
							<?php
								$usernames = $wpdb->get_results("SELECT user_login, user_url FROM $wpdb->users ORDER BY ID DESC LIMIT 6");
								 
								foreach ($usernames as $username) { ?>
									<div class="col">
										<div class="avatar pixel mx-auto" data-toggle="tooltip" title="<?php echo $username->user_login ?>">
											<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), $username->user_login ); ?>"><img src="https://www.habbo.com.br/habbo-imaging/avatarimage?&user=<?php echo $username->user_login ?>&action=std&direction=2&head_direction=3&img_format=png&gesture=std&headonly=0&size=s" alt="<?php echo $username->user_login ?>"></a>
										</div>
									</div>
								<?php }
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section>
	<div class="container">
		<div>
			<?php dynamic_sidebar( 'sidebar_down' ); ?>
		</div>
	</div>
</section>

<section>
	<div class="container pt-3">
		<div class="row">
			<div class="col-sm-6 col-lg-4">
				<div class="section-title">
					<h3>Ranking de comentários</h3>
				</div>

				<?php get_template_part( 'template-parts/ranking') ?>
			</div>
			<div class="col-sm-6 col-lg-4">
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
			<div class="col-sm-6 col-lg-4">
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