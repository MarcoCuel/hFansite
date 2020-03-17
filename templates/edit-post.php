<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			<form action="" method="post" enctype="multipart/form-data">
				<div class="modal-header">
					<h5 class="modal-title" id="editModalLabel">Editar 
					<?php if( 'forum' === get_post_type() ): ?>
						tópico
					<?php elseif( 'galeria' === get_post_type() ): ?>
						arte
					<?php elseif( 'evento' === get_post_type() ): ?>
						evento
					<?php else: ?>
						notícia
					<?php endif; ?></h5>

					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<?php global $current_user; wp_get_current_user();
					$author_id = get_the_author_meta('ID');
					$current_id = $current_user->ID;
					$is_editor = current_user_can('editor') || current_user_can('administrator'); ?>

					<div class="form-group">
						<label>Título</label>
						<input class="form-control alt" type="text" name="title" value="<?php echo get_the_title() ?>" required="">
					</div>
					<div class="form-group">
						<label for="inputContent">Conteúdo</label>
						<?php wp_editor( get_the_content(), 'content', array('textarea_rows' => 15)); ?>
					</div>

					<?php if( 'post' === get_post_type() ): ?>
						<div class="form-group">
							<label for="tags">Tags <i class="fas fa-question-circle text-muted" data-toggle="tooltip" title="Vírgula ou enter para concluir. backspace ou delete para remover."></i></label>

							<?php
								$post_tags = get_the_tags();

								echo '<input name="tags" type="text" class="form-control alt" id="tags" value="';

								if ( $post_tags ) {
									foreach( $post_tags as $key => $tag ) {
										if ($key != array_key_last($post_tags)) :
											echo $tag->name . ','; 
										else :
											echo $tag->name; 
										endif;
									}
								}

								echo '">'
							?>
						</div>
					<?php endif; ?>

					<?php if( 'galeria' === get_post_type() ): ?>
						<div class="form-group">
							<label for="tags">Tags <i class="fas fa-question-circle text-muted" data-toggle="tooltip" title="Vírgula ou enter para concluir. backspace ou delete para remover."></i></label>

							<?php
								$post_tags = wp_get_post_terms($post->ID, 'tags_gallery');

								echo '<input name="tags" type="text" class="form-control alt" id="tags" value="';

								if ( $post_tags ) {
									foreach( $post_tags as $key => $tag ) {
										if ($key != array_key_last($post_tags)) :
											echo $tag->name . ','; 
										else :
											echo $tag->name; 
										endif;
									}
								}

								echo '">'
							?>
						</div>
					<?php endif; ?>

					<?php if( 'evento' === get_post_type() ): ?>
						<div class="form-group">
							<label for="tags">Tags <i class="fas fa-question-circle text-muted" data-toggle="tooltip" title="Vírgula ou enter para concluir. backspace ou delete para remover."></i></label>

							<?php
								$post_tags = wp_get_post_terms($post->ID, 'tags_event');

								echo '<input name="tags" type="text" class="form-control alt" id="tags" value="';

								if ( $post_tags ) {
									foreach( $post_tags as $key => $tag ) {
										if ($key != array_key_last($post_tags)) :
											echo $tag->name . ','; 
										else :
											echo $tag->name; 
										endif;
									}
								}

								echo '">'
							?>
						</div>
					<?php endif; ?>
				</div>

				<input type="hidden" name="postID" value="<?php echo get_the_ID(); ?>">

				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					<input type="submit" class="btn btn-primary" value="Editar">
					<?php wp_nonce_field( 'edit_post', 'edit_post_nonce' ); ?>
					<input type="hidden" name="edit_post" value="true" />
				</div>

				<?php
					if ((is_user_logged_in() && $author_id === $current_id) || $is_editor) {
						if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['edit_post'] )) {
							$current_post = $_POST['postID'];

							if( 'forum' === get_post_type() ):
								$post = array(
									'ID' => $current_post,
									'post_type'	 => 'forum',
									'post_title'	=> wp_strip_all_tags($_POST['title']),
									'post_content'	=> $_POST['content'],
									'post_status'	 => 'publish'
								);
							elseif( 'galeria' === get_post_type() ):
								$post = array(
									'ID' => $current_post,
									'post_type'	 => 'galeria',
									'post_title'	=> wp_strip_all_tags($_POST['title']),
									'post_content'	=> $_POST['content'],
									'post_status'	 => 'publish'
								);
							elseif( 'evento' === get_post_type() ):
								$post = array(
									'ID' => $current_post,
									'post_type'	 => 'evento',
									'post_title'	=> wp_strip_all_tags($_POST['title']),
									'post_content'	=> $_POST['content'],
									'post_status'	 => 'publish'
								);
							else :
								$post = array(
									'ID' => $current_post,
									'post_type'	 => 'post',
									'post_title'	=> wp_strip_all_tags($_POST['title']),
									'post_content'	=> $_POST['content'],
									'tags_input' => wp_strip_all_tags($_POST['tags']),
									'post_status'	 => 'publish'
								);
							endif;

							$post_id = wp_update_post( $post );

							if ( $post_id ) {
								echo '<script>location.href="'.get_permalink($post_id).'"</script>';
								exit;
							}
						}
					}
				?>
			</form>
		</div>
	</div>
</div>