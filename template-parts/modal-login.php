<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content py-4 px-3 px-md-5">
			<div class="toggle-login">
				<div class="login">
					<div class="modal-header">
						<h3 class="modal-title" id="loginModalCenterTitle">Entrar</h3>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<i class="fas fa-times"></i>
						</button>
					</div>
					<div class="modal-body">
						<?php get_template_part( 'template-parts/login') ?>
					</div>
				</div>
				<div class="register" style="display: none;">
					<div class="modal-header">
						<h3 class="modal-title" id="loginModalCenterTitle">Criar conta</h3>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<i class="fas fa-times"></i>
						</button>
					</div>
					<div class="modal-body">
						<?php get_template_part( 'template-parts/register') ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>