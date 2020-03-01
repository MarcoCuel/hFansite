		<div class="site-footer">
			<div class="container">

				<?php
					wp_nav_menu( array(
						'theme_location' => 'footer',
					) );
				?>

				<div class="mb-3"><strong><?php echo bloginfo('name'); ?></strong> © <?php echo date('Y');?>. Todos direitos reservados.</div>
				Esta Fã Site não está afiliada com, patrocinada por, apoiada por, ou principalmente aprovada pela Sulake Oy ou suas empresas Afiliadas.<br>
				Esta Fã Site pode utilizar as marcas registradas e outras propriedades intelectuais do Habbo, que estão permitidas sob a Política de Fã Sites Habbo.
			</div>
		</div>
	</div>

	<?php if ( !is_user_logged_in() ) { ?>
		<?php get_template_part( 'template-parts/modal', 'login') ?>
	<?php } ?>

	<?php wp_footer(); ?>

		<div class="card player">
			<div class="card-body">
				<div class="play">
					<i class="fas fa-pause"></i>
				</div>

				<div class="content mr-auto">
					<h5 class="mb-1">Só toca TOP</h5>
					<div class="card-text">
						<div class="avatar pixel sm mr-2">
							<img src="https://www.habbo.com.br/habbo-imaging/avatarimage?&user=Bromarks&action=std&direction=2&head_direction=2&img_format=png&gesture=std&headonly=0&size=s" alt="Bromarks">
						</div>
						Bromarks
					</div>
				</div>

				<div class="volume">
					<i class="fas fa-volume-up"></i>
				</div>
			</div>
		</div>

	</body>
</html>



<!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content p-3">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Presentes diários</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body pt-0">
				<div class="text-muted mb-4">Entre para abrir seus presentes diários grátis</div>
				<div class="row">
					<div class="col-md-4">
						<div class="gift-btn">
							<div class="timer"><i class="far fa-clock"></i> 2h 3m</div>
							<div class="gift inative"></div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="gift-btn">
							<div class="timer"><i class="far fa-clock"></i> 2h 4m</div>
							<div class="gift inative"></div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="gift-btn">
							<div class="gift"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> -->
