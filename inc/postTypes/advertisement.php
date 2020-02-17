<?php

add_action( 'init', 'advertisement' );

function advertisement() {
	$labels = array(
		'name'               => ( 'Publicidades'),
		'singular_name'      => ( 'Publicidade'),
		'menu_name'          => ( 'Publicidades'),
		'name_admin_bar'     => ( 'Publicidade'),
		'add_new'            => ( 'Adicionar nova'),
		'add_new_item'       => ( 'Adicionar nova publicidade'),
		'new_item'           => ( 'Nova publicidade'),
		'edit_item'          => ( 'Editar publicidade'),
		'view_item'          => ( 'Ver publicidade'),
		'all_items'          => ( 'Todos as publicidades'),
		'search_items'       => ( 'Pesquisar'),
		'parent_item_colon'  => ( ''),
	);

	$args = array(
		'labels'             => $labels,
		'menu_icon'	         => 'dashicons-megaphone',
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
		'supports'           => array('title', 'thumbnail', 'editor')
	);

	register_post_type( 'publicidade', $args );
}