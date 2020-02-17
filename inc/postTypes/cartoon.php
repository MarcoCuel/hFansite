<?php

add_action( 'init', 'cartoon' );

function cartoon() {
	$labels = array(
		'name'               => ( 'Tirinhas'),
		'singular_name'      => ( 'Tirinha'),
		'menu_name'          => ( 'Tirinhas'),
		'name_admin_bar'     => ( 'Tirinha'),
		'add_new'            => ( 'Adicionar nova'),
		'add_new_item'       => ( 'Adicionar nova tirinha'),
		'new_item'           => ( 'Nova tirinha'),
		'edit_item'          => ( 'Editar tirinha'),
		'view_item'          => ( 'Ver tirinha'),
		'all_items'          => ( 'Todos as tirinhas'),
		'search_items'       => ( 'Pesquisar'),
		'parent_item_colon'  => ( ''),
	);

	$args = array(
		'labels'             => $labels,
		'menu_icon'	         => 'dashicons-heart',
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array('title', 'thumbnail')
	);

	register_post_type( 'tirinha', $args );
}