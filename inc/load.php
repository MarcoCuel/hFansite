<?php

// Scripts
function scripts() {

	// CSS

	wp_enqueue_style(
		'bootstrap',
		get_template_directory_uri() . '/assets/css/bootstrap.min.css',
		array(),
		'4.4.1'
	);

	wp_enqueue_style(
		'font-awesome', 'https://use.fontawesome.com/releases/v5.12.1/css/all.css',
		array(),
		'5.12.1'
	);

	wp_enqueue_style(
		'swiper',
		get_template_directory_uri() . '/assets/css/swiper.min.css',
		array(),
		'5.3.1'
	);

	wp_enqueue_style(
		'selectize',
		get_template_directory_uri() . '/assets/css/selectize.css',
		array(),
		'0.12.6'
	);

	// js

	wp_enqueue_script(
		'custom-jquery',
		'https://code.jquery.com/jquery-3.4.1.min.js',
		array(),
		'3.4.1',
		true
	);

	wp_enqueue_script(
		'custom-jquery-old',
		'https://code.jquery.com/jquery-1.11.3.min.js',
		array(),
		'3.4.1',
		true
	);

	wp_enqueue_script(
		'popper',
		'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js',
		array(),
		'1.16.0',
		true
	);

	wp_enqueue_script(
		'jqueryCookie',
		get_template_directory_uri() . '/assets/js/jquery.cookie.js',
		array(),
		'1.4.1', 
		true
	);

	wp_enqueue_script(
		'bootstrap',
		get_template_directory_uri() . '/assets/js/bootstrap.min.js',
		array(),
		'4.4.1', 
		true
	);

	wp_enqueue_script(
		'swiper',
		get_template_directory_uri() . '/assets/js/swiper.min.js',
		array(),
		'5.3.1', 
		true
	);

	wp_enqueue_script(
		'selectize',
		get_template_directory_uri() . '/assets/js/selectize.min.js',
		array(),
		'0.12.6',
		true
	);

	wp_enqueue_script(
		'moment',
		get_template_directory_uri() . '/assets/js/moment.js',
		array(),
		'2.24.0',
		true
	);

	wp_enqueue_script(
		'ajax-page',
		get_template_directory_uri() . '/assets/js/jquery.page.js',
		array(),
		'0.1',
		true
	);

	wp_enqueue_script(
		'main',
		get_template_directory_uri() . '/assets/js/main.js',
		array('jquery'),
		'1.0',
		true
	);
}
add_action( 'wp_enqueue_scripts', 'scripts' );
