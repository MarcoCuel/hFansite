<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<?php setPostViews(get_the_ID()); ?>

	<div class="jumbotron jumbotron-fluid cover event">
		<img src="<?php echo the_post_thumbnail_url(); ?>" class="full">

		<div class="date">
			<?php
				$event_date = get_post_meta( get_the_ID(), 'event_date', true );
				$event_time = get_post_meta( get_the_ID(), 'event_time', true );
				$event_time_end = get_post_meta( get_the_ID(), 'event_time_end', true );

				setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
				date_default_timezone_set('America/Sao_Paulo');

				$time = strtotime($event_date.' '.$event_time);

				$end_time = strtotime($event_date.' '.$event_time_end);

				echo '<div class="month">' . strftime('%h', $time) . '</div>';
				echo '<div class="day">' . strftime('%d', $time) . '</div>';
			?>
		</div>

		<div class="container text-center">

			<h1><?php echo the_title() ?></h1>

			<div class="infos">
				<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" class="d-flex align-items-center">
					<div class="avatar pixel sm mr-2">
						<img src="https://www.habbo.com.br/habbo-imaging/avatarimage?&user=<?php echo the_author_meta( 'user_login'); ?>&action=std&direction=2&head_direction=2&img_format=png&gesture=std&headonly=0&size=s" alt="<?php echo $current_user->user_login ?>">
					</div>

					<span data-toggle="tooltip" title="<?php echo get_the_author_meta('user_login'); ?>"><?php echo get_the_author(); ?></span>
				</a>

				<div class="mx-4">
					<i class="fas fa-calendar mr-2"></i>
					<?php echo get_the_date(); ?>
				</div>

				<div>
					<i class="fas fa-comment-alt mr-2"></i>
					2 Comentários
				</div>

			</div>
		</div>
	</div>

	<section>
		<div class="container">
			<div class="reading-content">
				<div class="article-text">
					<?php the_content(); ?>
				</div>

				<div class="tags">
					<?php echo get_the_term_list( $post->ID, 'tags_event', '<i class="fas fa-tag"></i>', ', ' ); ?>
				</div>
			</div>
			<div class="reading-content size-b my-4">
				<div class="row">
					<?php
						$args = array(
							'posts_per_page' => 3,
							'post_type' => 'evento',
							'post__not_in' => array($post->ID),
							'order' => 'DESC',
						);

						$query = new WP_Query( $args );
					?>

					<?php if (  $query->have_posts() ) : while (  $query->have_posts() ) :  $query->the_post(); ?>
						<div class="col-md-4">
							<?php get_template_part( 'template-parts/card', 'event') ?>
						</div>
					<?php endwhile; endif; ?>
					<?php wp_reset_postdata(); ?>
				</div>
			</div>
			<div class="reading-content">
				<?php comments_template(); ?>
			</div>
		</div>
	</section>

<?php endwhile;?>
<?php endif; ?>

<?php get_footer(); ?>