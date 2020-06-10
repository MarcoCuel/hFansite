<?php get_header(); ?>

<div class="jumbotron jumbotron-fluid orange">
	<div class="container d-flex align-items-center">
		<h1><?php esc_html_e( 'Fórum', 'hfansite' ); ?></h1> <a href="<?php echo home_url() ?>/novo-topico" class="btn btn-light ml-4"><?php esc_html_e( 'New topic', 'hfansite' ); ?></a>
	</div>
</div>

<section>
	<div class="container">
		<?php
			$categories = get_terms( 'category_forum' );
			foreach ( $categories as $category ):
			$posts = new WP_Query(
				array(
					'post_type' => 'forum',
					'showposts' => 3,
					'tax_query' => array(
						array(
							'taxonomy'	=> 'category_forum',
							'terms'		=> array( $category->slug ),
							'field'		=> 'slug'
						)
					)
				)
			);
		?>
		<div class="card">
			<div class="card-body p-md-5">
				<div class="row">
					<div class="col-md-4">
						<h3><a href="<?php echo get_term_link($category); ?>" style="color: inherit;"><?php echo $category->name; ?></a></h3>

						<div class="text-muted mb-4 mb-md-0"><?php echo $category->description; ?></div>
					</div>
					<div class="col-md-6 offset-md-2">
						<div class="mb-3 text-muted text-uppercase">
							<small><strong><?php esc_html_e( 'Last topics', 'hfansite' ); ?></strong></small>
						</div>
						<?php while ($posts->have_posts()) : $posts->the_post(); ?>
							<div class="mb-3 topic-<?php the_ID(); ?>">
								<div class="d-flex align-items-center">
									<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" class="user-avatar sm mr-2">
										<?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?>
									</a>
									<div class="w-100 d-md-flex align-items-center">
										<h5 class="card-title mb-0"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
										<small class="text-muted ml-md-2 mt-1"><strong><?php echo get_the_date(); ?></strong></small>
									</div>
								</div>
							</div>
						<?php endwhile; ?>
					</div>
				</div>
			</div>
		</div>
		<?php
		$posts = null;
		wp_reset_postdata();
		endforeach; ?>
	</div>
</section>

<?php get_footer(); ?>