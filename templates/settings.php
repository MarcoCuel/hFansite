<?php
/*
* Template Name: Configurações
*/

/* Get user info. */
global $current_user, $wp_roles;

/* Load the registration file. */
$error = array();

/* If profile was saved, update profile. */
if ('POST' == $_SERVER['REQUEST_METHOD'] && !empty($_POST['action']) && $_POST['action'] == 'update-user') {

	/* Update user password. */
	if (!empty($_POST['pass1']) && !empty($_POST['pass2'])) {
		if ($_POST['pass1'] == $_POST['pass2']) wp_update_user(array(
			'ID' => $current_user->ID,
			'user_pass' => esc_attr($_POST['pass1'])
		));
		else
			$error[] = __('As senhas inseridas não são iguais. Sua senha não foi atualizada.', 'profile');
	}

	/* Update user information. */
	if (!empty( $_POST['url'])) wp_update_user( array(
		'ID' => $current_user->ID, 
		'user_url' => esc_url( $_POST['url']
	)));
	if (!empty($_POST['email'])) {
		if (!is_email(esc_attr($_POST['email']))) $error[] = __('O email digitado não é válido. Por favor, tente novamente.', 'profile');
		elseif (email_exists(esc_attr($_POST['email'])) != $current_user->id) $error[] = __('Este email já está sendo usado por outro usuário. tente um diferente.', 'profile');
		else {
			wp_update_user(array(
				'ID' => $current_user->ID,
				'user_email' => esc_attr($_POST['email'])
			));
		}
	}

	if ( !empty( $_POST['first-name'] ) )
		update_user_meta( $current_user->ID, 'first_name', esc_attr( $_POST['first-name'] ) );
	if ( !empty( $_POST['nickname'] ) )
		update_user_meta( $current_user->ID, 'nickname', esc_attr( $_POST['nickname'] ) );
	if ( !empty( $_POST['last-name'] ) )
		update_user_meta($current_user->ID, 'last_name', esc_attr( $_POST['last-name'] ) );
	if ( !empty( $_POST['display_name'] ) ) wp_update_user(array(
		'ID' => $current_user->ID,
		'display_name' => esc_attr($_POST['display_name'])
	));
	update_user_meta($current_user->ID, 'display_name', esc_attr($_POST['display_name']));
	if ( !empty( $_POST['description'] ) )
		update_user_meta( $current_user->ID, 'description', esc_attr( $_POST['description'] ) );

	/* Redirect so the page will show updated info.*/
	if ( count($error) == 0 ) {
		//action hook for plugins and extra fields saving
		do_action('edit_user_profile_update', $current_user->ID);
		wp_redirect( get_permalink() );
		exit;
	}
}

get_header();
?>

<?php if (is_user_logged_in()): ?>
<div class="jumbotron jumbotron-fluid">
	<div class="container">
		<h1><?php echo the_title() ?></h1>
	</div>
</div>
<?php endif; ?>

<section>
	<div class="container">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<?php if (!is_user_logged_in()): ?>

			<div class="row pt-5">
				<div class="col-md-6 offset-md-3">
					<div class="alert alert-warning">
						Você deve estar logado para editar seu perfil.
					</div>
				</div>
			</div>

			<?php else: ?>
			
				<?php if ($_GET['updated'] == 'true'): ?>

				<div id="message" class="alert alert-success"><p>Your profile has been updated.</p></div>

			<?php endif; ?>

			<div class="row">
				<div class="col-md-6">
					<?php if (count($error) > 0) echo '<div class="alert alert-danger">' . implode("<br />", $error) . '</div>'; ?>

					<form method="post" id="adduser" action="<?php the_permalink(); ?>">
						<h3 class="mb-3"><?php esc_html_e( 'Name', 'hfansite' ); ?></h3>
						<div class="form-group form-username">
							<label for="user_login"><?php esc_html_e( 'Username', 'hfansite' ); ?></label>
							<input disabled="" class="form-control" name="user_login" type="text" id="user_login" value="<?php the_author_meta('user_login', $current_user->ID); ?>" />
							<small class="form-text text-muted">Não é possível alterar nomes de usuário.</small>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group form-username">
									<label for="first-name"><?php esc_html_e( 'First name', 'hfansite' ); ?></label>
									<input class="form-control" name="first-name" type="text" id="first-name" value="<?php the_author_meta('first_name', $current_user->ID); ?>" />
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group form-username">
									<label for="last-name"><?php esc_html_e( 'Last name', 'hfansite' ); ?></label>
									<input required="" class="form-control" name="last-name" type="text" id="last-name" value="<?php the_author_meta('last_name', $current_user->ID); ?>" />
								</div>
							</div>
						</div>
						<div class="form-group form-username">
							<label for="nickname">Apelido *</label>
							<input class="form-control" name="nickname" type="text" id="nickname" value="<?php the_author_meta('nickname', $current_user->ID); ?>" />
						</div>
						<div class="form-group form-display_name">
							<label for="display_name">Exibir o nome publicamente como</label>

							<select class="custom-select" name="display_name" id="display_name"><br/>
								<?php
									$public_display = array();
									$public_display['display_nickname'] = $current_user->nickname;
									$public_display['display_username'] = $current_user->user_login;

									if (!empty($current_user->first_name)) $public_display['display_firstname'] = $current_user->first_name;

									if (!empty($current_user->first_name) && !empty($current_user->last_name)) {
										$public_display['display_firstlast'] = $current_user->first_name . ' ' . $current_user->last_name;
									}

									if (!in_array($current_user->display_name, $public_display)) // Only add this if it isn't duplicated elsewhere
									$public_display = array(
										'display_displayname' => $current_user->display_name
									) + $public_display;

									$public_display = array_map('trim', $public_display);
									$public_display = array_unique($public_display);

									foreach ($public_display as $id => $item) { ?>
									<option <?php selected($current_user->display_name, $item); ?>><?php echo $item; ?></option>
								<?php } ?>
							</select>
						</div>

						<h3 class="mb-3 mt-4">Informações de contato</h3>
						<div class="form-group form-email">
							<label for="email">E-mail *</label>
							<input required="" class="form-control" name="email" type="text" id="email" value="<?php the_author_meta('user_email', $current_user->ID); ?>" />
							<small class="form-text text-muted">Se você alterar isso, enviaremos um e-mail para o seu novo endereço para confirmá-lo. <strong>O novo endereço de e-mail não ficará ativo até ser confirmado.</strong></small>
						</div>
						<div class="form-group form-url">
							<label for="url">Site</label>
							<input class="form-control" name="url" type="text" id="url" value="<?php the_author_meta('user_url', $current_user->ID); ?>" />
						</div>

						<h3 class="mb-3 mt-4">Sobre você</h3>
						<div class="form-group form-textarea">
							<label for="description">Informações biográficas</label>
							<textarea class="form-control" name="description" id="description" rows="3" cols="50"><?php the_author_meta('description', $current_user->ID); ?></textarea>
						</div>

						<h3 class="mb-3 mt-4">Gerenciamento de conta</h3>
						<div class="form-group form-password">
							<label for="pass1">Senha *</label>
							<input class="form-control" name="pass1" type="password" id="pass1" />
						</div>
						<div class="form-group form-password">
							<label for="pass2">Repetir senha *</label>
							<input class="form-control" name="pass2" type="password" id="pass2" />
						</div>

						<?php
						//action hook for plugin and extra fields
						do_action('edit_user_profile', $current_user); ?>

						<p class="form-submit">
							<?php echo $referer; ?>
							<input name="updateuser" type="submit" id="updateuser" class="btn btn-primary" value="Atualizar perfil" />
							<?php wp_nonce_field('update-user_' . $current_user->ID) ?>
							<input name="action" type="hidden" id="action" value="update-user" />
						</p><!-- .form-submit -->
					</form>
				</div>
			</div>
		<?php endif; ?>

		<?php endwhile; ?>
		<?php else: ?>
			<p class="no-data">
				<?php _e('Sorry, no page matched your criteria.', 'profile'); ?>
			</p>
		<?php endif; ?>
	</div>
</section>

<?php get_footer(); ?>
