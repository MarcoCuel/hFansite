<?php get_header(); ?>

<?php

$search_string = esc_attr( trim( get_query_var('s') ) );
$wp_user_query = new WP_User_Query( array(
'meta_query' => array(
    'relation' => 'OR',
    array(
        'key'     => 'first_name',
        'value'   => $search_string,
        'compare' => 'LIKE'
    ),
    array(
        'key'     => 'last_name',
        'value'   => $search_string,
        'compare' => 'LIKE'
    )
)
) );

?>

<section>
	<div class="container">
		<div class="reading-content">
			<form action="<?php echo home_url() ?>/" method="get" class="mb-4">
				<input class="form-control alt" type="text" name="s" id="search" value="<?php the_search_query(); ?>" placeholder="Buscar..." />
			</form>

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<div class="card search">
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="thumb">
							<img src="<?php echo get_the_post_thumbnail_url(); ?>">
						</div>
					<?php else: ?>
						<?php if( 'forum' === get_post_type() ): ?>
							<div class="thumb box user pixel">
								<img src="https://www.habbo.com.br/habbo-imaging/avatarimage?&user=<?php echo get_the_author_meta('user_login'); ?>&action=std&direction=2&head_direction=2&img_format=png&gesture=std&size=b" alt="<?php echo get_the_author_meta('user_login'); ?>">
							</div>
						<?php elseif( 'destaque' === get_post_type() ): ?>
							<div class="thumb box user pixel">
								<img src="https://www.habbo.com.br/habbo-imaging/avatarimage?&user=<?php the_title(); ?>&action=std&direction=2&head_direction=2&img_format=png&gesture=std&size=b" alt="<?php the_title(); ?>">
							</div>
						<?php else: ?>
							<div class="thumb box pixel">
								<img src="<?php bloginfo("template_directory")?>/assets/image/box.png">
							</div>
						<?php endif; ?>
					<?php endif; ?>
				
					<div class="w-100">
						<?php if( 'post' === get_post_type() ): ?>
							<div class="mb-1"><a href="#"><strong><?php foreach((get_the_category()) as $category) { echo $category->cat_name . ' '; } ?></strong></a></div>
						<?php endif; ?>

						<h5 class="card-title mb-1"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
						<div class="card-text mb-1">
							<?php if ( has_excerpt() ): ?>
								<?php echo the_excerpt(); ?>
							<?php else: ?>
								<?php $content = wp_strip_all_tags( get_the_content() ); echo mb_strimwidth($content, 0, 150, '...');?>
							<?php endif; ?>
						</div>

						<?php if( 'post' === get_post_type() ): ?>
							<time class="text-muted"><?php echo get_the_date(); ?></time>
						<?php elseif( 'evento' === get_post_type() ): ?>
							<time class="text-muted"><?php echo get_the_date(); ?></time>
						<?php elseif( 'forum' === get_post_type() ): ?>
							<time class="text-muted"><?php echo get_the_date(); ?></time>
						<?php elseif( 'galeria' === get_post_type() ): ?>
							<time class="text-muted"><?php echo get_the_date(); ?></time>
						<?php endif; ?>
					</div>
				</div>
			<?php endwhile?>
			<?php else: ?>
				<div class="text-center" style="padding: 5rem 0">
					<h2>Nenhum resultado encontrado.</h2>
					<p class="text-muted">Sua busca por "<strong><?php the_search_query(); ?></strong>" não retornou resultados.<br>
					Tente novamente ou desista.</p>
				</div>
			<?php endif; ?>

			<div class="pagination"><?php the_pagination(); ?></div>
		</div>
	</div>
</section>

<?php get_footer(); ?>