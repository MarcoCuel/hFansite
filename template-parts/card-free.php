<?php
$cg_available = get_post_meta( get_the_ID(), 'cg_available', true );
?>
<div class="card free <?php if($cg_available == 'nao') { echo "disabled"; } ?> post-<?php the_ID(); ?>">
	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
		<div class="box pixel" data-toggle="tooltip" data-html="true" title="<strong><?php echo esc_attr( get_post_meta( get_the_ID(), 'cg_name', true ) ); ?></strong>">
			<?php
			$cg_url = get_post_meta( get_the_ID(), 'cg_url', true );
			if( !empty( $cg_url) ) : ?>
				<img src="<?php echo esc_attr( get_post_meta( get_the_ID(), 'cg_url', true ) ); ?>">
			<?php else: ?>
				<img src="<?php echo get_template_directory_uri()?>/assets/image/what.png">
			<?php endif; ?>
		</div>
		<div class="info">
			<?php if($cg_available == 'nao') :
				echo "Indisponível";
			else:
				echo "Disponível";
			endif; ?>
		</div>
	</a>
</div>