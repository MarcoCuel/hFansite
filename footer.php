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
