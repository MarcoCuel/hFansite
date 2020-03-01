<?php

function login_box_shortcode() {
	ob_start();
	$login  = (isset($_GET['login']) ) ? $_GET['login'] : 0;
	if ($login === "failed") {
		echo '<p class="alert alert-danger">Nome de usuário e/ou senha inválidos.</p>';
	} elseif ($login === "empty") {
		echo '<p class="alert alert-danger">Nome de usuário e/ou senha estão vazios.</p>';
	} elseif ($login === "false") {
		echo '<p class="alert alert-success">Você está logado agora.</p>';
	}
	wp_login_form();
	return ob_get_clean();	
} 
add_shortcode( 'login-box', 'login_box_shortcode' );

function redirect_login_page() {
	$login_page = get_home_url();
	$page_viewed = basename($_SERVER['REQUEST_URI']);

	if ($page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
		wp_redirect($login_page);
		exit;
	}
}
add_action('init', 'redirect_login_page');

function login_failed() {
	$login_page = get_home_url();
	wp_redirect($login_page . '/entrar/?login=failed');
	exit;
}
add_action('wp_login_failed', 'login_failed');

function verify_username_password($user, $username, $password) {
	$login_page = get_home_url();
	if ($username == "" || $password == "") {
		wp_redirect($login_page . "/entrar/?login=empty");
		exit;
	}
}
add_filter('authenticate', 'verify_username_password', 1, 3);