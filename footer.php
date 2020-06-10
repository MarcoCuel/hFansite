	</main>
	<div class="site-footer">
		<div class="container">

			<?php
				wp_nav_menu( array(
					'theme_location' => 'footer',
				) );
			?>

			<div class="mb-3"><strong><?php echo bloginfo('name'); ?></strong> © <?php echo date('Y');?>. <?php esc_html_e( 'All rights reserved.', 'hfansite' ); ?></div>

			<?php esc_html_e( 'This Fan Site is not affiliated with, endorsed, sponsored, or specifically approved by Sulake Oy or its Affiliates.', 'hfansite' ); ?><br>
			<?php esc_html_e( 'This Fan Site may use the trademarks and other intellectual property of Habbo, which is permitted under Habbo Fan Site Policy.', 'hfansite' ); ?>
		</div>
	</div>

	<?php if ( !is_user_logged_in() ) { ?>
		<?php get_template_part( 'template-parts/modal', 'login') ?>
	<?php } ?>

	<?php
	$radio_active = fs_get_theme_option( 'radio_checkbox' );
	$radio_ip = fs_get_theme_option( 'radio_ip' );
	$radio_port = fs_get_theme_option( 'radio_port' );

	if ($radio_active == 'on') { ?>
		<div class="card player">
			<div class="card-body">
				<div class="play">
					<i class="fas fa-pause"></i>
				</div>

				<div class="content mr-auto">
					<h5 class="mb-1">Só toca TOP</h5>
					<div class="card-text">
						Bromarks
					</div>
				</div>

				<div class="volume">
					<i class="fas fa-volume-up"></i>
				</div>
			</div>

			<audio class="d-none" id="player" controls="controls" autoplay autoplay="" preload="none">
				<source id="source_mpeg" src="<?php echo $radio_ip?>:<?php echo $radio_port?>/;type=mp3" type="audio/mpeg">
				<source id="source_ogg" src="<?php echo $radio_ip?>:<?php echo $radio_port?>/;type=ogg" type="audio/ogg">
				<source id="source_aacplus" src="<?php echo $radio_ip?>:<?php echo $radio_port?>/;type=aacplus" type="audio/aacplus">
				<source id="source_wav" src="<?php echo $radio_ip?>:<?php echo $radio_port?>/;type=wav" type="audio/wav">
			</audio>
		</div>
	<?php } ?>

	<?php wp_footer(); ?>

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
