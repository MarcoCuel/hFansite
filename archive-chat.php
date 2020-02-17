<?php get_header(); ?>

<div class="jumbotron jumbotron-fluid purple">
	<div class="container text-center">
		<h1>Chats</h1>
	</div>
</div>

<section>
	<div class="container">
		<div class="row">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<div class="col-sm-6 col-md-3">
					<div class="card">
						<div class="card-body text-center">
							<h4 class="mb-0"><a href="<?php echo the_permalink(); ?>"><?php echo the_title(); ?></a></h4>
						</div>
					</div>
				</div>
			<?php endwhile; else: ?>
				<div class="card">
					<div class="card-body text-center text-muted">
						<strong>Nenhum chat</strong>
					</div>
				</div>
			<?php endif; ?>
		</div>

		<div class="pagination"><?php the_pagination(); ?></div>
	</div>
</section>

<?php get_footer(); ?>