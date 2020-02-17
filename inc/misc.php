<?php

// Post Like
require get_template_directory() . '/inc/post-like.php';


// Esconder AdminBar
add_action('after_setup_theme', 'remove_admin_bar');
	 
	function remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
		show_admin_bar(false);
	}
}


// Altera data posts
function post_time_ago() {
	return sprintf( esc_html__( 'há %s' ), human_time_diff(get_the_time ( 'U' ), current_time( 'timestamp' ) ) );
}
add_filter( 'get_the_date', 'post_time_ago' );


// Altera data comentários
function comment_time_ago() {
return sprintf( esc_html__( 'há %s' ), human_time_diff(get_comment_time ( 'U' ), current_time( 'timestamp' ) ) );
}
add_filter( 'get_comment_date', 'comment_time_ago' );


// Remove campo "URL" dos comentários
add_filter('comment_form_default_fields', 'unset_url_field');
function unset_url_field($fields){
	if(isset($fields['url']))
		unset($fields['url']);
		return $fields;
}


// Views
function getPostViews($postID){
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
		return "0 view";
	}
	return $count.' views';
}

function getPostViewsClean($postID){
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
		return "0";
	}
	return $count;
}
 
function setPostViews($postID) {
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
		$count = 0;
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
	}else{
		$count++;
		update_post_meta($postID, $count_key, $count);
	}

	if($_COOKIE['last_ip_address']!= $_SESSION['REMOTE_ADDR']) :
		setPostViews(get_the_ID());
		$setcookie("last_ip_address", $_SESSION['REMOTE_ADDR']);
	endif;
}


remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);


// Mudar URL author para Profile
add_action('init', 'cng_author_base');
function cng_author_base() {
	global $wp_rewrite;
	$author_slug = 'perfil'; // change slug name
	$wp_rewrite->author_base = $author_slug;
}