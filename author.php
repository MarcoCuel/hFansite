<?php 

$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));

global $wpdb, $post, $curauth;
	get_currentuserinfo();
	$userId = $curauth->ID;

	$where = 'WHERE comment_approved = 1 AND user_id = ' . $userId ;
	$comment_count = $wpdb->get_var("SELECT COUNT( * ) AS total 
		FROM {$wpdb->comments}
		{$where}");

$topicos =  count_user_posts($curauth->ID, 'forum');
$artes =  count_user_posts($curauth->ID, 'galeria');
$noticias =  count_user_posts($curauth->ID, 'post');
$eventos =  count_user_posts($curauth->ID, 'evento');

get_header(); ?>

<div class="jumbotron jumbotron-fluid white py-0">
	<div class="profile-cover" style="background-color: #333">
		<br><br><br><br><br><br><br><br>
	</div>
	<div class="container py-3">
		<div class="row">
			<div class="col-md-8 offset-md-4 pl-md-3">
				<ul class="nav nav-pills" id="tabs" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="geral-tab" data-toggle="tab" href="#geral" role="tab" aria-controls="geral" aria-selected="true">Atividade</a>
					</li>
					<?php if($noticias > 0) { ?>
						<li class="nav-item">
							<a class="nav-link" id="noticias-tab" data-toggle="tab" href="#noticias" role="tab" aria-controls="noticias" aria-selected="true">Notícias</a>
						</li>
					<?php } ?>
					<li class="nav-item">
						<a class="nav-link" id="topicos-tab" data-toggle="tab" href="#topicos" role="tab" aria-controls="topicos" aria-selected="true">Tópicos</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="artes-tab" data-toggle="tab" href="#artes" role="tab" aria-controls="artes" aria-selected="true">Artes</a>
					</li>
					<?php if($eventos > 0) { ?>
						<li class="nav-item">
							<a class="nav-link" id="eventos-tab" data-toggle="tab" href="#eventos" role="tab" aria-controls="eventos" aria-selected="true">Eventos</a>
						</li>
					<?php } ?>
					</ul>
				</ul>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-4 pr-md-3">
			<div class="card" style="margin-top: -12rem">
				<div class="card-body py-5 text-center">

					<div class="avatar pixel xl mx-auto mb-2">
						<img src="https://www.habbo.com.br/habbo-imaging/avatarimage?&user=<?php echo $curauth->user_login; ?>&action=std&direction=2&head_direction=2&img_format=png&gesture=std&headonly=0&size=l">
					</div>
				 
					<h1 class="mb-0" data-toggle="tooltip" title="<?php echo $curauth->user_login; ?>"><?php echo $curauth->display_name; ?></h1>

					<div class="mb-3 text-muted">@<?php echo $curauth->user_login; ?></div>

					<?php if($curauth->description) { ?>
					<div><?php echo $curauth->description; ?></div>
					<?php } ?>

					<ul class="list">
						<li><?php echo $topicos ?> Tópicos</li>
						<li><?php echo $artes ?> Artes</li>
						<li><?php echo $comment_count ?> Comentários</li>
					</ul>

					<?php if($curauth->user_url) { ?>
					<a href="<?php echo $curauth->user_url; ?>" class="site-btn" target="_blank"><i class="fas fa-globe mr-2"></i> <?php echo $curauth->user_url; ?></a>
					<?php } ?>
				</div>
			</div>
		</div>

		<div class="col-md-8 pl-md-3">
			<section class="py-2">
				<div class="tab-content" id="tabsContent">
					<div class="tab-pane fade show active" id="geral" role="tabpanel" aria-labelledby="geral-tab">
						<h3 class="mb-3">Atividade</h3>

						<div class="row">
							<div class="card">
								<div class="card-body text-center text-muted">
									<strong>Nada ainda</strong>
								</div>
							</div>
						</div>
					</div>
					<?php if($noticias > 0) { ?>
					<div class="tab-pane fade" id="noticias" role="tabpanel" aria-labelledby="noticias-tab">
						<div class="row">
							<?php
								$args = array(
									'post_type' => 'post',
									'order' => 'DESC',
									'author' => $curauth->ID,
								);

								$query = new WP_Query( $args );
							?>

							<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
								<div class="col-sm-4">
									<?php get_template_part( 'template-parts/card', 'news') ?>
								</div>
							<?php endwhile; else: ?>
								<div class="col-md-6 offset-md-3">
									<div class="card">
										<div class="card-body text-center text-muted">
											<strong>Nenhuma notícia</strong>
										</div>
									</div>
								</div>
							<?php endif; ?>
							<?php wp_reset_postdata(); ?>
						</div>
					</div>
					<?php } ?>
					<div class="tab-pane fade" id="topicos" role="tabpanel" aria-labelledby="topicos-tab">
						<div class="row">
							<?php
								$args = array(
									'post_type' => 'forum',
									'order' => 'DESC',
									'author' => $curauth->ID,
								);

								$query = new WP_Query( $args );
							?>

							<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
								<div class="col-sm-6">
									<?php get_template_part( 'template-parts/card', 'topic') ?>
								</div>
							<?php endwhile; else: ?>
								<div class="col-md-6 offset-md-3">
									<div class="card">
										<div class="card-body text-center text-muted">
											<strong>Nenhum tópico</strong>
										</div>
									</div>
								</div>
							<?php endif; ?>
							<?php wp_reset_postdata(); ?>
						</div>
					</div>
					<div class="tab-pane fade" id="artes" role="tabpanel" aria-labelledby="artes-tab">
						<div class="row">
							<?php
								$args = array(
									'post_type' => 'galeria',
									'order' => 'DESC',
									'author' => $curauth->ID,
								);

								$query = new WP_Query( $args );
							?>

							<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
								<div class="col-sm-4">
									<?php get_template_part( 'template-parts/card', 'gallery') ?>
								</div>
							<?php endwhile; else: ?>
								<div class="col-md-6 offset-md-3">
									<div class="card">
										<div class="card-body text-center text-muted">
											<strong>Nenhuma arte</strong>
										</div>
									</div>
								</div>
							<?php endif; ?>
							<?php wp_reset_postdata(); ?>
						</div>
					</div>
					<?php if($eventos > 0) { ?>
					<div class="tab-pane fade" id="eventos" role="tabpanel" aria-labelledby="eventos-tab">
						<div class="row">
							<?php
								$args = array(
									'post_type' => 'evento',
									'order' => 'DESC',
									'author' => $curauth->ID,
								);

								$query = new WP_Query( $args );
							?>

							<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
								<div class="col-sm-6">
									<?php get_template_part( 'template-parts/card', 'event') ?>
								</div>
							<?php endwhile; else: ?>
								<div class="col-md-6 offset-md-3">
									<div class="card">
										<div class="card-body text-center text-muted">
											<strong>Nenhum evento</strong>
										</div>
									</div>
								</div>
							<?php endif; ?>
							<?php wp_reset_postdata(); ?>
						</div>
					</div>
					<?php } ?>
				</div>
			</section>
		</div>
	</div>
</div>

<?php get_footer(); ?>