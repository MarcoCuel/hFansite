<?php  global $user_login;
	if ( isset( $_GET['login'] ) && $_GET['login'] == 'failed' ) : ?>
		<div class="alert alert-danger">Erro: Tente novamente!</div>
	<?php endif; if ( is_user_logged_in() ) : ?>

	<div class="text-center"> 
		<p class="text-muted mb-0">Você já está logado.</p>
		<h3 class="mb-4"><?php echo $user_login; ?></h3>
		<a class="btn btn-secondary px-5" href="<?php echo wp_logout_url( get_permalink() ); ?>">Sair</a>
	</div>

<?php else: ?>
	
	<form action="<?php echo site_url('wp-login.php?action=register', 'login_post') ?>" method="post">
		<div class="form-group">
			<label>Usuário</label>
			<input type="text" name="user_login" id="user_login" class="form-control alt" />
		</div>
		<div class="form-group">
			<label>E-mail</label>
			<input type="text" name="user_email" id="user_email" class="form-control alt"	/>
		</div>
		<p class="text-muted">Uma confirmação de registro será enviada para você por e-mail.</p>
		<?php do_action('register_form'); ?>
		<input class="btn btn-lg btn-block btn-success" type="submit" value="Cadastre-se" id="register" />

		<div class="text-center text-muted mt-4">
			Já tem uma conta? <a href="<?php echo home_url() ?>/entrar" class="text-link text-primary show-login">Entre agora</a>
		</div>
	</form>

<?php endif; ?> 