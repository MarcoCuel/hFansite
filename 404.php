<?php get_header(); ?>

<section class="e404">
	<div class="container text-center">
		<i class="fas fa-unlink fa-4x mb-4"></i>
		<h5>Página não encontrada</h5>
		<p class="text-muted">O link pode estar quebrado ou a página pode ter sido removida. Verifique se o link que você está tentando abrir está correto.</p>
		<a href="<?php echo home_url() ?>" class="btn btn-primary">Voltar a página inicial</a>
	</div>
</section>

<?php get_footer(); ?>