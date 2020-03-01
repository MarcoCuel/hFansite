<?php

// List Users
add_action("admin_init", "users_meta_init");

function users_meta_init(){
	add_meta_box("users-meta", "Selecionar usuário", "users", "destaque", "side", "high");
}

function users(){
	global $post;
	$custom = get_post_custom($post->ID);
	$users = $custom["users"][0];
	$user_args = array(
		'orderby' => 'user_login'
	);
	$wp_user_query = new WP_User_Query($user_args);
	$authors = $wp_user_query->get_results();

	if (!empty($authors)) {
		echo "<select name='users'>";
		foreach ($authors as $author) {
			$author_info = get_userdata($author->ID);
			$author_id = get_post_meta($post->ID, 'users', true);
			if($author_id == $author_info->ID) { $author_selected = 'selected="selected"'; } else { $author_selected = ''; }
			echo '<option value='.$author_info->ID.' '.$author_selected.'>'.$author_info->user_login.'</option>';
		}
		echo "</select>";
	} else {
		echo 'Nenhum usuário encontrado';
	}
}

add_action('save_post', 'save_userlist');

function save_userlist(){
	global $post;

if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post->ID;
}
	update_post_meta($post->ID, "users", $_POST["users"]);
}





function cg_register_meta_boxes() {
	add_meta_box( 'cg-1', 'Coisas grátis', 'cg_display_callback', 'post' );
}
add_action( 'add_meta_boxes', 'cg_register_meta_boxes' );


function cg_display_callback( $post ) { ?>

<div class="cg_box">
	<style scoped>
		.cg_box{
			display: grid;
			grid-template-columns: max-content 1fr;
			grid-row-gap: 16px;
			grid-column-gap: 16px;
		}
		.cg_field{
			display: contents;
		}
	</style>
	<p class="meta-options cg_field">
		<label for="cg_name">Título</label>
		<input id="cg_name"
			type="text"
			name="cg_name"
			value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'cg_name', true ) ); ?>">
	</p>
	<p class="meta-options cg_field">
		<label for="cg_url">URL (40x40)</label>
		<input id="cg_url"
			type="text"
			name="cg_url"
			value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'cg_url', true ) ); ?>">
	</p>
	<p class="meta-options cg_field">
		<label for="cg_available">Indisponível</label>
		<input id="cg_available"
			type="text"
			name="cg_available"
			value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'cg_available', true ) ); ?>">
	</p>
</div>

<?php }

function cg_save_meta_box( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( $parent_id = wp_is_post_revision( $post_id ) ) {
		$post_id = $parent_id;
	}
	$fields = [
		'cg_name',
		'cg_available',
		'cg_url',
	];
	foreach ( $fields as $field ) {
		if ( array_key_exists( $field, $_POST ) ) {
			update_post_meta( $post_id, $field, sanitize_text_field( $_POST[$field] ) );
		}
	 }
}
add_action( 'save_post', 'cg_save_meta_box' );



function alert_register_meta_boxes() {
	add_meta_box( 'alert-1', 'Alerta (Live)', 'alert_display_callback', 'post' );
}
add_action( 'add_meta_boxes', 'alert_register_meta_boxes' );


function alert_display_callback( $post ) { ?>

<div class="alert_box">
	<style scoped>
		.alert_box{
			display: grid;
			grid-template-columns: max-content 1fr;
			grid-row-gap: 16px;
			grid-column-gap: 16px;
		}
		.alert_field{
			display: contents;
		}
	</style>
	<p class="meta-options alert_field">
		<label for="alert_name">Título</label>
		<input id="alert_name"
			type="text"
			name="alert_name"
			value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'alert_name', true ) ); ?>">
	</p>
</div>

<?php }

function alert_save_meta_box( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( $parent_id = wp_is_post_revision( $post_id ) ) {
		$post_id = $parent_id;
	}
	$fields = [
		'alert_name',
	];
	foreach ( $fields as $field ) {
		if ( array_key_exists( $field, $_POST ) ) {
			update_post_meta( $post_id, $field, sanitize_text_field( $_POST[$field] ) );
		}
	 }
}
add_action( 'save_post', 'alert_save_meta_box' );




function event_register_meta_boxes() {
	add_meta_box( 'event-1', 'Data do evento', 'event_display_callback', 'evento' );
}
add_action( 'add_meta_boxes', 'event_register_meta_boxes' );


function event_display_callback( $post ) { ?>

<div class="event_box">
	<style scoped>
		.event_box{
			display: grid;
			grid-template-columns: max-content 1fr;
			grid-row-gap: 16px;
			grid-column-gap: 16px;
		}
		.event_field{
			display: contents;
		}
	</style>
	<p class="meta-options event_field">
		<label for="event_date">Data</label>
		<input id="event_date"
			type="date"
			name="event_date"
			value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'event_date', true ) ); ?>">
	</p>
	<p class="meta-options event_field">
		<label for="event_time">Hora</label>
		<input id="event_time"
			type="time"
			name="event_time"
			value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'event_time', true ) ); ?>">
	</p>
	<p class="meta-options event_field">
		<label for="event_time_end">Hora (Término)</label>
		<input id="event_time_end"
			type="time"
			name="event_time_end"
			value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'event_time_end', true ) ); ?>">
	</p>
</div>

<?php }

function event_save_meta_box( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( $parent_id = wp_is_post_revision( $post_id ) ) {
		$post_id = $parent_id;
	}
	$fields = [
		'event_date',
		'event_time',
		'event_time_end',
	];
	foreach ( $fields as $field ) {
		if ( array_key_exists( $field, $_POST ) ) {
			update_post_meta( $post_id, $field, sanitize_text_field( $_POST[$field] ) );
		}
	 }
}
add_action( 'save_post', 'event_save_meta_box' );