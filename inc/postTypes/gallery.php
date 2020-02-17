<?php

add_action( 'init', 'gallery' );

function gallery() {
	$labels = array(
		'name'               => ( 'Galeria'),
		'singular_name'      => ( 'Arte'),
		'menu_name'          => ( 'Galeria'),
		'name_admin_bar'     => ( 'Arte'),
		'add_new'            => ( 'Adicionar nova'),
		'add_new_item'       => ( 'Adicionar nova arte'),
		'new_item'           => ( 'Nova arte'),
		'edit_item'          => ( 'Editar arte'),
		'view_item'          => ( 'Ver arte'),
		'all_items'          => ( 'Todas as artes'),
		'search_items'       => ( 'Pesquisar'),
		'parent_item_colon'  => ( ''),
	);

	$args = array(
		'labels'             => $labels,
		'menu_icon'	         => 'dashicons-art',
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array('title', 'thumbnail', 'editor', 'author', 'comments'),
	);

	register_post_type( 'galeria', $args );
}

add_action( 'init', 'category_gallery' );

function category_gallery() {
	$args = [
		'label'         => 'Categorias',
		'show-ui'       => true,
		'query_var'     => true,
		'hierarchical'  => true,
		'show_in_rest'  => true,
		'rewrite'       => ['slug' => 'c/galeria']
	];
	register_taxonomy( 'category_gallery', 'galeria', $args );
}

add_action( 'init', 'tags_gallery' );

function tags_gallery() {
	$args = [
		'label'         => 'Tags',
		'show-ui'       => true,
		'query_var'     => true,
		'hierarchical'  => false,
		'show_in_rest'  => true,
		'rewrite'       => ['slug' => 'tags/galeria'],
	];
	register_taxonomy( 'tags_gallery', 'galeria', $args );
}