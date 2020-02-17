<?php

/**
 * Template Name: Nova arte
 */

get_header();
?>

<?php
	if (is_user_logged_in()){
		if(isset($_POST['submit'])){

			$user = get_current_user_id();

			if($_FILES['thumbnail']['error'] > 0):

				echo 'Seleciona uma imagem';

			elseif(!isset($_POST['title']) || $_POST['title'] == ''):

				echo 'Escreva um título';

			elseif(!isset($_POST['body']) || $_POST['body'] == ''):

				echo 'Escreva alguma coisa';

			else:

				$title = $_POST['title'];
				$body = $_POST['body'];
				$tags = $_POST['tags_gallery'];

				// Create post object
				$post = array(
					'post_title'	=> $title,
					'post_content'	=> $body,
					'post_type'		=> 'galeria',
					'post_status'	=> 'publish',
					'post_author'	=> $user
				);
				
				// Insert the post into the database
				$post_id = wp_insert_post($post);

				require_once(ABSPATH . "wp-admin" . '/includes/image.php');
				require_once(ABSPATH . "wp-admin" . '/includes/file.php');
				require_once(ABSPATH . "wp-admin" . '/includes/media.php');

				$attachment_id = media_handle_upload('thumbnail', $post_id);

				if (!is_wp_error($attachment_id)) { 
					set_post_thumbnail($post_id, $attachment_id);
				}
				
				if($post_id!=0){
					// Slá
				}

				// echo '<script>location.href="'.get_permalink($post_id).'"</script>';
			endif;
		}
	}
?>

<div class="jumbotron jumbotron-fluid min pink">
	<div class="container text-center">
		<h1 class="mb-0"><?php echo the_title() ?></h1>
	</div>
</div>

<section>
	<div class="container">
		<?php if ( is_user_logged_in() ): ?>
			<form action="" method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-8 offset-md-2">
						<div class="drag-n-drop d-none">
							<div class="mb-3 text-muted">
								<i class="fas fa-cloud-upload-alt fa-4x"></i>
							</div>
							<h4>Arraste e solte uma imagem</h4>
							<div class="mb-2">ou <a href="#">navegue</a> para escolher um arquivo</div>
							<small class="text-muted">(recomendado, 1600 × 1200 ou superior, até 10 MB)</small>
						</div>
					</div>
					<div class="col-md-6 offset-md-3">

						<div class="form-group">
							<label for="title">Imagem</label>
							<input type="file" name="thumbnail" class="form-control">
						</div>

						<div class="form-group">
							<label for="title">Título</label>
							<input name="title" type="text" class="form-control" id="title" placeholder="Título">
						</div>

						<div class="form-group">
							<label for="tags">Tags</label>
							<input name="tags" type="text" class="form-control" id="tags">
							<small class="text-muted">Separadas por virgula</small>
						</div>

						<div class="form-group">
							<label for="content">Descrição</label>
							<textarea name="body" class="form-control" id="content" placeholder="Escrevar algo..."></textarea>
						</div>

						<button type="submit" name="submit" class="btn btn-lg btn-block btn-primary mt-4">Publicar</button>
					</div>
				</div>
			</form>
		<?php else: ?>
			<div class="col-md-6 offset-md-3 mt-5">
				<div class="card">
					<div class="card-body text-center text-muted">
						<strong>Tem que ta logado meu patrão</strong>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>



<?php get_footer(); ?>