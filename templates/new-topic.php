<?php

/**
 * Template Name: Novo tópico
 */

get_header();
?>

<?php
	if (is_user_logged_in()){
		if(isset($_POST['submit'])){

			$user = get_current_user_id();

			if(!isset($_POST['category_forum']) || $_POST['category_forum'] == ''):

				echo 'Escolha uma categoria';

			elseif(!isset($_POST['title']) || $_POST['title'] == ''):

				echo 'Escreva um título';

			elseif(!isset($_POST['body']) || $_POST['body'] == ''):

				echo 'Escreva alguma coisa';

			else:

				$title = $_POST['title'];
				$body = $_POST['body'];
				$forum_category = $_POST['category_forum'];

				// Create post object
				$post = array(
					'post_title'	=> $title,
					'post_content'	=> $body,
					'post_type'		=> 'forum',
					'post_status'	=> 'publish',
					'post_author'	=> $user
				);
				
				// Insert the post into the database
				$post_id = wp_insert_post($post);
				
				if($post_id!=0){
					// Taxonomia 
					$cat_ids = array($forum_category);
					$cat_ids = array_map( 'intval', $cat_ids );
					$cat_ids = array_unique( $cat_ids );
					$term_taxonomy_ids = wp_set_object_terms($post_id, $cat_ids, 'category_forum' );
				}

				echo '<script>location.href="'.get_permalink($post_id).'"</script>';
			endif;
		}
	}
?>

<div class="jumbotron jumbotron-fluid min orange">
	<div class="container text-center">
		<h1 class="mb-0"><?php echo the_title() ?></h1>
	</div>
</div>

<section>
	<div class="container">
		<div class="row">
			<?php if ( is_user_logged_in() ): ?>
				<div class="col-md-6 offset-md-3">
					<form action="" method="post" enctype="multipart/form-data">

						<div class="form-group">
							<label for="category">Categoria</label>
							<?php
								$terms = get_terms("category_forum",'order_by=count&hide_empty=0');
								if ( !empty( $terms ) && !is_wp_error( $terms ) ){
								echo "<select class='custom-select' id='category' name='category_forum'>";
									echo "<option selected='selected' disabled='' value=''>Selecionar...</option>";

								foreach ( $terms as $term ) {
									echo "<option value='".$term->term_id."'>" . $term->name . "</option>";
									
								}
								echo "</select>";
								}
							?>
						</div>

						<div class="form-group">
							<label for="title">Título</label>
							<input name="title" type="text" class="form-control" id="title" placeholder="Título">
						</div>

						<div class="form-group">
							<label for="content">Conteúdo</label>
							<textarea name="body" class="form-control" rows="4" id="content" placeholder="Escrevar algo..."></textarea>
						</div>

						<button type="submit" name="submit" class="btn btn-lg btn-block btn-primary mt-4">Publicar</button>
						
					</form>

				</div>
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
	</div>
</section>



<?php get_footer(); ?>