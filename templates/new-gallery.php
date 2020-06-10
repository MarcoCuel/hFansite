<?php

/**
 * Template Name: Nova arte
 */

get_header();
?>

<div class="jumbotron jumbotron-fluid min pink">
	<div class="container text-center">
		<h1 class="mb-0"><?php echo the_title() ?></h1>
	</div>
</div>

<section>
	<div class="container">
		<?php
			if (is_user_logged_in()){
				if(isset($_POST['submit'])){

					$user = get_current_user_id();

					if($_FILES['thumbnail']['error'] > 0):

						echo '<div class="alert alert-danger">Selecione uma imagem</div>';

					elseif(!isset($_POST['title']) || $_POST['title'] == ''):

						echo '<div class="alert alert-danger">Escreva um título</div>';

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

						echo '<script>location.href="'.get_permalink($post_id).'"</script>';
					endif;
				}
			}
		?>

		<?php if ( is_user_logged_in() ): ?>
			<form action="" method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-6 offset-md-3">

						<div class="form-group">
							<label for="title"><?php esc_html_e( 'Image', 'hfansite' ); ?></label>
							<input type="file" name="thumbnail" class="form-control files">
						</div>

						<div class="form-group">
							<label for="title"><?php esc_html_e( 'Title', 'hfansite' ); ?></label>
							<input name="title" type="text" class="form-control" id="title" placeholder="<?php esc_html_e( 'Title', 'hfansite' ); ?>">
						</div>

						<div class="form-group">
							<label for="tags"><?php esc_html_e( 'Tags', 'hfansite' ); ?> <i class="fas fa-question-circle text-muted" data-toggle="tooltip" title="Vírgula ou enter para concluir. backspace ou delete para remover."></i></label>
							<input name="tags" type="text" class="form-control" id="tags">
						</div>

						<div class="form-group">
							<label for="content"><?php esc_html_e( 'Description', 'hfansite' ); ?> <i class="fas fa-question-circle text-muted" data-toggle="tooltip" title="URLs são vinculadas automaticamente. Quebras de linha e parágrafos são gerados automaticamente. as tags a, em, strong e code são aceitas."></i></label>
							<textarea name="body" class="form-control" id="content" placeholder="<?php esc_html_e( 'Write something...', 'hfansite' ); ?>"></textarea>
						</div>

						<button type="submit" name="submit" class="btn btn-lg btn-block btn-primary mt-4"><?php esc_html_e( 'Publish', 'hfansite' ); ?></button>
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