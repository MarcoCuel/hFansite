<?php
/*
* Template Name: Listagem
*/

get_header(); ?>

<div class="jumbotron jumbotron-fluid pink">
	<div class="container d-flex align-items-center">
		<h1><?php echo the_title() ?></h1> <a href="<?php echo home_url() ?>/nova-arte" class="btn btn-light ml-4">Nova arte</a>
	</div>
</div>


<section>
	<div class="container">
		<div class="row">
			<?php

				global $current_user; wp_get_current_user();

				$args = array(
					'posts_per_page' => 12,
					'post_type' => 'galeria',
					'order' => 'DESC',
					'author' => $current_user->ID,
				);

				$query = new WP_Query( $args );
			?>

			<?php if (  $query->have_posts() ) : while (  $query->have_posts() ) :  $query->the_post(); ?>
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

<?php get_footer(); ?>
