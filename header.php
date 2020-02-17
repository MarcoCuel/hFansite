<?php

	$theme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light';

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> data-theme="<?php echo $theme; ?>">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<nav class="navbar fixed-top navbar-expand-lg navbar-light">
		<a class="navbar-brand" href="<?php echo home_url() ?>">
			<?php echo bloginfo('name'); ?><span class="tag">Beta</span>
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<?php
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'container'		 => false,
					'menu_class'	 => 'navbar-nav mr-auto',
					'walker'		 => new Bootstrap_NavWalker(),
					'fallback_cb'	 => 'Bootstrap_NavWalker::fallback',
				) );
			?>

			<div class="d-flex justify-content-center align-items-center ml-auto mt-3 mt-lg-0">
				<?php if ( is_user_logged_in() ): ?>
					<?php global $current_user; wp_get_current_user();?>
					<div class="dropdown mr-4">
						<div id="dropnew" class="btn btn-sm btn-success" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-plus mr-1"></i> Novo
						</div>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropnew">
							<a class="dropdown-item" href="<?php echo home_url() ?>/novo-topico">Tópico</a>
							<a class="dropdown-item" href="<?php echo home_url() ?>/nova-arte">Arte</a>
							<?php if(current_user_can('administrator')) { ?>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="<?php echo admin_url('post-new.php') ?>">Notícia</a>
								<a class="dropdown-item" href="<?php echo admin_url('post-new.php?post_type=evento'); ?>">Evento</a>
								<a class="dropdown-item" href="<?php echo admin_url('post-new.php?post_type=publicidade'); ?>">Publicidade</a>
							<?php } ?>
						</div>
					</div>

					<div class="dropdown">
						<div id="dropUser" class="d-flex align-items-center" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<div class="avatar pixel">
								<img src="https://www.habbo.com.br/habbo-imaging/avatarimage?&user=<?php echo $current_user->user_login ?> &action=std&direction=2&head_direction=2&img_format=png&gesture=std&headonly=0&size=s" alt="<?php echo $current_user->user_login ?>"></div>
						</div>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropUser">
							<a class="dropdown-item" href="<?php echo home_url() ?>/perfil/<?php echo $current_user->user_login ?>"><i class="fas fa-user text-muted mr-2"></i> Perfil</a>
							<label class="theme-switch dropdown-item" for="checkbox">
								<i class="fas fa-moon text-muted mr-2"></i> Modo escuro
								<div class="custom-control custom-switch ml-auto">
									<input type="checkbox" class="custom-control-input" id="checkbox" <?php echo $theme == 'dark' ? ' checked' : ''; ?>>
									<label class="custom-control-label" for="checkbox"></label>
								</div>
							</label>
							<a class="dropdown-item" href="<?php echo home_url() ?>/configuracoes"><i class="fas fa-cog text-muted mr-2"></i> Configurações</a>
							<a class="dropdown-item" href="<?php echo wp_logout_url( home_url() ); ?>"><i class="fas fa-sign-out-alt text-muted mr-2"></i> Sair</a>
						</div>
					</div>
				<?php else: ?>
					<div class="mr-4">
						<label class="theme-switch mb-0" for="checkbox">
							<i class="fas fa-moon text-muted"></i>
							<input class="d-none" type="checkbox" id="checkbox" />
						</label>
					</div>

					<a	href="<?php echo home_url() ?>/entrar" class="btn btn-primary" data-toggle="modal" data-target="#loginModal" class="btn">Entrar</a>
				<?php endif; ?>

				<div class="search">
					<label for="search"><i class="fas fa-search"></i></label>

					<form action="<?php echo home_url() ?>/" method="get">
						<input type="text" name="s" id="search" value="<?php the_search_query(); ?>" placeholder="Buscar..." />
					</form>
				</div>
			</div>
		</div>
	</nav>

	<div class="site-wrapper">