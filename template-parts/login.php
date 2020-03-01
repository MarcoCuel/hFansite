<?php global $user_login;

	if ( is_user_logged_in() ) : ?>

	<div class="text-center"> 
		<p class="text-muted mb-0">Você já está logado.</p>
		<h3 class="mb-4"><?php echo $user_login; ?></h3>
		<a class="btn btn-secondary px-5" href="<?php echo wp_logout_url( get_permalink() ); ?>">Sair</a>
	</div>

<?php else: 
		
		echo do_shortcode('[login-box]') ?>

		<hr class="ou my-4">

		<div class="text-center">
			<a href="<?php echo home_url() ?>/registro" class="btn btn-lg btn-success show-register">Criar nova conta</a>
		</div>

<?php endif; ?> 