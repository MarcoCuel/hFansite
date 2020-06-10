<?php

add_action( 'init', 'featured' );

function featured() {
	$labels = array(
		'name'               => ( 'Destaques'),
		'singular_name'      => ( 'Destaque'),
		'menu_name'          => ( 'Destaques'),
		'name_admin_bar'     => ( 'Destaque'),
		'add_new'            => ( 'Adicionar novo'),
		'add_new_item'       => ( 'Adicionar novo destaque'),
		'new_item'           => ( 'Novo destaque'),
		'edit_item'          => ( 'Editar destaque'),
		'view_item'          => ( 'Ver destaque'),
		'all_items'          => ( 'Todos os destaques'),
		'search_items'       => ( 'Pesquisar'),
		'parent_item_colon'  => ( ''),
	);

	$args = array(
		'labels'             => $labels,
		'menu_icon'	         => 'dashicons-star-filled',
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array('title', 'editor')
	);

	register_post_type( 'destaque', $args );
}