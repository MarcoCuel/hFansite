<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="row no-gutters">
				<div class="col-md-6">
					<div class="bg-login">
						<h3>Um lugar divertido com gente incrível.</h3>
					</div>
				</div>
				<div class="col-md-6">
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
	</div>
</div>