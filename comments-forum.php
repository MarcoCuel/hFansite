<?php

_deprecated_file(
	/* translators: %s: Template name. */
	sprintf( __( 'Theme without %s' ), basename( __FILE__ ) ),
	'3.0.0',
	null,
	/* translators: %s: Template name. */
	sprintf( __( 'Please include a %s template in your theme.' ), basename( __FILE__ ) )
);

// Do not delete these lines
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die( 'Please do not load this page directly. Thanks!' );
}

if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e( 'This post is password protected. Enter the password to view comments.' ); ?></p>
	<?php
	return;
}

global $user_login;

?>


<?php if ( have_comments() ) : ?>
	<hr>
	<div class="mb-3">
		<h5 id="comments">
			<?php
			if ( 1 == get_comments_number() ) {
				printf(
					/* translators: %s: Post title. */
					__( '1 resposta' ),
					'&#8220;' . get_the_title() . '&#8221;'
				);
			} else {
				printf(
					/* translators: 1: Number of comments, 2: Post title. */
					_n( '%1$s resposta', '%1$s respostas', get_comments_number() ),
					number_format_i18n( get_comments_number() ),
					'&#8220;' . get_the_title() . '&#8221;'
				);
			}
			?>
		</h5>
	</div>

	<ul class="commentlist">
		<?php
		// Display comments
		wp_list_comments( array(
			'callback' => 'better_comments_forum'
		) ); ?>
	</ul>

	<div class="pagination mb-4">
		<?php 
			paginate_comments_links( array(
				'prev_text'  => '<i class="fas fa-chevron-left"></i>',
				'next_text' => '<i class="fas fa-chevron-right"></i>'
			) );
		?> 
	</div>
<?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

	<?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<div class="alert alert-danger" role="alert">
			Comentários fechadooo
		</div>

	<?php endif; ?>
<?php endif; ?>

<?php

$args = array(
	'logged_in_as' => '',
	'comment_field' => '<p class="comment-form-comment">' .
		'<textarea class="form-control alt" id="comment" name="comment" placeholder="Escreva um comentário..." rows="3" aria-required="true"></textarea>' .
		'</p>',
	'comment_notes_after' => '',
	'title_reply_before' => '<h5 id="reply-title" class="comment-reply-title">',
	'title_reply_afer' => '</h5>',
	'cancel_reply_before' => '<div class="cancel ml-auto">',
	'must_log_in' => '<div class="alert alert-secondary">Você precisa <a href="/entrar" data-toggle="modal" data-target="#loginModal">entrar</a> para publicar um comentário.</div>',
	'class_submit' => 'btn btn-primary',
);

?>

<?php comment_form($args); ?>

<?php if ( !comments_open() ) : ?>
	<div class="card">
		<div class="card-body text-center text-muted">
			<strong>Não é mais possível fazer comentários aqui.</strong>
		</div>
	</div>
<?php endif; ?>
