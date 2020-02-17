<?php

/**
 * Template Name: Equipe
 */

get_header();
?>

<div class="jumbotron jumbotron-fluid blue">
	<div class="container">
		<h1 class="mb-0"><?php echo the_title() ?></h1>
	</div>
</div>

<section>
	<div class="container">
		<div class="card mb-4 d-none">
			<div class="list-team">
				<a href="#" class="item active">Administração</a>
				<a href="#" class="item">Jornalismo</a>
			</div>
		</div>

		<h4 class="mb-3">Administração</h4>
		<div class="row mb-4">
			<?php
				$args = array(
					'role'    => 'administrator',
					'orderby' => 'user_nicename',
					'order'   => 'ASC'
				);
				$users = get_users( $args );
				foreach ( $users as $user ) { ?>

				<div class="col-md-2">
					<div class="card">
						<div class="card-body text-center">
							<div class="avatar pixel lg mx-auto mb-3">
								<img src="https://www.habbo.com.br/habbo-imaging/avatarimage?&user=<?php echo $user->user_login ?>&action=std&direction=2&head_direction=2&img_format=png&gesture=std&headonly=0&size=b">
							</div>
							<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), $user->user_login ); ?>" class="h5 text-inherit mb-1 d-block" data-toggle="tooltip" title="<?php echo $user->user_login ?>"><?php echo $user->display_name ?></a>
						</div>
					</div>
				</div>

			<?php } ?>
		</div>

		<h4 class="mb-3">Jornalismo</h4>

		<div class="row mb-4">
			<?php
				$args = array(
					'role'    => 'author',
					'orderby' => 'user_nicename',
					'order'   => 'ASC'
				);
				$users = get_users( $args );
				foreach ( $users as $user ) { ?>

				<div class="col-md-2">
					<div class="card">
						<div class="card-body text-center">
							<div class="avatar pixel lg mx-auto mb-3">
								<img src="https://www.habbo.com.br/habbo-imaging/avatarimage?&user=<?php echo $user->user_login ?>&action=std&direction=2&head_direction=2&img_format=png&gesture=std&headonly=0&size=b">
							</div>
							<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), $user->user_login ); ?>" class="h5 text-inherit mb-1 d-block" data-toggle="tooltip" title="<?php echo $user->user_login ?>"><?php echo $user->display_name ?></a>
						</div>
					</div>
				</div>

			<?php } ?>
		</div>

	</div>
</section>



<?php get_footer(); ?>