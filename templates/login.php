<?php

/**
 * Template Name: Entrar
 */

get_header();
?>

<section>
	<div class="container pt-3">
		<div class="row">
			<div class="col-md-4 offset-md-4">
				<div class="toggle-login">
					<div class="login">
						<?php if ( !is_user_logged_in() ) { ?>
							<h3 class="mb-4">Entrar</h3>
						<?php } ?>
						
						<?php get_template_part( 'template-parts/login') ?>
					</div>
					<div class="register" style="display: none;">
						<?php if ( !is_user_logged_in() ) { ?>
							<h3 class="mb-4">Criar conta</h3>
						<?php } ?>

						<?php get_template_part( 'template-parts/register') ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>